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
 * A storage for overridable blocks' content.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class BlockStorage
{
    /**
     * Associative array of blocks. The keys are blocks names and the values are
     * blocks content.
     *
     * @type string[]
     */
    protected $blocks = array();

    /**
     * Gets content of a block.
     *
     * @param string $name Block's name.
     * @return string Block's content.
     */
    public function get($name)
    {
        return isset($this->blocks[$name]) ? $this->blocks[$name] : false;
    }

    /**
     * Sets content of a block.
     *
     * @param string $name Block's name.
     * @param string $content Block's content.
     */
    public function set($name, $content)
    {
        $this->blocks[$name] = $content;
    }

    /**
     * Checks if a block exists in the storage.
     *
     * @param string $name Block's name
     * @return boolean
     */
    public function has($name)
    {
        return isset($this->blocks[$name]);
    }

    /**
     * Removes block from the storage.
     *
     * @param string $name Block's name.
     */
    public function remove($name)
    {
        unset($this->blocks[$name]);
    }

    /**
     * Removes all blocks from the storage.
     */
    public function clear()
    {
        $this->blocks = array();
    }
}
