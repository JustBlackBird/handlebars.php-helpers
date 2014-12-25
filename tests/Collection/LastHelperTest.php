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

use JustBlackBird\HandlebarsHelpers\Collection\LastHelper;

/**
 * Test class for "last" helper.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class LastHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests that the last item returned.
     *
     * @dataProvider collectionsProvider
     */
    public function testLastItem($collection, $result)
    {
        $helpers = new \Handlebars\Helpers(array('last' => new LastHelper()));
        $engine = new \Handlebars\Handlebars(array('helpers' => $helpers));

        $this->assertEquals(
            $engine->render(
                '{{last collection}}',
                array('collection' => $collection)
            ),
            $result
        );
    }

    /**
     * A data provider for testLastItem method.
     */
    public function collectionsProvider()
    {
        return array(
            // Test arrays with numeric keys
            array(array('a', 'b', 'c'), 'c'),
            array(array('z'), 'z'),
            // Test associative arrays
            array(array('a' => '10', 'b' => '11', 'c' => '12'), '12'),
            array(array('f' => '15'), '15'),
            // Test \Traversable instance
            array(new \ArrayIterator(array('a', 'b', 'c')), 'c'),
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
     * @dataProvider wrongArgumentsCountProvider
     */
    public function testArgumentsCount($template)
    {
        $helpers = new \Handlebars\Helpers(array('last' => new LastHelper()));
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
            array('{{last}}'),
            // Too much arguments
            array('{{last "Arg" "ANOTHER ARG"}}'),
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
        $helpers = new \Handlebars\Helpers(array('last' => new LastHelper()));
        $engine = new \Handlebars\Handlebars(array('helpers' => $helpers));

        $engine->render('{{last collection}}', array('collection' => $collection));
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
