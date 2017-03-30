<?php
/*
 * This file is part of Handlebars.php Helpers Set
 *
 * (c) Dmitriy Simushev <simushevds@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JustBlackBird\HandlebarsHelpers\Tests\Text;

use JustBlackBird\HandlebarsHelpers\Text\Helpers;

/**
 * Test class for Text Helpers Set.
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
            array('lowercase', '\\JustBlackBird\\HandlebarsHelpers\\Text\\LowercaseHelper'),
            array('uppercase', '\\JustBlackBird\\HandlebarsHelpers\\Text\\UppercaseHelper'),
            array('repeat', '\\JustBlackBird\\HandlebarsHelpers\\Text\\RepeatHelper'),
            array('replace', '\\JustBlackBird\\HandlebarsHelpers\\Text\\ReplaceHelper'),
            array('truncate', '\\JustBlackBird\\HandlebarsHelpers\\Text\\TruncateHelper'),
            array('ellipsis', '\\JustBlackBird\\HandlebarsHelpers\\Text\\EllipsisHelper'),
        );
    }
}
