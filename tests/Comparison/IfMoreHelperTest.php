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

use JustBlackBird\HandlebarsHelpers\Comparison\IfMoreHelper;

/**
 * Test class for "ifMore" helper.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class IfMoreHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests conditions work as expected.
     *
     * @dataProvider conditionProvider
     */
    public function testCondition($value, $border, $is_less)
    {
        $helpers = new \Handlebars\Helpers(array('ifMore' => new IfMoreHelper()));
        $engine = new \Handlebars\Handlebars(array('helpers' => $helpers));

        $this->assertEquals(
            $engine->render(
                '{{#ifMore value border}}true{{else}}false{{/ifMore}}',
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
            array(3, 18, false),
            array("42", "314", false),
            // Equal values with different types.
            array(0, 0, false),
            array("42", "42", false),
            // More values with different types.
            array(89, 1, true),
            array("34", "33", true),
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
        $helpers = new \Handlebars\Helpers(array('ifMore' => new IfMoreHelper()));
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
            array('{{#ifMore}}yes{{else}}no{{/ifMore}}'),
            // Still not enough arguments
            array('{{#ifMore 1}}yes{{else}}no{{/ifMore}}'),
            // Too much arguments
            array('{{#ifMore 1 2 3}}yes{{else}}no{{/ifMore}}'),
        );
    }
}
