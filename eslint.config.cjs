/**
 * ESLint flat config: the wp-scripts defaults plus Node globals for the
 * build scripts in /scripts.
 */
const wpScriptsConfig = require( '@wordpress/scripts/config/eslint.config.cjs' );
const globals = require( 'globals' );

module.exports = [
	...wpScriptsConfig,
	{
		files: [ 'scripts/**/*.mjs', '*.config.js', '*.config.cjs' ],
		languageOptions: {
			globals: globals.node,
		},
		rules: {
			'no-console': 'off',
			'import/no-extraneous-dependencies': 'off',
			'import/default': 'off',
		},
	},
];
