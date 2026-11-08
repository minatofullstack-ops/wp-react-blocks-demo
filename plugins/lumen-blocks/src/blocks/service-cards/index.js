/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, useInnerBlocksProps } from '@wordpress/block-editor';

/**
 * Internal dependencies
 */
import metadata from './block.json';
import Edit from './edit';
import './style.scss';

registerBlockType( metadata.name, {
	edit: Edit,
	save( { attributes } ) {
		const blockProps = useBlockProps.save( {
			className: `lumen-service-cards has-${ attributes.columns }-columns`,
		} );
		return <div { ...useInnerBlocksProps.save( blockProps ) } />;
	},
} );
