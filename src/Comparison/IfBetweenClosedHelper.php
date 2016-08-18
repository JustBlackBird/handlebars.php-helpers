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
 * Borders of the interval are included into comparison. That's why in cases
 * where the value under comparision is equal to one of the borders the result
 * of "between closed" operator is true.
 *
 * Example of usage:
 * ```handlebars
 *   {{#ifBetweenClosed value leftBorder rightBorder}}
 *     The first argument is between borders.
 *   {{else}}
 *     The first argument is not between the borders.
 *   {{/ifBetweenClosed}}
 * ```
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class IfBetweenClosedHelper extends AbstractComparisonHelper implements HelperInterface
{
    /**
     * {@inheritdoc}
     */
    protected function evaluateCondition($args)
    {
        if (count($args) != 3) {
            throw new \InvalidArgumentException(
                '"ifBetweenClosed" helper expects exactly three arguments.'
            );
        }

        return ($args[0] >= $args[1]) && ($args[0] <= $args[2]);
    }
}
