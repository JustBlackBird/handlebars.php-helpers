<?php
/*
 * This file is part of Handlebars.php Helpers Set
 *
 * (c) Dmitriy Simushev <simushevds@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JustBlackBird\HandlebarsHelpers\Text;

use Handlebars\Context;
use Handlebars\Helper as HelperInterface;
use Handlebars\Template;

/**
 * Helper for replacing substrings.
 *
 * Usage:
 * ```handlebars
 *   {{#replace search replacement}}Target string to search in.{{/replace}}
 * ```
 *
 * Arguments:
 *  - "search": The value that should be replaced.
 *  - "replacement": The value that should be use as a replacement.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class ReplaceHelper implements HelperInterface
{
    /**
     * {@inheritdoc}
     */
    public function execute(Template $template, Context $context, $args, $source)
    {
        $parsed_args = $template->parseArguments($args);
        if (count($parsed_args) != 2) {
            throw new \InvalidArgumentException(
                '"replace" helper expects exactly two arguments.'
            );
        }

        $search = $context->get($parsed_args[0]);
        $replacement = $context->get($parsed_args[1]);
        $subject = (string)$template->render($context);

        return str_replace($search, $replacement, $subject);
    }
}
