<?php
/*
 * This file is part of Handlebars.php Helpers Set
 *
 * (c) Dmitriy Simushev <simushevds@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JustBlackBird\HandlebarsHelpers\Collection;

use Handlebars\Helpers as BaseHelpers;

/**
 * Contains all collections related helpers.
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

        $this->add('count', new CountHelper());
        $this->add('first', new FirstHelper());
        $this->add('last', new LastHelper());
    }
}
