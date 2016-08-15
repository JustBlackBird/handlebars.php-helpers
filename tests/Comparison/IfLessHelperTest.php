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

use JustBlackBird\HandlebarsHelpers\Comparison\IfLessHelper;

/**
 * Test class for "ifLess" helper.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class IfLessHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests conditions work as expected.
     *
     * @dataProvider conditionProvider
     */
    public function testCondition($value, $border, $is_less)
    {
        $helpers = new \Handlebars\Helpers(array('ifLess' => new IfLessHelper()));
        $engine = new \Handlebars\Handlebars(array('helpers' => $helpers));

        $this->assertEquals(
            $engine->render(
                '{{#ifLess value border}}true{{else}}false{{/ifLess}}',
                array(
                    'value' => $value,
                    'border' => $border,
                )
            ),
            $is_less ? 'true' : 'false'
        );
    }

    /**
     * A data provider for testCondition method.
     */
    public function conditionProvider()
    {
        return array(
            // Less values with different types.
            array(2, 10, true),
            array("8", "12", true),
            // Equal values with different types.
            array(0, 0, false),
            array("42", "42", false),
            // Greater values with different types.
            array(75, 10, false),
            array("17", "2", false),
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
        $helpers = new \Handlebars\Helpers(array('ifLess' => new IfLessHelper()));
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
            array('{{#ifLess}}yes{{else}}no{{/ifLess}}'),
            // Still not enough arguments
            array('{{#ifLess 1}}yes{{else}}no{{/ifLess}}'),
            // Too much arguments
            array('{{#ifLess 1 2 3}}yes{{else}}no{{/ifLess}}'),
        );
    }
}
