/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import {
	InnerBlocks,
	InspectorControls,
	RichText,
	useBlockProps,
	useInnerBlocksProps,
} from '@wordpress/block-editor';
import { PanelBody, ToggleControl } from '@wordpress/components';

/**
 * Internal dependencies
 */
import metadata from './block.json';

const ALLOWED_BLOCKS = [ 'core/paragraph', 'core/list', 'core/image' ];
const TEMPLATE = [
	[ 'core/paragraph', { placeholder: __( '回答を入力', 'lumen-blocks' ) } ],
];

function Edit( { attributes, setAttributes } ) {
	const { question, openByDefault } = attributes;

	const blockProps = useBlockProps( {
		className: 'lumen-faq-item is-open',
	} );
	const innerBlocksProps = useInnerBlocksProps(
		{ className: 'lumen-faq-item__answer' },
		{ allowedBlocks: ALLOWED_BLOCKS, template: TEMPLATE }
	);

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( '表示', 'lumen-blocks' ) }>
					<ToggleControl
						__nextHasNoMarginBottom
						label={ __( '最初から開いておく', 'lumen-blocks' ) }
						checked={ openByDefault }
						onChange={ ( value ) =>
							setAttributes( { openByDefault: value } )
						}
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<div className="lumen-faq-item__heading">
					<div className="lumen-faq-item__toggle">
						<span
							className="lumen-faq-item__mark"
							aria-hidden="true"
						>
							Q
						</span>
						<RichText
							tagName="span"
							className="lumen-faq-item__question"
							value={ question }
							onChange={ ( value ) =>
								setAttributes( { question: value } )
							}
							placeholder={ __( '質問を入力', 'lumen-blocks' ) }
							allowedFormats={ [ 'core/bold' ] }
							disableLineBreaks
						/>
					</div>
				</div>
				<div className="lumen-faq-item__panel">
					<span
						className="lumen-faq-item__mark is-answer"
						aria-hidden="true"
					>
						A
					</span>
					<div { ...innerBlocksProps } />
				</div>
			</div>
		</>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => <InnerBlocks.Content />,
} );
