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
use JustBlackBird\HandlebarsHelpers\Layout\ExtendsHelper;
use JustBlackBird\HandlebarsHelpers\Layout\IfOverriddenHelper;
use JustBlackBird\HandlebarsHelpers\Layout\OverrideHelper;
use JustBlackBird\HandlebarsHelpers\Layout\UnlessOverriddenHelper;

/**
 * Test class for all layout helpers.
 *
 * Layout helpers must work together thus combined tests should be used.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class IntegrationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests how inheritance helpers works together.
     */
    public function testInheritance()
    {
        $storage = new BlockStorage();
        $helpers = new \Handlebars\Helpers(array(
            'block' => new BlockHelper($storage),
            'extends' => new ExtendsHelper($storage),
            'override' => new OverrideHelper($storage),
        ));
        $engine = new \Handlebars\Handlebars(array('helpers' => $helpers));

        // Test simple inheritance
        $engine->setLoader(new \Handlebars\Loader\ArrayLoader(array(
            'parent' => '{{#block "name"}}parent{{/block}} template',
            'child' => '{{#extends "parent"}}{{#override "name"}}child{{/override}}{{/extends}}',
            'grandchild' => '{{#extends "child"}}{{#override "name"}}grandchild{{/override}}{{/extends}}',
        )));
        $this->assertEquals($engine->render('parent', array()), 'parent template');
        $this->assertEquals($engine->render('child', array()), 'child template');
        $this->assertEquals($engine->render('grandchild', array()), 'grandchild template');

        // Test inheritance with nested blocks
        $engine->setLoader(new \Handlebars\Loader\ArrayLoader(array(
            'parent' => '{{#block "title"}}{{#block "name"}}parent{{/block}} template{{/block}}',
            'child' => '{{#extends "parent"}}{{#override "name"}}child{{/override}}{{/extends}}',
            'newbie' => '{{#extends "parent"}}{{#override "title"}}Newbie!{{/override}}{{/extends}}',
        )));
        $this->assertEquals($engine->render('parent', array()), 'parent template');
        $this->assertEquals($engine->render('child', array()), 'child template');
        $this->assertEquals($engine->render('newbie', array()), 'Newbie!');
    }

    /**
     * Tests that conditions related with inheritance works as expected.
     */
    public function testConditions()
    {
        $storage = new BlockStorage();
        $helpers = new \Handlebars\Helpers(array(
            'block' => new BlockHelper($storage),
            'extends' => new ExtendsHelper($storage),
            'override' => new OverrideHelper($storage),
            'ifOverridden' => new IfOverriddenHelper($storage),
            'unlessOverridden' => new UnlessOverriddenHelper($storage),
        ));
        $engine = new \Handlebars\Handlebars(array('helpers' => $helpers));

        // Test "ifOverridden" helper
        $engine->setLoader(new \Handlebars\Loader\ArrayLoader(array(
            'parent' => '{{#block "name"}}{{/block}}{{#ifOverridden "name"}}true{{else}}false{{/ifOverridden}}',
            'child' => '{{#extends "parent"}}{{#override "name"}}{{/override}}{{/extends}}',
            'another_child' => '{{#extends "parent"}}{{/extends}}',
        )));
        $this->assertEquals($engine->render('parent', array()), 'false');
        $this->assertEquals($engine->render('child', array()), 'true');
        $this->assertEquals($engine->render('another_child', array()), 'false');

        // Test "unlessOverridden" helper
        $engine->setLoader(new \Handlebars\Loader\ArrayLoader(array(
            'parent' => '{{#block "name"}}{{/block}}{{#unlessOverridden "name"}}false{{else}}true{{/unlessOverridden}}',
            'child' => '{{#extends "parent"}}{{#override "name"}}{{/override}}{{/extends}}',
            'another_child' => '{{#extends "parent"}}{{/extends}}',
        )));
        $this->assertEquals($engine->render('parent', array()), 'false');
        $this->assertEquals($engine->render('child', array()), 'true');
        $this->assertEquals($engine->render('another_child', array()), 'false');
    }
}
