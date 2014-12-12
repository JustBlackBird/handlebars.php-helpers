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

use JustBlackBird\HandlebarsHelpers\Comparison\IfOddHelper;

/**
 * Test class for "ifOdd" helper.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class IfOddHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests conditions work as expected.
     *
     * @dataProvider conditionProvider
     */
    public function testCondition($value, $is_even)
    {
        $helpers = new \Handlebars\Helpers(array('ifOdd' => new IfOddHelper()));
        $engine = new \Handlebars\Handlebars(array('helpers' => $helpers));

        $this->assertEquals(
            $engine->render(
                '{{#ifOdd value}}false{{else}}true{{/ifOdd}}',
                array('value' => $value)
            ),
            $is_even ? 'true' : 'false'
        );
    }

    /**
     * A data provider for testCondition method.
     */
    public function conditionProvider()
    {
        return array(
            // Even values but with different types
            array(2, true),
            array("8", true),
            // Zero is even number
            array(0, true),
            // Null should be treated as zero so it's an even value too.
            array(null, true),
            // Odd values with different types
            array(1, false),
            array("17", false),
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
        $helpers = new \Handlebars\Helpers(array('ifOdd' => new IfOddHelper()));
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
            array('{{#ifOdd}}yes{{else}}no{{/ifOdd}}'),
            // Too much arguments
            array('{{#ifOdd 2 4}}yes{{else}}no{{/ifOdd}}'),
        );
    }
}
