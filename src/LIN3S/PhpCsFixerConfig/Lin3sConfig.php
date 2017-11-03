<?php

/*
 * This file is part of the PhpCsFixerConfig library.
 *
 * Copyright (c) 2017-present LIN3S <info@lin3s.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace LIN3S\PhpCsFixerConfig;

use PhpCsFixer\Config;
use PhpCsFixer\Fixer\Comment\HeaderCommentFixer;

/**
 * @author Beñat Espiña <benatespina@gmail.com>
 */
final class Lin3sConfig extends Config
{
    const HEADER = <<<EOF
This file is part of the %s %s.

Copyright (c) %s-present LIN3S <info@lin3s.com>

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
EOF;

    private $name;
    private $year;
    private $type;
    private $isPhpSpec;

    public function __construct($name, $year, $type = 'project', $isPhpSpec = false)
    {
        parent::__construct('lin3s');
        $this->setRiskyAllowed(true);
        $this->isPhpSpec = $isPhpSpec;
        $this->name = $name;
        $this->type = $type;
        $this->year = $year;
    }

    public function getRules() : array
    {
        $rules = [
            '@Symfony'                                    => true,
            '@Symfony:risky'                              => true,
            'array_syntax'                                => [
                'syntax' => 'short',
            ],
            'binary_operator_spaces'                      => [
                'align_double_arrow' => true,
                'align_equals'       => false,
            ],
            'blank_line_after_opening_tag'                => true,
            'blank_line_before_return'                    => true,
            'cast_spaces'                                 => true,
            'class_keyword_remove'                        => false,
            'combine_consecutive_unsets'                  => true,
            'concat_space'                                => [
                'spacing' => 'one',
            ],
            'declare_equal_normalize'                     => true,
            'declare_strict_types'                        => true,
            'ereg_to_preg'                                => true,
            'function_typehint_space'                     => true,
            'general_phpdoc_annotation_remove'            => true,
            'hash_to_slash_comment'                       => true,
            'header_comment'                              => [
                'header'      => $this->header(),
                'commentType' => HeaderCommentFixer::HEADER_COMMENT,
                'location'    => 'after_open',
            ],
            'include'                                     => true,
            'is_null'                                     => [
                'use_yoda_style' => true,
            ],
            'linebreak_after_opening_tag'                 => true,
            'lowercase_cast'                              => true,
            'mb_str_functions'                            => true,
            'method_separation'                           => true,
            'modernize_types_casting'                     => true,
            'native_function_casing'                      => true,
            'native_function_invocation'                  => false,
            'new_with_braces'                             => true,
            'no_alias_functions'                          => true,
            'no_blank_lines_after_class_opening'          => true,
            'no_blank_lines_after_phpdoc'                 => true,
            'no_blank_lines_before_namespace'             => false,
            'no_empty_comment'                            => true,
            'no_empty_phpdoc'                             => true,
            'no_empty_statement'                          => true,
            'no_extra_consecutive_blank_lines'            => [
                'break',
                'continue',
                'curly_brace_block',
                'extra',
                'parenthesis_brace_block',
                'return',
                'square_brace_block',
                'throw',
                'use',
                'useTrait',
            ],
            'no_leading_import_slash'                     => true,
            'no_leading_namespace_whitespace'             => true,
            'no_mixed_echo_print'                         => [
                'use' => 'echo',
            ],
            'no_multiline_whitespace_around_double_arrow' => true,
            'no_multiline_whitespace_before_semicolons'   => true,
            'no_php4_constructor'                         => true,
            'no_short_bool_cast'                          => true,
            'no_short_echo_tag'                           => true,
            'no_singleline_whitespace_before_semicolons'  => true,
            'no_spaces_around_offset'                     => true,
            'no_trailing_comma_in_list_call'              => true,
            'no_trailing_comma_in_singleline_array'       => true,
            'no_unneeded_control_parentheses'             => true,
            'no_unreachable_default_argument_value'       => true,
            'no_unused_imports'                           => true,
            'no_useless_else'                             => true,
            'no_useless_return'                           => false,
            'no_whitespace_before_comma_in_array'         => true,
            'no_whitespace_in_blank_line'                 => true,
            'normalize_index_brace'                       => true,
            'not_operator_with_space'                     => false,
            'not_operator_with_successor_space'           => false,
            'object_operator_without_whitespace'          => true,
            'ordered_class_elements'                      => false,
            'ordered_imports'                             => true,
            'php_unit_construct'                          => false,
            'php_unit_dedicate_assert'                    => false,
            'php_unit_fqcn_annotation'                    => true,
            'php_unit_strict'                             => false,
            'pow_to_exponentiation'                       => false,
            'pre_increment'                               => true,
            'protected_to_private'                        => true,
            'psr0'                                        => false,
            'psr4'                                        => true,
            'random_api_migration'                        => true,
            'return_type_declaration'                     => [
                'space_before' => 'one',
            ],
            'self_accessor'                               => false,
            'semicolon_after_instruction'                 => true,
            'short_scalar_cast'                           => true,
            'silenced_deprecation_error'                  => false,
            'simplified_null_return'                      => false,
            'single_blank_line_before_namespace'          => true,
            'single_quote'                                => true,
            'space_after_semicolon'                       => true,
            'standardize_not_equals'                      => true,
            'strict_comparison'                           => true,
            'strict_param'                                => true,
            'ternary_operator_spaces'                     => true,
            'ternary_to_null_coalescing'                  => true,
            'trailing_comma_in_multiline_array'           => true,
            'trim_array_spaces'                           => true,
            'unary_operator_spaces'                       => true,
            'whitespace_after_comma_in_array'             => true,
        ];

        $rules = $this->setPhpSpecRules($rules);

        return $rules;
    }

    private function header() : string
    {
        return sprintf(self::HEADER, $this->name, $this->type, $this->year);
    }

    private function setPhpSpecRules(array $rules) : array
    {
        if (true === $this->isPhpSpec) {
            $rules = array_merge($rules, [
                'visibility_required' => false,
            ]);
        }

        return $rules;
    }
}
