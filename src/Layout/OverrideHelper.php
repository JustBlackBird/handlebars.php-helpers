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
 * A helper for overriding content of a block.
 *
 * One or more "override" blocks must be wrapped with
 * {@link \JustBlackBird\HandlebarsHelpers\Layout\ExtendsHelper} helper.
 *
 * Usage:
 * ```handlebars
 *   {{#override blockName}}
 *     Overridden content of the block.
 *   {{/override}}
 * ```
 *
 * Arguments:
 *  - blockName: Name of the block which should be overridden.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class OverrideHelper extends AbstractBlockHelper implements HelperInterface
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
                '"override" helper expects exactly one argument.'
            );
        }
        $block_name = $context->get(array_shift($parsed_args));

        // We need to provide unlimited inheritence level. Rendering is started
        // from the deepest level template. If the content is in the block
        // storage it is related with the deepest level template. Thus we do not
        // need to override it.
        if (!$this->blocksStorage->has($block_name)) {
            $this->blocksStorage->set($block_name, $template->render($context));
        }
    }
}
