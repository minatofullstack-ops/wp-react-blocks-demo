/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import {
	BlockControls,
	InspectorControls,
	MediaPlaceholder,
	MediaReplaceFlow,
	RichText,
	useBlockProps,
	useInnerBlocksProps,
} from '@wordpress/block-editor';
import {
	Button,
	FocalPointPicker,
	PanelBody,
	RangeControl,
} from '@wordpress/components';

/**
 * Internal dependencies
 */
import { BUTTONS_TEMPLATE, objectPosition } from './shared';

const ALLOWED_MEDIA_TYPES = [ 'image' ];

export default function Edit( { attributes, setAttributes } ) {
	const {
		mediaId,
		mediaUrl,
		focalPoint,
		dimRatio,
		minHeight,
		eyebrow,
		heading,
		lead,
	} = attributes;

	const onSelectMedia = ( media ) => {
		if ( ! media || ! media.url ) {
			return;
		}
		setAttributes( {
			mediaId: media.id,
			mediaUrl: media.sizes?.full?.url || media.url,
		} );
	};
	const onRemoveMedia = () =>
		setAttributes( { mediaId: undefined, mediaUrl: undefined } );

	const blockProps = useBlockProps( {
		className: 'lumen-hero',
		style: { minHeight: `${ minHeight }px` },
	} );
	const innerBlocksProps = useInnerBlocksProps(
		{ className: 'lumen-hero__actions' },
		{
			allowedBlocks: [ 'core/buttons' ],
			template: BUTTONS_TEMPLATE,
			templateLock: 'insert',
		}
	);

	return (
		<>
			<BlockControls group="other">
				<MediaReplaceFlow
					mediaId={ mediaId }
					mediaURL={ mediaUrl }
					allowedTypes={ ALLOWED_MEDIA_TYPES }
					accept="image/*"
					onSelect={ onSelectMedia }
					name={
						mediaUrl
							? __( '背景画像を変更', 'lumen-blocks' )
							: __( '背景画像を追加', 'lumen-blocks' )
					}
					onReset={ mediaUrl ? onRemoveMedia : undefined }
				/>
			</BlockControls>

			<InspectorControls>
				<PanelBody title={ __( '背景画像', 'lumen-blocks' ) }>
					{ mediaUrl ? (
						<>
							<FocalPointPicker
								__nextHasNoMarginBottom
								label={ __(
									'フォーカルポイント',
									'lumen-blocks'
								) }
								url={ mediaUrl }
								value={ focalPoint }
								onChange={ ( value ) =>
									setAttributes( { focalPoint: value } )
								}
							/>
							<Button
								variant="secondary"
								isDestructive
								onClick={ onRemoveMedia }
							>
								{ __( '背景画像を削除', 'lumen-blocks' ) }
							</Button>
						</>
					) : (
						<MediaPlaceholder
							icon="format-image"
							labels={ {
								title: __( '背景画像', 'lumen-blocks' ),
								instructions: __(
									'画像をアップロードするか、メディアライブラリから選択してください。',
									'lumen-blocks'
								),
							} }
							allowedTypes={ ALLOWED_MEDIA_TYPES }
							accept="image/*"
							onSelect={ onSelectMedia }
						/>
					) }
				</PanelBody>
				<PanelBody title={ __( 'レイアウト', 'lumen-blocks' ) }>
					<RangeControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __(
							'オーバーレイの濃さ（%）',
							'lumen-blocks'
						) }
						help={ __(
							'文字が読みやすい濃さに調整します（推奨 60 以上）。',
							'lumen-blocks'
						) }
						value={ dimRatio }
						onChange={ ( value ) =>
							setAttributes( { dimRatio: value ?? 70 } )
						}
						min={ 0 }
						max={ 100 }
						step={ 10 }
					/>
					<RangeControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __( '最小の高さ（px）', 'lumen-blocks' ) }
						value={ minHeight }
						onChange={ ( value ) =>
							setAttributes( { minHeight: value ?? 640 } )
						}
						min={ 360 }
						max={ 960 }
						step={ 20 }
					/>
				</PanelBody>
			</InspectorControls>

			<section { ...blockProps }>
				{ mediaUrl && (
					<img
						className="lumen-hero__media"
						src={ mediaUrl }
						alt=""
						style={ {
							objectPosition: objectPosition( focalPoint ),
						} }
					/>
				) }
				<span
					className="lumen-hero__overlay"
					aria-hidden="true"
					style={ { opacity: dimRatio / 100 } }
				/>
				<div className="lumen-hero__inner">
					<RichText
						tagName="p"
						className="lumen-hero__eyebrow"
						value={ eyebrow }
						onChange={ ( value ) =>
							setAttributes( { eyebrow: value } )
						}
						placeholder={ __(
							'キャッチ（英字など・任意）',
							'lumen-blocks'
						) }
						allowedFormats={ [] }
					/>
					<RichText
						tagName="h1"
						className="lumen-hero__title"
						value={ heading }
						onChange={ ( value ) =>
							setAttributes( { heading: value } )
						}
						placeholder={ __(
							'メインコピーを入力',
							'lumen-blocks'
						) }
						allowedFormats={ [ 'core/bold' ] }
					/>
					<RichText
						tagName="p"
						className="lumen-hero__lead"
						value={ lead }
						onChange={ ( value ) =>
							setAttributes( { lead: value } )
						}
						placeholder={ __( 'リード文を入力', 'lumen-blocks' ) }
						allowedFormats={ [ 'core/bold', 'core/link' ] }
					/>
					<div { ...innerBlocksProps } />
				</div>
			</section>
		</>
	);
}
