<?php
/*
 * This file is part of Handlebars.php Helpers Set
 *
 * (c) Dmitriy Simushev <simushevds@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JustBlackBird\HandlebarsHelpers\Layout;

/**
 * Contains base functionality for all helpers related with blocks overriding.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
abstract class AbstractBlockHelper
{
    /**
     * @var BlockStorage
     */
    protected $blocksStorage;

    /**
     * Helper's constructor.
     *
     * @param BlockStorage $storage A Blocks context instance
     */
    public function __construct(BlockStorage $storage)
    {
        $this->blocksStorage = $storage;
    }
}
