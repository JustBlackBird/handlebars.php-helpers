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

use JustBlackBird\HandlebarsHelpers\Layout\OverrideHelper;
use JustBlackBird\HandlebarsHelpers\Layout\BlockStorage;

/**
 * Test class for "override" helper.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class OverrideHelperTest extends \PHPUnit_Framework_TestCase
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
        $helpers = new \Handlebars\Helpers(array('override' => new OverrideHelper($storage)));
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
            array('{{#override}}content{{/override}}'),
            // Too much arguments
            array('{{#override "arg1" "arg2"}}content{{/override}}'),
        );
    }
}
