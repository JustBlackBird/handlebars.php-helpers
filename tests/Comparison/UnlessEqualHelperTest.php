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

use JustBlackBird\HandlebarsHelpers\Comparison\UnlessEqualHelper;

/**
 * Test class for "unlessEqual" helper.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class UnlessEqualHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests conditions work as expected.
     *
     * @dataProvider conditionProvider
     */
    public function testCondition($left, $right, $is_equal)
    {
        $helpers = new \Handlebars\Helpers(array('unlessEqual' => new UnlessEqualHelper()));
        $engine = new \Handlebars\Handlebars(array('helpers' => $helpers));

        $this->assertEquals(
            $engine->render(
                '{{#unlessEqual left right}}false{{else}}true{{/unlessEqual}}',
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
        $helpers = new \Handlebars\Helpers(array('unlessEqual' => new UnlessEqualHelper()));
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
            array('{{#unlessEqual}}no{{else}}yes{{/unlessEqual}}'),
            // Too much arguments
            array('{{#unlessEqual 2 4 8}}no{{else}}yes{{/unlessEqual}}'),
        );
    }
}
