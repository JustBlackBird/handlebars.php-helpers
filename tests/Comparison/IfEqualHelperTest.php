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

use JustBlackBird\HandlebarsHelpers\Comparison\IfEqualHelper;

/**
 * Test class for "ifEqual" helper.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class IfEqualHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests conditions work as expected.
     *
     * @dataProvider conditionProvider
     */
    public function testCondition($left, $right, $is_equal)
    {
        $helpers = new \Handlebars\Helpers(array('ifEqual' => new IfEqualHelper()));
        $engine = new \Handlebars\Handlebars(array('helpers' => $helpers));

        $this->assertEquals(
            $engine->render(
                '{{#ifEqual left right}}true{{else}}false{{/ifEqual}}',
                array('left' => $left, 'right' => $right)
            ),
            $is_equal ? 'true' : 'false'
        );
    }

    /**
     * A data provider for testCondition method.
     */
    public function conditionProvider()
    {
        return array(
            // Same values
            array(123, 123, true),
            // Equal values but with different types
            array(123, "123", true),
            // One more type convertion check
            array(0, false, true),
            // Different values
            array(123, false, false),
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
        $helpers = new \Handlebars\Helpers(array('ifEqual' => new IfEqualHelper()));
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
            array('{{#ifEqual}}yes{{else}}no{{/ifEqual}}'),
            array('{{#ifEqual 5}}yes{{else}}no{{/ifEqual}}'),
            // Too much arguments
            array('{{#ifEqual 2 4 8}}yes{{else}}no{{/ifEqual}}'),
        );
    }
}
