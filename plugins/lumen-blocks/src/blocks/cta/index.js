/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import {
	RichText,
	useBlockProps,
	useInnerBlocksProps,
} from '@wordpress/block-editor';

/**
 * Internal dependencies
 */
import metadata from './block.json';
import './style.scss';

const BUTTONS_TEMPLATE = [
	[
		'core/buttons',
		{},
		[
			[
				'core/button',
				{
					text: 'お問い合わせ',
					url: '/contact/',
					className: 'is-style-fill',
				},
			],
		],
	],
];

function Edit( { attributes, setAttributes } ) {
	const { eyebrow, heading, text } = attributes;
	const innerBlocksProps = useInnerBlocksProps(
		{ className: 'lumen-cta__actions' },
		{
			allowedBlocks: [ 'core/buttons' ],
			template: BUTTONS_TEMPLATE,
			templateLock: 'insert',
		}
	);

	return (
		<section { ...useBlockProps( { className: 'lumen-cta' } ) }>
			<div className="lumen-cta__body">
				<RichText
					tagName="p"
					className="lumen-cta__eyebrow"
					value={ eyebrow }
					onChange={ ( value ) =>
						setAttributes( { eyebrow: value } )
					}
					placeholder={ __( '小見出し（任意）', 'lumen-blocks' ) }
					allowedFormats={ [] }
				/>
				<RichText
					tagName="h2"
					className="lumen-cta__title"
					value={ heading }
					onChange={ ( value ) =>
						setAttributes( { heading: value } )
					}
					placeholder={ __( '見出しを入力', 'lumen-blocks' ) }
					allowedFormats={ [ 'core/bold' ] }
				/>
				<RichText
					tagName="p"
					className="lumen-cta__text"
					value={ text }
					onChange={ ( value ) => setAttributes( { text: value } ) }
					placeholder={ __( '説明文を入力', 'lumen-blocks' ) }
				/>
			</div>
			<div { ...innerBlocksProps } />
		</section>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save( { attributes } ) {
		const { eyebrow, heading, text } = attributes;
		const innerBlocksProps = useInnerBlocksProps.save( {
			className: 'lumen-cta__actions',
		} );
		return (
			<section { ...useBlockProps.save( { className: 'lumen-cta' } ) }>
				<div className="lumen-cta__body">
					{ ! RichText.isEmpty( eyebrow ) && (
						<RichText.Content
							tagName="p"
							className="lumen-cta__eyebrow"
							value={ eyebrow }
						/>
					) }
					<RichText.Content
						tagName="h2"
						className="lumen-cta__title"
						value={ heading }
					/>
					{ ! RichText.isEmpty( text ) && (
						<RichText.Content
							tagName="p"
							className="lumen-cta__text"
							value={ text }
						/>
					) }
				</div>
				<div { ...innerBlocksProps } />
			</section>
		);
	},
} );
