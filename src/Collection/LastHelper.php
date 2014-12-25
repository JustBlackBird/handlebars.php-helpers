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
 * Returns the last item of the collection.
 *
 * If the passed in collection is empty boolean false will be returned.
 *
 * Usage:
 * ```handlebars
 *   {{last collection}}
 * ```
 *
 * Arguments:
 *  - "collection": an array or an instance of \Traversable which last element
 *    should be returned.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class LastHelper implements HelperInterface
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
        if (!is_array($collection) && !($collection instanceof \Traversable)) {
            throw new \InvalidArgumentException('Wrong type of the argument in the "last" helper.');
        }

        if (is_array($collection)) {
            return end($collection);
        }

        // "end" function does not work with \Traversable in HHVM. Thus we
        // need to get the element manually.
        while ($collection instanceof \IteratorAggregate) {
            $collection = $collection->getIterator();
        }

        $collection->rewind();
        $item = false;
        while ($collection->valid()) {
            $item = $collection->current();
            $collection->next();
        }

        return $item;
    }
}
