<?php
/*
 * This file is part of Handlebars.php Helpers Set
 *
 * (c) Dmitriy Simushev <simushevds@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JustBlackBird\HandlebarsHelpers\Tests\Layout;

use JustBlackBird\HandlebarsHelpers\Layout\BlockHelper;
use JustBlackBird\HandlebarsHelpers\Layout\BlockStorage;

/**
 * Test class for "block" helper.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class BlockHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests that exception is thrown if wrong number of arguments is used.
     *
     * @expectedException InvalidArgumentException
     * @dataProvider wrongArgumentsProvider
     */
    public function testArgumentsCount($template)
    {
        $storage = new BlockStorage();
        $helpers = new \Handlebars\Helpers(array('block' => new BlockHelper($storage)));
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
            array('{{#block}}content{{/block}}'),
            // Too much arguments
            array('{{#block "arg1" "arg2"}}content{{/block}}'),
        );
    }
}
