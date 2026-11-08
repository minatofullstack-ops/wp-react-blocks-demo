/**
 * Build distributable ZIPs into dist/.
 *
 *   npm run zip           -> dist/lumen-blocks.zip + dist/lumen.zip
 *   npm run plugin-zip    -> dist/lumen-blocks.zip
 *   npm run theme-zip     -> dist/lumen.zip
 *
 * The plugin ZIP contains the compiled build/ folder but not src/, so it can
 * be installed on any WordPress site without Node.js. Run `npm run build` first.
 */
import { createWriteStream, existsSync, mkdirSync } from 'node:fs';
import { dirname, join } from 'node:path';
import { fileURLToPath } from 'node:url';
import { ZipArchive } from 'archiver';

const root = join( dirname( fileURLToPath( import.meta.url ) ), '..' );
const dist = join( root, 'dist' );

const packages = {
	plugin: {
		name: 'lumen-blocks',
		dir: join( root, 'plugins/lumen-blocks' ),
		include: [
			'lumen-blocks.php',
			'readme.txt',
			'includes/**',
			'build/**',
			'demo/**',
			'languages/**',
		],
		required: 'build/blocks-manifest.php',
	},
	theme: {
		name: 'lumen',
		dir: join( root, 'themes/lumen' ),
		include: [ '**' ],
		required: 'theme.json',
	},
};

function zipPackage( { name, dir, include, required } ) {
	if ( ! existsSync( join( dir, required ) ) ) {
		throw new Error(
			`${ name }: ${ required } not found. Did you run "npm run build"?`
		);
	}
	mkdirSync( dist, { recursive: true } );
	const target = join( dist, `${ name }.zip` );

	return new Promise( ( resolve, reject ) => {
		const output = createWriteStream( target );
		const archive = new ZipArchive( { zlib: { level: 9 } } );
		output.on( 'close', () => {
			console.log( `✔ ${ target } (${ archive.pointer() } bytes)` );
			resolve();
		} );
		archive.on( 'error', reject );
		archive.pipe( output );
		for ( const pattern of include ) {
			archive.glob(
				pattern,
				{
					cwd: dir,
					ignore: [ '**/.DS_Store', 'src/**', 'node_modules/**' ],
					dot: false,
				},
				{ prefix: name }
			);
		}
		archive.finalize();
	} );
}

const only = process.argv[ 2 ];
const selected = only ? [ packages[ only ] ] : Object.values( packages );
if ( selected.includes( undefined ) ) {
	throw new Error( `Unknown package "${ only }". Use "plugin" or "theme".` );
}
for ( const pkg of selected ) {
	await zipPackage( pkg );
}
