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

use JustBlackBird\HandlebarsHelpers\Text\RepeatHelper;

/**
 * Test class for "repeat" helper.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class RepeatHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests that strings are repeated properly.
     *
     * @dataProvider repeatProvider
     */
    public function testRepeat($string, $times, $result)
    {
        $helpers = new \Handlebars\Helpers(array('repeat' => new RepeatHelper()));
        $engine = new \Handlebars\Handlebars(array('helpers' => $helpers));

        $this->assertEquals(
            $engine->render(
                '{{#repeat times}}{{str}}{{/repeat}}',
                array('times' => $times, 'str' => $string)
            ),
            $result
        );
    }

    /**
     * A data provider for testRepeat method.
     */
    public function repeatProvider()
    {
        return array(
            array('+', 0, ''),
            array('+', 3, '+++'),
            array('', 3, ''),
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
        $helpers = new \Handlebars\Helpers(array('repeat' => new RepeatHelper()));
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
            array('{{#repeat}}{{/repeat}}'),
            // Too much arguments
            array('{{#repeat 10 "ANOTHER ARG"}}{{/repeat}}'),
        );
    }

    /**
     * Tests that exception is thrown if arguments are invalid.
     *
     * @expectedException InvalidArgumentException
     */
    public function testInvalidArguments()
    {
        $helpers = new \Handlebars\Helpers(array('repeat' => new RepeatHelper()));
        $engine = new \Handlebars\Handlebars(array('helpers' => $helpers));

        $engine->render('{{#repeat -10}}+{{/repeat}}', array());
    }
}
