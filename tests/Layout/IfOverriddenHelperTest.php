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

use JustBlackBird\HandlebarsHelpers\Layout\BlockStorage;
use JustBlackBird\HandlebarsHelpers\Layout\IfOverriddenHelper;

/**
 * Test class for "ifOverridden" helper.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class IfOverriddenHelperTest extends \PHPUnit_Framework_TestCase
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
        $helpers = new \Handlebars\Helpers(array('ifOverridden' => new IfOverriddenHelper($storage)));
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
            array('{{#ifOverridden}}true{{else}}false{{/ifOverridden}}'),
            // Too much arguments
            array('{{#ifOverridden "arg1" "arg2"}}true{{else}}false{{/ifOverridden}}'),
        );
    }
}
