<?php
/*
 * This file is part of Handlebars.php Helpers Set
 *
 * (c) Dmitriy Simushev <simushevds@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JustBlackBird\HandlebarsHelpers\Tests\Comparison;

use JustBlackBird\HandlebarsHelpers\Comparison\Helpers;

/**
 * Test class for Comparison Helpers Set.
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
            array('ifAny', '\\JustBlackBird\\HandlebarsHelpers\\Comparison\\IfAnyHelper'),
            array('ifEqual', '\\JustBlackBird\\HandlebarsHelpers\\Comparison\\IfEqualHelper'),
            array('ifEven', '\\JustBlackBird\\HandlebarsHelpers\\Comparison\\IfEvenHelper'),
            array('ifOdd', '\\JustBlackBird\\HandlebarsHelpers\\Comparison\\IfOddHelper'),
            array('ifLess', '\\JustBlackBird\\HandlebarsHelpers\\Comparison\\IfLessHelper'),
            array('ifMore', '\\JustBlackBird\\HandlebarsHelpers\\Comparison\\IfMoreHelper'),
            array('ifBetween', '\\JustBlackBird\\HandlebarsHelpers\\Comparison\\IfBetweenHelper'),
            array('ifBetweenClosed', '\\JustBlackBird\\HandlebarsHelpers\\Comparison\\IfBetweenClosedHelper'),
            array('ifBetweenLeftClosed', '\\JustBlackBird\\HandlebarsHelpers\\Comparison\\IfBetweenLeftClosedHelper'),
            array('ifBetweenRightClosed', '\\JustBlackBird\\HandlebarsHelpers\\Comparison\\IfBetweenRightClosedHelper'),
            array('unlessEqual', '\\JustBlackBird\\HandlebarsHelpers\\Comparison\\UnlessEqualHelper'),
        );
    }
}
