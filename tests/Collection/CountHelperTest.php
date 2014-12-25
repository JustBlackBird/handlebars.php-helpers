<?php
/*
 * This file is part of Handlebars.php Helpers Set
 *
 * (c) Dmitriy Simushev <simushevds@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JustBlackBird\HandlebarsHelpers\Tests\Collection;

use JustBlackBird\HandlebarsHelpers\Collection\CountHelper;

/**
 * Test class for "count" helper.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class CountHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests that count is calculated properly.
     *
     * @dataProvider collectionsProvider
     */
    public function testCount($collection, $result)
    {
        $helpers = new \Handlebars\Helpers(array('count' => new CountHelper()));
        $engine = new \Handlebars\Handlebars(array('helpers' => $helpers));

        $this->assertEquals(
            $engine->render(
                '{{count collection}}',
                array('collection' => $collection)
            ),
            $result
        );
    }

    /**
     * A data provider for testCount method.
     */
    public function collectionsProvider()
    {
        return array(
            // Test arrays with numeric keys
            array(array('a', 'b', 'c'), '3'),
            // Test associative arrays
            array(array('a' => '10'), '1'),
            // Test \Countable instance
            array(new \ArrayIterator(array('a', 'b')), '2'),
            // Test empty collections
            array(array(), '0'),
            array(new \ArrayIterator(array()), '0'),
        );
    }

    /**
     * Tests that exception is thrown if wrong number of arguments is used.
     *
     * @expectedException InvalidArgumentException
     * @dataProvider wrongArgumentsCountProvider
     */
    public function testArgumentsCount($template)
    {
        $helpers = new \Handlebars\Helpers(array('count' => new CountHelper()));
        $engine = new \Handlebars\Handlebars(array('helpers' => $helpers));

        $engine->render($template, array());
    }

    /**
     * A data provider for testArgumentsCount method.
     */
    public function wrongArgumentsCountProvider()
    {
        return array(
            // Not enough arguments
            array('{{count}}'),
            // Too much arguments
            array('{{count "Arg" "ANOTHER ARG"}}'),
        );
    }

    /**
     * Tests invalid arguments type.
     *
     * @expectedException InvalidArgumentException
     * @dataProvider invalidArgumentsProvider
     */
    public function testInvalidArguments($collection)
    {
        $helpers = new \Handlebars\Helpers(array('count' => new CountHelper()));
        $engine = new \Handlebars\Handlebars(array('helpers' => $helpers));

        $engine->render('{{count collection}}', array('collection' => $collection));
    }

    /**
     * A data provider for testInvalidArguments method.
     */
    public function invalidArgumentsProvider()
    {
        return array(
            array('a string'),
            array(42),
            array(new \stdClass()),
        );
    }
}
