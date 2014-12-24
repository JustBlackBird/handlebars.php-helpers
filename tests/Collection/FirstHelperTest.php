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

use JustBlackBird\HandlebarsHelpers\Collection\FirstHelper;

/**
 * Test class for "first" helper.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class FirstHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests that the first item returned.
     *
     * @dataProvider collectionsProvider
     */
    public function testFirstItem($collection, $result)
    {
        $helpers = new \Handlebars\Helpers(array('first' => new FirstHelper()));
        $engine = new \Handlebars\Handlebars(array('helpers' => $helpers));

        $this->assertEquals(
            $engine->render(
                '{{first collection}}',
                array('collection' => $collection)
            ),
            $result
        );
    }

    /**
     * A data provider for testFirstItem method.
     */
    public function collectionsProvider()
    {
        return array(
            // Test arrays with numeric keys
            array(array('a', 'b', 'c'), 'a'),
            array(array('z'), 'z'),
            // Test associative arrays
            array(array('a' => '10', 'b' => '11', 'c' => '12'), '10'),
            array(array('f' => '15'), '15'),
            // Test \Traversable instance
            array(new \ArrayIterator(array('a', 'b', 'c')), 'a'),
            array(new \ArrayIterator(array('z')), 'z'),
            // Test empty collections
            array(array(), false),
            array(new \ArrayIterator(array()), false),
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
        $helpers = new \Handlebars\Helpers(array('first' => new FirstHelper()));
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
            array('{{first}}'),
            // Too much arguments
            array('{{first "Arg" "ANOTHER ARG"}}'),
        );
    }
}
