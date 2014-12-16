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

/**
 * Test class for BlockStorage.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class BlockStorageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests basic operations with storage.
     */
    public function testBasicOperations()
    {
        $storage = new BlockStorage();
        $this->assertFalse($storage->has('test'));
        $storage->set('test', 'content');
        $this->assertTrue($storage->has('test'));
        $this->assertEquals($storage->get('test'), 'content');
        $storage->set('test', 'another content');
        $this->assertEquals($storage->get('test'), 'another content');
        $storage->remove('test');
        $this->assertFalse($storage->has('test'));
        $storage->set('test', 'content');
        $storage->set('another_test', 'content');
        $storage->clear();
        $this->assertFalse($storage->has('test'));
        $this->assertFalse($storage->has('another_test'));
    }
}
