/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import {
	InnerBlocks,
	InspectorControls,
	useBlockProps,
	useInnerBlocksProps,
} from '@wordpress/block-editor';
import { PanelBody, ToggleControl } from '@wordpress/components';

/**
 * Internal dependencies
 */
import metadata from './block.json';
import './style.scss';
import './editor.scss';

const TEMPLATE = [
	[ 'lumen/faq-item', { question: '' } ],
	[ 'lumen/faq-item', { question: '' } ],
];

function Edit( { attributes, setAttributes } ) {
	const innerBlocksProps = useInnerBlocksProps(
		useBlockProps( { className: 'lumen-faq' } ),
		{
			allowedBlocks: [ 'lumen/faq-item' ],
			template: TEMPLATE,
		}
	);

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'SEO', 'lumen-blocks' ) }>
					<ToggleControl
						__nextHasNoMarginBottom
						label={ __(
							'構造化データ（FAQPage）を出力',
							'lumen-blocks'
						) }
						help={ __(
							'検索エンジン向けに質問と回答をJSON-LDで出力します。',
							'lumen-blocks'
						) }
						checked={ attributes.outputSchema }
						onChange={ ( value ) =>
							setAttributes( { outputSchema: value } )
						}
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...innerBlocksProps } />
		</>
	);
}

/*
 * Dynamic wrapper around static inner blocks: only the inner blocks (answers)
 * are saved as HTML; the accordion markup comes from render.php.
 */
registerBlockType( metadata.name, {
	edit: Edit,
	save: () => <InnerBlocks.Content />,
} );
