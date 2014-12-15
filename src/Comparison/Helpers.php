<?php
/*
 * This file is part of Handlebars.php Helpers Set
 *
 * (c) Dmitriy Simushev <simushevds@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JustBlackBird\HandlebarsHelpers\Comparison;

use Handlebars\Helpers as BaseHelpers;

/**
 * Contains all comparison related helpers.
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

        $this->add('ifAny', new IfAnyHelper());
        $this->add('ifEqual', new IfEqualHelper());
        $this->add('ifEven', new IfEvenHelper());
        $this->add('ifOdd', new IfOddHelper());
        $this->add('unlessEqual', new UnlessEqualHelper());
    }
}
