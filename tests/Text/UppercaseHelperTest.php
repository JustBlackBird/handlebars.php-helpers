<?php
/*
 * This file is part of Handlebars.php Helpers Set
 *
 * (c) Dmitriy Simushev <simushevds@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JustBlackBird\HandlebarsHelpers\Tests\Text;

use JustBlackBird\HandlebarsHelpers\Text\UppercaseHelper;

/**
 * Test class for "uppercase" helper.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class UppercaseHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests that strings are converted to uppercase properly.
     *
     * @dataProvider convertProvider
     */
    public function testConvert($string, $result)
    {
        $helpers = new \Handlebars\Helpers(array('uppercase' => new UppercaseHelper()));
        $engine = new \Handlebars\Handlebars(array('helpers' => $helpers));

        $this->assertEquals(
            $engine->render(
                '{{uppercase str}}',
                array('str' => $string)
            ),
            $result
        );
    }

    /**
     * A data provider for testConvert method.
     */
    public function convertProvider()
    {
        return array(
            array('ALREADY IN UPPERCASE', 'ALREADY IN UPPERCASE'),
            array('Mixed Case String', 'MIXED CASE STRING'),
            array('ANOther mIxed CASE string', 'ANOTHER MIXED CASE STRING'),
            array('string in lowercase', 'STRING IN LOWERCASE'),
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
        $helpers = new \Handlebars\Helpers(array('uppercase' => new UppercaseHelper()));
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
            array('{{uppercase}}'),
            // Too much arguments
            array('{{uppercase "Arg" "ANOTHER ARG"}}'),
        );
    }
}
