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

use JustBlackBird\HandlebarsHelpers\Text\TruncateHelper;

/**
 * Test class for "truncate" helper.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class TruncateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests that strings are repeated properly.
     *
     * @dataProvider truncateProvider
     */
    public function testTruncate($template, $data, $result)
    {
        $helpers = new \Handlebars\Helpers(array('truncate' => new TruncateHelper()));
        $engine = new \Handlebars\Handlebars(array('helpers' => $helpers));

        $this->assertEquals($engine->render($template, $data), $result);
    }

    /**
     * A data provider for testTruncate method.
     */
    public function truncateProvider()
    {
        return array(
            // No truncate
            array('{{truncate a len}}', array('a' => '123', 'len' => 5), '123'),
            // Simple truncates
            array('{{truncate "0123456789" 5}}', array(), '01234'),
            array('{{truncate "0123456789" 0}}', array(), ''),
            // Truncate with ellipsis
            array('{{truncate "0123456789" 5 "..."}}', array(), '01...'),
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
        $helpers = new \Handlebars\Helpers(array('truncate' => new TruncateHelper()));
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
            array('{{truncate}}'),
            array('{{truncate "abc"}}'),
            // Too much arguments
            array('{{truncate "abc" 30 "..." "xyz"}}'),
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
        $helpers = new \Handlebars\Helpers(array('truncate' => new TruncateHelper()));
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
            array('{{truncate "abc" -10}}'),
            // Length of ellipsis is greater than target length.
            array('{{truncate "abc" 2 "..."}}')
        );
    }
}
