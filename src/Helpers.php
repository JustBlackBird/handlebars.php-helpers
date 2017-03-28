<?php
/*
 * This file is part of Handlebars.php Helpers Set
 *
 * (c) Dmitriy Simushev <simushevds@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JustBlackBird\HandlebarsHelpers;

use Handlebars\Helpers as BaseHelpers;

/**
 * Contains all helpers.
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

        // Date helpers
        $this->add('formatDate', new Date\FormatDateHelper());

        // Collection helpers
        $this->add('count', new Collection\CountHelper());
        $this->add('first', new Collection\FirstHelper());
        $this->add('last', new Collection\LastHelper());

        // Comparison helpers
        $this->add('ifAny', new Comparison\IfAnyHelper());
        $this->add('ifEqual', new Comparison\IfEqualHelper());
        $this->add('ifEven', new Comparison\IfEvenHelper());
        $this->add('ifOdd', new Comparison\IfOddHelper());
        $this->add('unlessEqual', new Comparison\UnlessEqualHelper());

        // Text helpers
        $this->add('lowercase', new Text\LowercaseHelper());
        $this->add('uppercase', new Text\UppercaseHelper());
        $this->add('repeat', new Text\RepeatHelper());
        $this->add('replace', new Text\ReplaceHelper());
        $this->add('truncate', new Text\TruncateHelper());
        $this->add('ellipsis', new Text\EllipsisHelper());

        // Layout helpers
        $storage = new Layout\BlockStorage();
        $this->add('block', new Layout\BlockHelper($storage));
        $this->add('extends', new Layout\ExtendsHelper($storage));
        $this->add('override', new Layout\OverrideHelper($storage));
        $this->add('ifOverridden', new Layout\IfOverriddenHelper($storage));
        $this->add('unlessOverridden', new Layout\UnlessOverriddenHelper($storage));
    }
}
