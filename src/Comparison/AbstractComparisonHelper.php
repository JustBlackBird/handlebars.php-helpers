<?php

namespace JustBlackBird\HandlebarsHelpers\Comparison;

use Handlebars\Context;
use Handlebars\Helper as HelperInterface;
use Handlebars\Template;

/**
 * Contains base functionality for all helpers related with comparison.
 *
 * @author Dmitriy Simushev <simushevds@gmail.com>
 */
abstract class AbstractComparisonHelper implements HelperInterface
{
    /**
     * {@inheritdoc}
     */
    public function execute(Template $template, Context $context, $args, $source)
    {
        $resolved_args = array();
        foreach ($template->parseArguments($args) as $arg) {
            $resolved_args[] = $context->get($arg);
        }

        if ($this->evaluateCondition($resolved_args)) {
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

    /**
     * Evaluates condition based on helper's arguments.
     *
     * This is a template method which must be overriden in inherited helpers.
     *
     * @param array $args List of resolved arguments passed to the helper.
     * @return bool Indicates if the condition is true or false.
     */
    abstract protected function evaluateCondition($args);
}
