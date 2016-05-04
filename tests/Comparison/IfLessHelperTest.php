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

use InvalidArgumentException;
use JustBlackBird\HandlebarsHelpers\Comparison\IfLessHelper;

/**
 * Test class for "ifLess" helper.
 *
 * @author Jesse Weigert <jesse.weigert@accretivetg.com>
 */
class IfLessHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests conditions work as expected.
     *
     * @dataProvider conditionProvider
     */
    public function testCondition($left, $right, $is_equal)
    {
        $helpers = new \Handlebars\Helpers(array('ifLess' => new IfLessHelper()));
        $engine = new \Handlebars\Handlebars(array('helpers' => $helpers));

        $this->assertEquals(
            $engine->render(
                '{{#ifLess left right}}true{{else}}false{{/ifLess}}',
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
            // 1 is less than 10
            array(1, 10, true),
            // 10 is not less than 1
            array(10, 1, false),
            // Same values
            array(123, 123, false),
            // Equal values but with different types
            array(123, "123", false),
            // One more type conversion check
            array(0, false, false),
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
            array('{{#ifLess 5}}yes{{else}}no{{/ifLess}}'),
            // Too much arguments
            array('{{#ifLess 2 4 8}}yes{{else}}no{{/ifLess}}'),
        );
    }
}
