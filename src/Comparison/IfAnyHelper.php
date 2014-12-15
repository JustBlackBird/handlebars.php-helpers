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
use Handlebars\String;
use Handlebars\Template;

/**
 * Conditional helper that checks if at least one argumet can be treated as
 * "true" value.
 *
 * Usage:
 * ```handlebars
 *   {{#ifAny first second third}}
 *     At least one of argument can be threated as "true".
 *   {{else}}
 *     All values are "falsy"
 *   {{/ifAny}}
 * ```
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class IfAnyHelper implements HelperInterface
{
    /**
     * {@inheritdoc}
     */
    public function execute(Template $template, Context $context, $args, $source)
    {
        $parsed_args = $template->parseArguments($args);
        if (count($parsed_args) == 0) {
            throw new \InvalidArgumentException(
                '"ifAny" helper expects at least one argument.'
            );
        }

        $condition = false;
        foreach ($parsed_args as $parsed_arg) {
            $value = $context->get($parsed_arg);

            if ($value instanceof String) {
                // Casting any object of \Handlebars\String will have false
                // positive result even for those with empty internal strings.
                // Thus we need to check internal string of such objects.
                $value = $value->getString();
            }

            if ($value) {
                $condition = true;
                break;
            }
        }

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
