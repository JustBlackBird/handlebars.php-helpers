<?php
/*
 * This file is part of Handlebars.php Helpers Set
 *
 * (c) Dmitriy Simushev <simushevds@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JustBlackBird\HandlebarsHelpers\Layout;

use Handlebars\Context;
use Handlebars\Helper as HelperInterface;
use Handlebars\Template;

/**
 * A helper for defining default content of a block.
 *
 * Usage:
 * ```handlebars
 *   {{#block name}}
 *     Default content for the block
 *   {{/block}}
 * ```
 *
 * Arguments:
 *  - "name": Name of the block.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class BlockHelper extends AbstractBlockHelper implements HelperInterface
{
    /**
     * {@inheritdoc}
     */
    public function execute(Template $template, Context $context, $args, $source)
    {
        // Get block name
        $parsed_args = $template->parseArguments($args);
        if (count($parsed_args) != 1) {
            throw new \InvalidArgumentException(
                '"block" helper expects exactly one argument.'
            );
        }
        $block_name = $context->get(array_shift($parsed_args));

        // If the block is not overridden render and show the default value
        if (!$this->blocksStorage->has($block_name)) {
            return $template->render($context);
        }

        $content = $this->blocksStorage->get($block_name);

        // Show overridden content
        return $content;
    }
}
