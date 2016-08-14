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
 * Conditional helper that checks if specified argument is odd or not.
 *
 * Example of usage:
 * ```handlebars
 *   {{#ifOdd value}}
 *     The value is odd.
 *   {{else}}
 *     The value is even.
 *   {{/ifOdd}}
 * ```
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class IfOddHelper extends AbstractComparisonHelper implements HelperInterface
{
    /**
     * {@inheritdoc}
     */
    protected function evaluateCondition($args)
    {
        if (count($args) != 1) {
            throw new \InvalidArgumentException(
                '"ifOdd" helper expects exactly one argument.'
            );
        }

        return ($args[0] % 2 == 1);
    }
}
