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
 * Conditional helper that checks if specified argument is even or not.
 *
 * Example of usage:
 * ```handlebars
 *   {{#ifEven value}}
 *     The value is even.
 *   {{else}}
 *     The value is odd.
 *   {{/ifEven}}
 * ```
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class IfEvenHelper implements HelperInterface
{
    /**
     * {@inheritdoc}
     */
    public function execute(Template $template, Context $context, $args, $source)
    {
        $parsed_args = $template->parseArguments($args);
        if (count($parsed_args) != 1) {
            throw new \InvalidArgumentException(
                '"ifEven" helper expects exactly one argument.'
            );
        }

        $condition = ($context->get($parsed_args[0]) % 2 == 0);

        if ($condition) {
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
