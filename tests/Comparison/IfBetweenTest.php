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
use JustBlackBird\HandlebarsHelpers\Comparison\IfBetweenHelper;

/**
 * Test class for "ifBetween" helper.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class IfBetweenHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests conditions work as expected.
     *
     * @dataProvider conditionProvider
     */
    public function testCondition($value, $min, $max, $is_equal)
    {
        $helpers = new \Handlebars\Helpers(array('ifBetween' => new IfBetweenHelper()));
        $engine = new \Handlebars\Handlebars(array('helpers' => $helpers));

        $this->assertEquals(
            $engine->render(
                '{{#ifBetween value min max}}true{{else}}false{{/ifBetween}}',
                array('value' => $value, 'min' => $min, 'max' => $max)
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
            // In between
            array(10, 0, 100, true),
            // Below min
            array(10, 100, 1000, false),
            // Above max
            array(100, 0, 10, false),
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
        $helpers = new \Handlebars\Helpers(array('ifBetween' => new IfBetweenHelper()));
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
            array('{{#ifBetween}}yes{{else}}no{{/ifBetween}}'),
            array('{{#ifBetween 5}}yes{{else}}no{{/ifBetween}}'),
            // Too much arguments
            array('{{#ifBetween 2 4 8 14}}yes{{else}}no{{/ifBetween}}'),
        );
    }
}
