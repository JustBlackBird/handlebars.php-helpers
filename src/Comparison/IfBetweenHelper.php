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
 *   {{#ifBetween variable min max}}
 *     The first argument is between min and max
 *   {{else}}
 *     The first argument is not between min and max
 *   {{/ifBetween}}
 * ```
 *
 * @author Jesse Weigert <jesse.weigert@accretivetg.com>
 */
class IfBetweenHelper implements HelperInterface
{
    /**
     * {@inheritdoc}
     */
    public function execute(Template $template, Context $context, $args, $source)
    {
        $parsed_args = $template->parseArguments($args);
        if (count($parsed_args) != 2) {
            throw new \InvalidArgumentException(
                '"ifEqual" helper expects exactly two arguments.'
            );
        }

        $variable = $context->get($parsed_args[0]);
        $min = $context->get($parsed_args[1]);
        $max = $context->get($parsed_args[2]);

        $condition = ($variable >= $min && $variable < $max);

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
