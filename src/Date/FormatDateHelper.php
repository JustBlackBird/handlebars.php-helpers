<?php
/*
 * This file is part of Handlebars.php Helpers Set
 *
 * (c) Dmitriy Simushev <simushevds@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JustBlackBird\HandlebarsHelpers\Date;

use Handlebars\Context;
use Handlebars\Helper as HelperInterface;
use Handlebars\Template;

/**
 * Format date using PHP's strftime format string.
 *
 * Usage:
 * ```handlebars
 *   {{formatDate time format}}
 * ```
 *
 * Arguments:
 *  - "time": Can be either an integer timestamp or an instance of \DateTime
 *    class.
 *  - "format": Format string. See
 *    {@link http://php.net/manual/en/function.strftime.php} for details about
 *    placeholders.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class FormatDateHelper implements HelperInterface
{
    /**
     * {@inheritdoc}
     */
    public function execute(Template $template, Context $context, $args, $source)
    {
        $parsed_args = $template->parseArguments($args);
        if (count($parsed_args) != 2) {
            throw new \InvalidArgumentException(
                '"formatDate" helper expects exactly two arguments.'
            );
        }

        $raw_time = $context->get($parsed_args[0]);
        if ($raw_time instanceof \DateTime) {
            $timestamp = $raw_time->getTimestamp();
        } else {
            $timestamp = intval($raw_time);
        }
        $format = $context->get($parsed_args[1]);

        return strftime($format, $timestamp);
    }
}
