<?php
/*
 * This file is part of Handlebars.php Helpers Set
 *
 * (c) Dmitriy Simushev <simushevds@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JustBlackBird\HandlebarsHelpers\Collection;

use Handlebars\Context;
use Handlebars\Helper as HelperInterface;
use Handlebars\Template;

/**
 * Returns count of items of the collection.
 *
 * Usage:
 * ```handlebars
 *   {{count collection}}
 * ```
 *
 * Arguments:
 *  - "collection": an array or an instance of \Countable which elements should
 *    be counted.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class CountHelper implements HelperInterface
{
    /**
     * {@inheritdoc}
     */
    public function execute(Template $template, Context $context, $args, $source)
    {
        $parsed_args = $template->parseArguments($args);
        if (count($parsed_args) != 1) {
            throw new \InvalidArgumentException(
                '"last" helper expects exactly one argument.'
            );
        }

        $collection = $context->get($parsed_args[0]);
        if (!is_array($collection) && !($collection instanceof \Countable)) {
            throw new \InvalidArgumentException('Wrong type of the argument in the "count" helper.');
        }

        return count($collection);
    }
}
