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

use JustBlackBird\HandlebarsHelpers\Text\EllipsisHelper;

/**
 * Test class for "ellipsis" helper.
 *
 * @author Matteo Merola <mattmezza@gmail.com>
 */
class EllipsisTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests that strings are repeated properly.
     *
     * @dataProvider truncateProvider
     */
    public function testEllipsis($template, $data, $result)
    {
        $helpers = new \Handlebars\Helpers(array('ellipsis' => new EllipsisHelper()));
        $engine = new \Handlebars\Handlebars(array('helpers' => $helpers));

        $this->assertEquals($engine->render($template, $data), $result);
    }

    /**
     * A data provider for testEllipsis method.
     */
    public function truncateProvider()
    {
        return array(
            // No truncate
            array('{{ellipsis a len}}', array('a' => '123', 'len' => 5), '123'),
            // Simple truncates
            array('{{ellipsis "prova matteo ciao" 2}}', array(), 'prova matteo'),
            array('{{ellipsis "prova merola hello" 0}}', array(), ''),
            // Truncate with ellipsis
            array('{{ellipsis "prova matt" 1 "..."}}', array(), 'prova...'),
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
        $helpers = new \Handlebars\Helpers(array('ellipsis' => new EllipsisHelper()));
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
            array('{{ellipsis}}'),
            array('{{ellipsis "abc"}}'),
            // Too much arguments
            array('{{ellipsis "abc" 30 "..." "xyz"}}'),
        );
    }

    /**
     * Tests that exception is thrown if arguments are invalid.
     *
     * @expectedException InvalidArgumentException
     * @dataProvider invalidArgumentsProvider
     */
    public function testInvalidArguments($template)
    {
        $helpers = new \Handlebars\Helpers(array('ellipsis' => new EllipsisHelper()));
        $engine = new \Handlebars\Handlebars(array('helpers' => $helpers));

        $engine->render($template, array());
    }

    /**
     * A data provider for testInvalidArguments method.
     */
    public function invalidArgumentsProvider()
    {
        return array(
            // Negative target length.
            array('{{ellipsis "abc" -10}}'),
        );
    }
}
