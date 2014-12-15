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

        // Comparison helpers
        $this->add('ifEqual', new Comparison\IfEqualHelper());
        $this->add('ifEven', new Comparison\IfEvenHelper());
        $this->add('ifOdd', new Comparison\IfOddHelper());
        $this->add('unlessEqual', new Comparison\UnlessEqualHelper());

        // String helpers
        $this->add('lowercase', new String\LowercaseHelper());
        $this->add('uppercase', new String\UppercaseHelper());
    }
}
