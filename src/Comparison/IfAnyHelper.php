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
use Handlebars\StringWrapper;

/**
 * Conditional helper that checks if at least one argumet can be treated as
 * "true" value.
 *
 * Usage:
 * ```handlebars
 *   {{#ifAny first second third}}
 *     At least one of argument can be threated as "true".
 *   {{else}}
 *     All values are "falsy"
 *   {{/ifAny}}
 * ```
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class IfAnyHelper extends AbstractComparisonHelper implements HelperInterface
{
    /**
     * {@inheritdoc}
     */
    protected function evaluateCondition($args)
    {
        if (count($args) == 0) {
            throw new \InvalidArgumentException(
                '"ifAny" helper expects at least one argument.'
            );
        }

        foreach ($args as $value) {
            if ($value instanceof StringWrapper) {
                // Casting any object of \Handlebars\StringWrapper will have
                // false positive result even for those with empty internal
                // strings. Thus we need to check internal string of such
                // objects.
                $value = $value->getString();
            }

            if ($value) {
                return true;
            }
        }

        return false;
    }
}
