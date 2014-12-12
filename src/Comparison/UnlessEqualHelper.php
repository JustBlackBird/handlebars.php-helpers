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

use Handlebars\Context;
use Handlebars\Helper as HelperInterface;
use Handlebars\Template;

/**
 * Conditional helper that checks if two values are equal or not.
 *
 * Example of usage:
 * ```handlebars
 *   {{#unlessEqual first second}}
 *     The first argument is equal to the second one.
 *   {{else}}
 *     The arguments are not equal.
 *   {{/unlessEqual}}
 * ```
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class UnlessEqualHelper implements HelperInterface
{
    /**
     * {@inheritdoc}
     */
    public function execute(Template $template, Context $context, $args, $source)
    {
        $parsed_args = $template->parseArguments($args);
        if (count($parsed_args) != 2) {
            throw new \InvalidArgumentException(
                '"unlessEqual" helper expects exactly two arguments.'
            );
        }

        $condition = ($context->get($parsed_args[0]) == $context->get($parsed_args[1]));

        if (!$condition) {
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
