<?php
/*
 * This file is part of Handlebars.php Helpers Set
 *
 * (c) Dmitriy Simushev <simushevds@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JustBlackBird\HandlebarsHelpers\Tests\String;

use JustBlackBird\HandlebarsHelpers\String\Helpers;

/**
 * Test class for String Helpers Set.
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
            array('lowercase', '\\JustBlackBird\\HandlebarsHelpers\\String\\LowercaseHelper'),
            array('uppercase', '\\JustBlackBird\\HandlebarsHelpers\\String\\UppercaseHelper'),
            array('repeat', '\\JustBlackBird\\HandlebarsHelpers\\String\\RepeatHelper'),
            array('replace', '\\JustBlackBird\\HandlebarsHelpers\\String\\ReplaceHelper'),
            array('truncate', '\\JustBlackBird\\HandlebarsHelpers\\String\\TruncateHelper'),
        );
    }
}
