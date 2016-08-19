<?php
/*
 * This file is part of Handlebars.php Helpers Set
 *
 * (c) Dmitriy Simushev <simushevds@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JustBlackBird\HandlebarsHelpers\Tests\Comparison;

use JustBlackBird\HandlebarsHelpers\Comparison\IfBetweenLeftClosedHelper;

/**
 * Test class for "ifBetweenLeftClosed" helper.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class IfBetweenLeftClosedHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests conditions work as expected.
     *
     * @dataProvider conditionProvider
     */
    public function testCondition($value, $left, $right, $is_between)
    {
        $helpers = new \Handlebars\Helpers(array('ifBetweenLeftClosed' => new IfBetweenLeftClosedHelper()));
        $engine = new \Handlebars\Handlebars(array('helpers' => $helpers));

        $this->assertEquals(
            $engine->render(
                '{{#ifBetweenLeftClosed value left right}}true{{else}}false{{/ifBetweenLeftClosed}}',
                array(
                    'value' => $value,
                    'left' => $left,
                    'right' => $right,
                )
            ),
            $is_between ? 'true' : 'false'
        );
    }

    /**
     * A data provider for testCondition method.
     */
    public function conditionProvider()
    {
        return array(
            // The value is less than left border.
            array(2, 10, 12, false),
            // The value equals to the left border.
            array(0, 0, 42, true),
            // The value equals to the right border.
            array(9, 0, 9, false),
            // The value is more than the right border.
            array(75, 10, 12, false),
            // The value is between borders.
            array(58, 11, 134, true),
        );
    }

    /**
     * Tests that exception is thrown if wrong number of arguments is used.
     *
     * @expectedException InvalidArgumentException
     * @dataProvider wrongArgumentsProvider
     */
    public function testArgumentsCount($template)
    {
        $helpers = new \Handlebars\Helpers(array('ifBetweenLeftClosed' => new IfBetweenLeftClosedHelper()));
        $engine = new \Handlebars\Handlebars(array('helpers' => $helpers));

        $engine->render($template, array());
    }

    /**
     * A data provider for testArgumentsCount method.
     */
    public function wrongArgumentsProvider()
    {
        return array(
            // Not enough arguments
            array('{{#ifBetweenLeftClosed}}yes{{else}}no{{/ifBetweenLeftClosed}}'),
            // Still not enough arguments
            array('{{#ifBetweenLeftClosed 1}}yes{{else}}no{{/ifBetweenLeftClosed}}'),
            array('{{#ifBetweenLeftClosed 1 2}}yes{{else}}no{{/ifBetweenLeftClosed}}'),
            // Too much arguments
            array('{{#ifBetweenLeftClosed 1 2 3 4}}yes{{else}}no{{/ifBetweenLeftClosed}}'),
        );
    }
}
