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

use JustBlackBird\HandlebarsHelpers\Comparison\IfAnyHelper;

/**
 * Test class for "ifAny" helper.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class IfAnyHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests conditions work as expected.
     *
     * @dataProvider conditionProvider
     */
    public function testCondition($template, $data, $result)
    {
        $helpers = new \Handlebars\Helpers(array('ifAny' => new IfAnyHelper()));
        $engine = new \Handlebars\Handlebars(array('helpers' => $helpers));

        $this->assertEquals($engine->render($template, $data), $result);
    }

    /**
     * A data provider for testCondition method.
     */
    public function conditionProvider()
    {
        return array(
            // Single argument. It's an analog of "if" helper.
            array('{{#ifAny a}}true{{else}}false{{/ifAny}}', array('a' => true), 'true'),
            array('{{#ifAny a}}true{{else}}false{{/ifAny}}', array('a' => false), 'false'),
            // Multiple arguments (positive)
            array(
                '{{#ifAny a b c}}true{{else}}false{{/ifAny}}',
                array('a' => false, 'b' => true, 'c' => false),
                'true',
            ),
            // Multiple arguments (negative)
            array(
                '{{#ifAny a b c}}true{{else}}false{{/ifAny}}',
                array('a' => false, 'b' => false, 'c' => false),
                'false',
            ),
            // Multiple arguments (negative). Check different falsy values.
            array(
                '{{#ifAny a b c d e}}true{{else}}false{{/ifAny}}',
                array(
                    'a' => 0,
                    'b' => null,
                    'c' => array(),
                    'd' => '',
                    'e' => new \Handlebars\StringWrapper(''),
                ),
                'false',
            ),
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
        $helpers = new \Handlebars\Helpers(array('ifAny' => new IfAnyHelper()));
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
            array('{{#ifAny}}yes{{else}}no{{/ifAny}}'),
        );
    }
}
