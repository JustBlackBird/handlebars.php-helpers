<?php
/*
 * This file is part of Handlebars.php Helpers Set
 *
 * (c) Dmitriy Simushev <simushevds@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JustBlackBird\HandlebarsHelpers\Text;

use Handlebars\Helpers as BaseHelpers;

/**
 * Contains all strings related helpers.
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

        $this->add('lowercase', new LowercaseHelper());
        $this->add('uppercase', new UppercaseHelper());
        $this->add('repeat', new RepeatHelper());
        $this->add('replace', new ReplaceHelper());
        $this->add('truncate', new TruncateHelper());
        $this->add('ellipsis', new EllipsisHelper());
    }
}
