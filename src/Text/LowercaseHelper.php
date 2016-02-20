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
 * Converts a string to lowercase.
 *
 * Usage:
 * ```handlebars
 *   {{lowercase string}}
 * ```
 *
 * Arguments:
 *  - "string": A string that should be converted to lowercase.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class LowercaseHelper implements HelperInterface
{
    /**
     * {@inheritdoc}
     */
    public function execute(Template $template, Context $context, $args, $source)
    {
        $parsed_args = $template->parseArguments($args);
        if (count($parsed_args) != 1) {
            throw new \InvalidArgumentException(
                '"lowercase" helper expects exactly one argument.'
            );
        }

        return strtolower($context->get($parsed_args[0]));
    }
}
