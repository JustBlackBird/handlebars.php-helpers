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
 * Returns the first item of the collection.
 *
 * If the passed in collection is empty boolean false will be returned.
 *
 * Usage:
 * ```handlebars
 *   {{first collection}}
 * ```
 *
 * Arguments:
 *  - "collection": an array or an instance of \Traversable which first element
 *    should be returned.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class FirstHelper implements HelperInterface
{
    /**
     * {@inheritdoc}
     */
    public function execute(Template $template, Context $context, $args, $source)
    {
        $parsed_args = $template->parseArguments($args);
        if (count($parsed_args) != 1) {
            throw new \InvalidArgumentException(
                '"first" helper expects exactly one argument.'
            );
        }
        $collection = $context->get($parsed_args[0]);

        return reset($collection);
    }
}
