<?php
/**
* Excerpt
* (c) Matteo Merola
*
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
 *   {{#excerpt string length append}}
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
class ExcerptHelper implements HelperInterface
{
    /**
     * {@inheritdoc}
     */
    public function execute(Template $template, Context $context, $args, $source)
    {
        $parsed_args = $template->parseArguments($args);
        if (count($parsed_args) < 2 || count($parsed_args) > 3) {
            throw new \InvalidArgumentException(
                '"excerpt" helper expects two or three arguments.'
            );
        }
        $varContent = (string)$context->get($parsed_args[0]);
        $limit = intval($context->get($parsed_args[1]));
        $ellipsis = isset($parsed_args[2]) ? (string)$context->get($parsed_args[2]) : '';
        if ($limit === 0) {
            return $ellipsis;
        }
        if ($limit < 0) {
            throw new \InvalidArgumentException(
                'The second argument of "excerpt" helper has to be greater than or equal to 0.'
            );
        }
        $words = str_word_count($varContent, 2);
        $value = "";
        if (count($words) > $limit) {
            $permitted = array_slice($words, 0, $limit, true);
            end($permitted);
            $lastWordPosition = key($permitted);
            $lastWord = $permitted[$lastWordPosition];
            $lastWordLength = strlen($lastWord);
            $realLimit = $lastWordPosition+$lastWordLength;
            $value = substr($varContent, 0, $realLimit);
        } else {
            $value .= $varContent;
        }
        if ($ellipsis) {
            $value .= $ellipsis;
        }
        return $value;
    }
}
