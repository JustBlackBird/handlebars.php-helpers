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

use JustBlackBird\HandlebarsHelpers\Text\ReplaceHelper;

/**
 * Test class for "replace" helper.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class ReplaceHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests that strings are repeated properly.
     *
     * @dataProvider replaceProvider
     */
    public function testReplace($string, $search, $replacement, $result)
    {
        $helpers = new \Handlebars\Helpers(array('replace' => new ReplaceHelper()));
        $engine = new \Handlebars\Handlebars(array('helpers' => $helpers));

        $this->assertEquals(
            $engine->render(
                '{{#replace search replacement}}{{str}}{{/replace}}',
                array('str' => $string, 'search' => $search, 'replacement' => $replacement)
            ),
            $result
        );
    }

    /**
     * A data provider for testReplace method.
     */
    public function replaceProvider()
    {
        return array(
            array('abcd', 'b', '', 'acd'),
            array('abcd', 'xyz', '', 'abcd'),
            array('abcd', '', 'asd', 'abcd'),
        );
    }

    /**
     * Tests that exception is thrown if wrong number of arguments is used.
     *
     * @expectedException InvalidArgumentException
     * @dataProvider wrongArgumentsSetProvider
     */
    public function testArgumentsCount($template)
    {
        $helpers = new \Handlebars\Helpers(array('replace' => new ReplaceHelper()));
        $engine = new \Handlebars\Handlebars(array('helpers' => $helpers));

        $engine->render($template, array());
    }

    /**
     * A data provider for testArgumentsCount method.
     */
    public function wrongArgumentsSetProvider()
    {
        return array(
            // Not enough arguments
            array('{{#replace}}str{{/replace}}'),
            array('{{#replace "serach"}}str{{/replace}}'),
            // Too much arguments
            array('{{#replace "search" "replacement" "asd"}}str{{/replace}}'),
        );
    }
}
