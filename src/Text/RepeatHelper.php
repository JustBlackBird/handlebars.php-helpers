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
 * Repeats content specified number of times.
 *
 * Usage:
 * ```handlebars
 *   {{#repeat times}}content to repeat{{/repeat}}
 * ```
 *
 * Arguments:
 *  - "times": How many times content must be repeated. This value must be
 *    greater than or equal to 0 otherwise an exception will be thrown.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class RepeatHelper implements HelperInterface
{
    /**
     * {@inheritdoc}
     */
    public function execute(Template $template, Context $context, $args, $source)
    {
        $parsed_args = $template->parseArguments($args);
        if (count($parsed_args) != 1) {
            throw new \InvalidArgumentException(
                '"repeat" helper expects exactly one argument.'
            );
        }

        $times = intval($context->get($parsed_args[0]));
        if ($times < 0) {
            throw new \InvalidArgumentException(
                'The first argument of "repeat" helper has to be greater than or equal to 0.'
            );
        }
        $string = $template->render($context);

        return str_repeat($string, $times);
    }
}
