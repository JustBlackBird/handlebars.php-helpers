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
 * Truncates a string to specified length in words.
 *
 * Usage:
 * ```handlebars
 *   {{#ellipsis string length append}}
 * ```
 *
 * Arguments:
 *  - "string": A string that must be truncated.
 *  - "length": A number of words to limit the string.
 *  - "append": A string to append if charaters are omitted. Default value is an
 *    empty string.
 *
 * @author Matteo Merola <mattmezza@gmail.com>
 */
class EllipsisHelper implements HelperInterface
{
    /**
     * {@inheritdoc}
     */
    public function execute(Template $template, Context $context, $args, $source)
    {
        $parsed_args = $template->parseArguments($args);
        if (count($parsed_args) < 2 || count($parsed_args) > 3) {
            throw new \InvalidArgumentException(
                '"ellipsis" helper expects two or three arguments.'
            );
        }
        $var_content = (string)$context->get($parsed_args[0]);
        $limit = intval($context->get($parsed_args[1]));
        $ellipsis = isset($parsed_args[2]) ? (string)$context->get($parsed_args[2]) : '';
        if ($limit === 0) {
            return $ellipsis;
        }
        if ($limit < 0) {
            throw new \InvalidArgumentException(
                'The second argument of "ellipsis" helper has to be greater than or equal to 0.'
            );
        }
        $words = str_word_count($var_content, 2);
        $value = "";
        if (count($words) > $limit) {
            $permitted = array_slice($words, 0, $limit, true);
            end($permitted);
            $last_word_position = key($permitted);
            $last_word = $permitted[$last_word_position];
            $last_word_length = strlen($last_word);
            $real_limit = $last_word_position + $last_word_length;
            $value = substr($var_content, 0, $real_limit);
        } else {
            $value .= $var_content;
        }
        if ($ellipsis) {
            $value .= $ellipsis;
        }

        return $value;
    }
}
