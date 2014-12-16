<?php
/*
 * This file is part of Handlebars.php Helpers Set
 *
 * (c) Dmitriy Simushev <simushevds@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JustBlackBird\HandlebarsHelpers\Tests;

use JustBlackBird\HandlebarsHelpers\Helpers;

/**
 * Test class for Global Helpers Set.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class HelpersTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests that all helpers in the set exist and have valid classes.
     *
     * @dataProvider helpersProvider
     */
    public function testHelper($name, $class)
    {
        $helpers = new Helpers();

        $this->assertTrue($helpers->has($name), sprintf('There is no "%s" helper', $name));
        $this->assertInstanceOf($class, $helpers->{$name});
    }

    /**
     * A data provider for testHelper method.
     */
    public function helpersProvider()
    {
        return array(
            // Date helpers
            array('formatDate', '\\JustBlackBird\\HandlebarsHelpers\\Date\\FormatDateHelper'),

            // Comparison helpers
            array('ifAny', '\\JustBlackBird\\HandlebarsHelpers\\Comparison\\IfAnyHelper'),
            array('ifEqual', '\\JustBlackBird\\HandlebarsHelpers\\Comparison\\IfEqualHelper'),
            array('ifEven', '\\JustBlackBird\\HandlebarsHelpers\\Comparison\\IfEvenHelper'),
            array('ifOdd', '\\JustBlackBird\\HandlebarsHelpers\\Comparison\\IfOddHelper'),
            array('unlessEqual', '\\JustBlackBird\\HandlebarsHelpers\\Comparison\\UnlessEqualHelper'),

            // String helpers
            array('lowercase', '\\JustBlackBird\\HandlebarsHelpers\\String\\LowercaseHelper'),
            array('uppercase', '\\JustBlackBird\\HandlebarsHelpers\\String\\UppercaseHelper'),
            array('repeat', '\\JustBlackBird\\HandlebarsHelpers\\String\\RepeatHelper'),
            array('replace', '\\JustBlackBird\\HandlebarsHelpers\\String\\ReplaceHelper'),
            array('truncate', '\\JustBlackBird\\HandlebarsHelpers\\String\\TruncateHelper'),

            // Layout helpers
            array('block', '\\JustBlackBird\\HandlebarsHelpers\\Layout\\BlockHelper'),
            array('extends', '\\JustBlackBird\\HandlebarsHelpers\\Layout\\ExtendsHelper'),
            array('override', '\\JustBlackBird\\HandlebarsHelpers\\Layout\\OverrideHelper'),
            array('ifOverridden', '\\JustBlackBird\\HandlebarsHelpers\\Layout\\IfOverriddenHelper'),
            array('unlessOverridden', '\\JustBlackBird\\HandlebarsHelpers\\Layout\\UnlessOverriddenHelper'),
        );
    }
}
