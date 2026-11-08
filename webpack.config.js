/**
 * Extends the default config of wp-scripts.
 *
 * Blocks are discovered automatically from every block.json under
 * plugins/lumen-blocks/src. This file only adds one entry point that is not a
 * block: the document sidebar panel for the works post type.
 */
const path = require( 'path' );
const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

const extraEntries = {
	'editor/works-meta': path.resolve(
		__dirname,
		'plugins/lumen-blocks/src/editor/works-meta.js'
	),
};

const withExtraEntries = ( config ) => ( {
	...config,
	entry: async () => {
		const base =
			typeof config.entry === 'function'
				? await config.entry()
				: config.entry;
		return { ...base, ...extraEntries };
	},
} );

// With --experimental-modules the default export is [ scriptConfig, moduleConfig ].
module.exports = Array.isArray( defaultConfig )
	? [ withExtraEntries( defaultConfig[ 0 ] ), ...defaultConfig.slice( 1 ) ]
	: withExtraEntries( defaultConfig );
