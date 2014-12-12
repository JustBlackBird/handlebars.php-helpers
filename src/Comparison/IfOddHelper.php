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
 * Conditional helper that checks if specified argument is odd or not.
 *
 * Example of usage:
 * ```handlebars
 *   {{#ifOdd value}}
 *     The value is odd.
 *   {{else}}
 *     The value is even.
 *   {{/ifOdd}}
 * ```
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class IfOddHelper implements HelperInterface
{
    /**
     * {@inheritdoc}
     */
    public function execute(Template $template, Context $context, $args, $source)
    {
        $parsed_args = $template->parseArguments($args);
        if (count($parsed_args) != 1) {
            throw new \InvalidArgumentException(
                '"ifOdd" helper expects exactly one argument.'
            );
        }

        $condition = ($context->get($parsed_args[0]) % 2 == 1);

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
