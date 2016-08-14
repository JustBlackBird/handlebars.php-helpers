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

use Handlebars\Helper as HelperInterface;

/**
 * Conditional helper that checks if two values are equal or not.
 *
 * Example of usage:
 * ```handlebars
 *   {{#unlessEqual first second}}
 *     The first argument is equal to the second one.
 *   {{else}}
 *     The arguments are not equal.
 *   {{/unlessEqual}}
 * ```
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class UnlessEqualHelper extends AbstractComparisonHelper implements HelperInterface
{
    /**
     * {@inheritdoc}
     */
    protected function evaluateCondition($args)
    {
        if (count($args) != 2) {
            throw new \InvalidArgumentException(
                '"unlessEqual" helper expects exactly two arguments.'
            );
        }

        return ($args[0] != $args[1]);
    }
}
