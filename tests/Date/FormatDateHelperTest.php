<?php
/*
 * This file is part of Handlebars.php Helpers Set
 *
 * (c) Dmitriy Simushev <simushevds@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JustBlackBird\HandlebarsHelpers\Tests\Date;

use JustBlackBird\HandlebarsHelpers\Date\FormatDateHelper;

/**
 * Test class for "formatDate" helper.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class FormatDateHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests that date is formatted properly.
     *
     * @dataProvider formatProvider
     */
    public function testFormat($time, $format, $result)
    {
        $helpers = new \Handlebars\Helpers(array('formatDate' => new FormatDateHelper()));
        $engine = new \Handlebars\Handlebars(array('helpers' => $helpers));

        $this->assertEquals($engine->render(
            '{{formatDate time format}}',
            array(
                'time' => $time,
                'format' => $format,
            )
        ), $result);
    }

    /**
     * A data provider for testFormat method.
     */
    public function formatProvider()
    {
        $now = new \DateTime();
        $format = "%H:%M %d-%m-%Y";
        $expected = strftime($format, $now->getTimestamp());

        return array(
            // DateTime object
            array($now, $format, $expected),
            // Integer timestamp
            array($now->getTimestamp(), $format, $expected),
            // String timestamp
            array((string)$now->getTimestamp(), $format, $expected),
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
        $helpers = new \Handlebars\Helpers(array('formatDate' => new FormatDateHelper()));
        $engine = new \Handlebars\Handlebars(array('helpers' => $helpers));

        $engine->render($template, array());
    }

    /**
     * A data provider for FormatDateHelperTest::testArgumentsCount() test.
     */
    public function wrongArgumentsProvider()
    {
        return array(
            // Not enough arguments
            array('{{formatDate 658983600}}'),
            // Too much arguments
            array('{{formatDate 658983600 "%F" "test"}}'),
        );
    }
}
