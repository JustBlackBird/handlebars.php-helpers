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
 * Conditional helper that checks if specified argument is even or not.
 *
 * Example of usage:
 * ```handlebars
 *   {{#ifEven value}}
 *     The value is even.
 *   {{else}}
 *     The value is odd.
 *   {{/ifEven}}
 * ```
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class IfEvenHelper extends AbstractComparisonHelper implements HelperInterface
{
    /**
     * {@inheritdoc}
     */
    protected function evaluateCondition($args)
    {
        if (count($args) != 1) {
            throw new \InvalidArgumentException(
                '"ifEven" helper expects exactly one argument.'
            );
        }

        return ($args[0] % 2 == 0);
    }
}
