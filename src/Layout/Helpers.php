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

use Handlebars\Helpers as BaseHelpers;

/**
 * Contains all layout helpers.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class Helpers extends BaseHelpers
{
    /**
     * {@inheritdoc}
     */
    protected function addDefaultHelpers()
    {
        parent::addDefaultHelpers();

        $storage = new BlockStorage();
        $this->add('block', new BlockHelper($storage));
        $this->add('extends', new ExtendsHelper($storage));
        $this->add('override', new OverrideHelper($storage));
        $this->add('ifOverridden', new IfOverriddenHelper($storage));
        $this->add('unlessOverridden', new UnlessOverriddenHelper($storage));
    }
}
