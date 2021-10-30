<?php

$finder = Symfony\Component\Finder\Finder::create()
	->notPath('bootstrap/*')
	->notPath('storage/*')
	->notPath('resources/view/mail/*')
	->in([
		__DIR__ . '/app',
		__DIR__ . '/config',
		__DIR__ . '/database/factories',
		__DIR__ . '/database/seeders',
		__DIR__ . '/resources/lang',
		__DIR__ . '/routes',
		__DIR__ . '/tests',
	])
	->name('*.php')
	->notName('*.blade.php')
	->ignoreDotFiles(true)->ignoreVCS(true);

	return (new PhpCsFixer\Config())
		->setRules([
			'@PSR2'                                  => true,
			'array_indentation'                      => true,
			'array_syntax'                           => ['syntax' => 'short'],
			'combine_consecutive_unsets'             => true,
			'phpdoc_separation'                      => true,
			'multiline_whitespace_before_semicolons' => false,
			'single_quote'                           => true,

			'binary_operator_spaces' => [
				'operators' => ['=>' => 'align_single_space_minimal']
			],
			'no_whitespace_before_comma_in_array' => true,
			'blank_line_before_statement'         => true,
			'braces'                              => [
				'allow_single_line_closure' => true,
			],
			'concat_space'                                => ['spacing' => 'one'],
			'declare_equal_normalize'                     => true,
			'function_typehint_space'                     => true,
			'include'                                     => true,
			'lowercase_cast'                              => true,
			'no_blank_lines_after_phpdoc'                 => true,
			'no_empty_comment'                            => true,
			'no_empty_phpdoc'                             => true,
			'no_multiline_whitespace_around_double_arrow' => true,
			'no_singleline_whitespace_before_semicolons'  => true,
			'no_spaces_around_offset'                     => true,
			'no_unused_imports'                           => true,
			'no_whitespace_before_comma_in_array'         => true,
			'no_whitespace_in_blank_line'                 => true,
			'object_operator_without_whitespace'          => true,
			'phpdoc_align'                                => [
				'align' => 'left',
				'tags'  => [
					'param',
					'return',
					'throws',
					'type',
					'var',
				]
			],
			'phpdoc_indent'                      => true,
			'phpdoc_single_line_var_spacing'     => true,
			'phpdoc_var_without_name'            => true,
			'single_blank_line_before_namespace' => true,
			'ternary_operator_spaces'            => true,
			'trim_array_spaces'                  => true,
			'unary_operator_spaces'              => true,
			'whitespace_after_comma_in_array'    => true,
			'no_extra_blank_lines'               => [
				'tokens' => [
					'break',
					'case',
					'continue',
					'curly_brace_block',
					'default',
					'extra',
					'parenthesis_brace_block',
					'return',
					'square_brace_block',
					'switch',
					'throw',
					'use',
					'use_trait',
				]
			]
		])
		->setIndent("\t")
		->setLineEnding("\n")
		->setFinder($finder);
