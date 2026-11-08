/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { useState } from '@wordpress/element';
import {
	BlockControls,
	InspectorControls,
	RichText,
	URLInput,
	useBlockProps,
} from '@wordpress/block-editor';
import {
	Button,
	PanelBody,
	Popover,
	TextControl,
	ToolbarButton,
	ToolbarGroup,
} from '@wordpress/components';
import { link, linkOff } from '@wordpress/icons';

/**
 * Internal dependencies
 */
import { Icon, ICON_OPTIONS } from '../../utils/icons';

export default function Edit( { attributes, setAttributes } ) {
	const { icon, title, text, url, linkText } = attributes;
	const [ isEditingLink, setIsEditingLink ] = useState( false );
	const [ popoverAnchor, setPopoverAnchor ] = useState();

	const blockProps = useBlockProps( { className: 'lumen-service-card' } );

	return (
		<>
			<BlockControls>
				<ToolbarGroup>
					<ToolbarButton
						ref={ setPopoverAnchor }
						icon={ link }
						label={ __( 'リンクを設定', 'lumen-blocks' ) }
						onClick={ () => setIsEditingLink( ! isEditingLink ) }
						isPressed={ !! url }
					/>
					{ url && (
						<ToolbarButton
							icon={ linkOff }
							label={ __( 'リンクを解除', 'lumen-blocks' ) }
							onClick={ () =>
								setAttributes( { url: undefined } )
							}
						/>
					) }
				</ToolbarGroup>
			</BlockControls>
			{ isEditingLink && (
				<Popover
					anchor={ popoverAnchor }
					placement="bottom"
					onClose={ () => setIsEditingLink( false ) }
					focusOnMount="firstElement"
				>
					<div className="lumen-link-popover">
						<URLInput
							__nextHasNoMarginBottom
							label={ __( 'リンク先URL', 'lumen-blocks' ) }
							value={ url || '' }
							onChange={ ( value ) =>
								setAttributes( { url: value || undefined } )
							}
						/>
					</div>
				</Popover>
			) }

			<InspectorControls>
				<PanelBody title={ __( 'アイコン', 'lumen-blocks' ) }>
					<div
						className="lumen-icon-picker"
						role="group"
						aria-label={ __( 'アイコンを選択', 'lumen-blocks' ) }
					>
						{ ICON_OPTIONS.map( ( option ) => (
							<Button
								key={ option.value }
								className="lumen-icon-picker__item"
								isPressed={ icon === option.value }
								onClick={ () =>
									setAttributes( { icon: option.value } )
								}
								label={ option.label }
								showTooltip
							>
								<Icon name={ option.value } />
							</Button>
						) ) }
					</div>
				</PanelBody>
				<PanelBody title={ __( 'リンク', 'lumen-blocks' ) }>
					<TextControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __( 'リンクの文言', 'lumen-blocks' ) }
						value={ linkText }
						onChange={ ( value ) =>
							setAttributes( { linkText: value } )
						}
						help={
							url
								? url
								: __(
										'ツールバーのリンクボタンからURLを設定すると表示されます。',
										'lumen-blocks'
									)
						}
					/>
				</PanelBody>
			</InspectorControls>

			<article { ...blockProps }>
				<span className="lumen-service-card__icon">
					<Icon name={ icon } />
				</span>
				<RichText
					tagName="h3"
					className="lumen-service-card__title"
					value={ title }
					onChange={ ( value ) => setAttributes( { title: value } ) }
					placeholder={ __( 'サービス名', 'lumen-blocks' ) }
					allowedFormats={ [] }
				/>
				<RichText
					tagName="p"
					className="lumen-service-card__text"
					value={ text }
					onChange={ ( value ) => setAttributes( { text: value } ) }
					placeholder={ __( 'サービスの説明文', 'lumen-blocks' ) }
					allowedFormats={ [ 'core/bold' ] }
				/>
				{ url && (
					<span className="lumen-service-card__link is-preview">
						{ linkText }
						<span aria-hidden="true">→</span>
					</span>
				) }
			</article>
		</>
	);
}
