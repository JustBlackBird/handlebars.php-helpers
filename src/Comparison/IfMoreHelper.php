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
 * Conditional helper that checks if one value is more than another one.
 *
 * By "more" strict inequality is meant. That's why in cases where two equal
 * values are compared the result of the "more" operation is false.
 *
 * Example of usage:
 * ```handlebars
 *   {{#ifMore first second}}
 *     The first argument is more than the second one.
 *   {{else}}
 *     The first argument is less or equal to the second one.
 *   {{/ifMore}}
 * ```
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class IfMoreHelper extends AbstractComparisonHelper implements HelperInterface
{
    /**
     * {@inheritdoc}
     */
    protected function evaluateCondition($args)
    {
        if (count($args) != 2) {
            throw new \InvalidArgumentException(
                '"ifMore" helper expects exactly two arguments.'
            );
        }

        return ($args[0] > $args[1]);
    }
}
