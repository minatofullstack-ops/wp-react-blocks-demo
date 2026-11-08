/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';

/**
 * Internal dependencies
 */
import metadata from './block.json';
import Edit from './edit';
import './style.scss';

/*
 * Dynamic block: markup is produced by render.php, so `save` returns null and
 * only the attributes are stored in post content. Markup changes therefore
 * never invalidate saved posts.
 */
registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
