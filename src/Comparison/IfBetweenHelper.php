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
 * Conditional helper that checks if one value is between two another values.
 *
 * Borders of the interval are excluded from comparison. That's why in cases
 * where the value under comparision is equal to one of the borders the result
 * of "between" operator is false.
 *
 * Example of usage:
 * ```handlebars
 *   {{#ifBetween value leftBorder rightBorder}}
 *     The first argument is between borders.
 *   {{else}}
 *     The first argument is not between the borders.
 *   {{/ifBetween}}
 * ```
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class IfBetweenHelper extends AbstractComparisonHelper implements HelperInterface
{
    /**
     * {@inheritdoc}
     */
    protected function evaluateCondition($args)
    {
        if (count($args) != 3) {
            throw new \InvalidArgumentException(
                '"ifBetween" helper expects exactly three arguments.'
            );
        }

        return ($args[0] > $args[1]) && ($args[0] < $args[2]);
    }
}
