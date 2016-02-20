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
 * Truncates a string to specified length.
 *
 * Usage:
 * ```handlebars
 *   {{truncate string length append}}
 * ```
 *
 * Arguments:
 *  - "string": A string that must be truncated.
 *  - "length": A number of characters to limit the string.
 *  - "append": A string to append if charaters are omitted. Default value is an
 *    empty string.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
class TruncateHelper implements HelperInterface
{
    /**
     * {@inheritdoc}
     */
    public function execute(Template $template, Context $context, $args, $source)
    {
        $parsed_args = $template->parseArguments($args);
        if (count($parsed_args) < 2 || count($parsed_args) > 3) {
            throw new \InvalidArgumentException(
                '"truncate" helper expects two or three arguments.'
            );
        }

        $string = (string)$context->get($parsed_args[0]);
        $length = intval($context->get($parsed_args[1]));
        $append = isset($parsed_args[2]) ? (string)$context->get($parsed_args[2]) : '';

        if ($length < 0) {
            throw new \InvalidArgumentException(
                'The second argument of "truncate" helper has to be greater than or equal to 0.'
            );
        }

        if ($append && strlen($append) > $length) {
            throw new \InvalidArgumentException(
                'Cannot truncate string. Length of append value is greater than target length.'
            );
        }

        if (strlen($string) > $length) {
            return substr($string, 0, $length - strlen($append)) . $append;
        } else {
            return $string;
        }
    }
}
