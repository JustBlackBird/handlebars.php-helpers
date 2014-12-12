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

use JustBlackBird\HandlebarsHelpers\Comparison\IfEvenHelper;

/**
 * Test class for "ifEven" helper.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class IfEventHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests conditions work as expected.
     *
     * @dataProvider conditionProvider
     */
    public function testCondition($value, $is_even)
    {
        $helpers = new \Handlebars\Helpers(array('ifEven' => new IfEvenHelper()));
        $engine = new \Handlebars\Handlebars(array('helpers' => $helpers));

        $this->assertEquals(
            $engine->render(
                '{{#ifEven value}}true{{else}}false{{/ifEven}}',
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
        $helpers = new \Handlebars\Helpers(array('ifEven' => new IfEvenHelper()));
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
            array('{{#ifEven}}yes{{else}}no{{/ifEven}}'),
            // Too much arguments
            array('{{#ifEven 2 4}}yes{{else}}no{{/ifEven}}'),
        );
    }
}
