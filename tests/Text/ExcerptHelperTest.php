<?php
/*
 *
 * (c) Matteo Merola <mattmezza@gmail.com>
 *
 */

namespace JustBlackBird\HandlebarsHelpers\Tests\Text;

use JustBlackBird\HandlebarsHelpers\Text\ExcerptHelper;

/**
 * Test class for "excerpt" helper.
 *
 * @author Matteo Merola <mattmezza@gmail.com>
 */
class ExcerptTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests that strings are repeated properly.
     *
     * @dataProvider truncateProvider
     */
    public function testExcerpt($template, $data, $result)
    {
        $helpers = new \Handlebars\Helpers(array('excerpt' => new ExcerptHelper()));
        $engine = new \Handlebars\Handlebars(array('helpers' => $helpers));

        $this->assertEquals($engine->render($template, $data), $result);
    }

    /**
     * A data provider for testExcerpt method.
     */
    public function truncateProvider()
    {
        return array(
            // No truncate
            array('{{excerpt a len}}', array('a' => '123', 'len' => 5), '123'),
            // Simple truncates
            array('{{excerpt "prova matteo ciao" 2}}', array(), 'prova matteo'),
            array('{{excerpt "prova merola hello" 0}}', array(), ''),
            // Truncate with ellipsis
            array('{{excerpt "prova matt" 1 "..."}}', array(), 'prova...'),
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
        $helpers = new \Handlebars\Helpers(array('excerpt' => new ExcerptHelper()));
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
            array('{{excerpt}}'),
            array('{{excerpt "abc"}}'),
            // Too much arguments
            array('{{excerpt "abc" 30 "..." "xyz"}}'),
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
        $helpers = new \Handlebars\Helpers(array('excerpt' => new ExcerptHelper()));
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
            array('{{excerpt "abc" -10}}'),
        );
    }
}
