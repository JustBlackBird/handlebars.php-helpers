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
 * Conditional helper that checks if block overridden or not.
 *
 * Usage:
 * ```handlebars
 *   {{#ifOverridden name}}
 *     The block was overridden
 *   {{else}}
 *     The block was not overridden
 *   {{/ifOverridden}}
 * ```
 *
 * Arguments:
 *  - "name": Name of the block.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class IfOverriddenHelper extends AbstractBlockHelper implements HelperInterface
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
                '"ifOverridden" helper expects exactly one argument.'
            );
        }
        $block_name = $context->get(array_shift($parsed_args));

        // Check condition and render blocks
        if ($this->blocksStorage->has($block_name)) {
            $template->setStopToken('else');
            $buffer = $template->render($context);
            $template->setStopToken(false);
        } else {
            $template->setStopToken('else');
            $template->discard();
            $template->setStopToken(false);
            $buffer = $template->render($context);
        }

        return $buffer;
    }
}
