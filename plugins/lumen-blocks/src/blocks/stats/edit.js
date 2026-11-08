/**
 * WordPress dependencies
 */
import { __, sprintf } from '@wordpress/i18n';
import {
	InspectorControls,
	RichText,
	useBlockProps,
} from '@wordpress/block-editor';
import {
	Button,
	Flex,
	FlexBlock,
	PanelBody,
	RangeControl,
	SelectControl,
	TextControl,
} from '@wordpress/components';

/**
 * Internal dependencies
 */
import { formatNumber } from '../../utils/count-up';

const MAX_ITEMS = 6;
const NEW_ITEM = {
	value: 100,
	decimals: 0,
	prefix: '',
	suffix: '',
	label: '',
};

export default function Edit( { attributes, setAttributes } ) {
	const { items, duration } = attributes;

	const updateItem = ( index, changes ) =>
		setAttributes( {
			items: items.map( ( item, i ) =>
				i === index ? { ...item, ...changes } : item
			),
		} );
	const removeItem = ( index ) =>
		setAttributes( { items: items.filter( ( _, i ) => i !== index ) } );
	const addItem = () =>
		setAttributes( { items: [ ...items, { ...NEW_ITEM } ] } );
	const moveItem = ( index, offset ) => {
		const next = [ ...items ];
		const [ moved ] = next.splice( index, 1 );
		next.splice( index + offset, 0, moved );
		setAttributes( { items: next } );
	};

	const blockProps = useBlockProps( {
		className: `lumen-stats has-${ items.length }-items`,
	} );

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'アニメーション', 'lumen-blocks' ) }>
					<RangeControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __(
							'カウントアップの時間（ミリ秒）',
							'lumen-blocks'
						) }
						help={ __(
							'0 にするとアニメーションしません。',
							'lumen-blocks'
						) }
						value={ duration }
						onChange={ ( value ) =>
							setAttributes( { duration: value ?? 1600 } )
						}
						min={ 0 }
						max={ 4000 }
						step={ 100 }
					/>
				</PanelBody>
				{ items.map( ( item, index ) => (
					<PanelBody
						key={ index }
						title={ sprintf(
							/* translators: 1: item number, 2: label. */
							__( '項目 %1$d：%2$s', 'lumen-blocks' ),
							index + 1,
							item.label?.replace( /<[^>]+>/g, '' ) ||
								__( '（ラベル未設定）', 'lumen-blocks' )
						) }
						initialOpen={ index === 0 }
					>
						<TextControl
							__nextHasNoMarginBottom
							__next40pxDefaultSize
							type="number"
							label={ __( '数値', 'lumen-blocks' ) }
							value={ item.value }
							step="any"
							onChange={ ( value ) =>
								updateItem( index, {
									value: Number( value ) || 0,
								} )
							}
						/>
						<SelectControl
							__nextHasNoMarginBottom
							__next40pxDefaultSize
							label={ __( '小数点以下の桁数', 'lumen-blocks' ) }
							value={ String( item.decimals ?? 0 ) }
							options={ [
								{ value: '0', label: '0（例：320）' },
								{ value: '1', label: '1（例：2.4）' },
								{ value: '2', label: '2（例：1.25）' },
							] }
							onChange={ ( value ) =>
								updateItem( index, {
									decimals: Number( value ),
								} )
							}
						/>
						<Flex align="flex-start">
							<FlexBlock>
								<TextControl
									__nextHasNoMarginBottom
									__next40pxDefaultSize
									label={ __(
										'前に付ける文字',
										'lumen-blocks'
									) }
									value={ item.prefix ?? '' }
									onChange={ ( value ) =>
										updateItem( index, { prefix: value } )
									}
								/>
							</FlexBlock>
							<FlexBlock>
								<TextControl
									__nextHasNoMarginBottom
									__next40pxDefaultSize
									label={ __( '単位', 'lumen-blocks' ) }
									value={ item.suffix ?? '' }
									onChange={ ( value ) =>
										updateItem( index, { suffix: value } )
									}
								/>
							</FlexBlock>
						</Flex>
						<Flex
							justify="flex-start"
							className="lumen-stats-item-actions"
						>
							<Button
								size="small"
								variant="secondary"
								disabled={ index === 0 }
								onClick={ () => moveItem( index, -1 ) }
							>
								{ __( '前へ', 'lumen-blocks' ) }
							</Button>
							<Button
								size="small"
								variant="secondary"
								disabled={ index === items.length - 1 }
								onClick={ () => moveItem( index, 1 ) }
							>
								{ __( '後ろへ', 'lumen-blocks' ) }
							</Button>
							<Button
								size="small"
								variant="secondary"
								isDestructive
								disabled={ items.length <= 1 }
								onClick={ () => removeItem( index ) }
							>
								{ __( '削除', 'lumen-blocks' ) }
							</Button>
						</Flex>
					</PanelBody>
				) ) }
				<PanelBody>
					<Button
						variant="primary"
						onClick={ addItem }
						disabled={ items.length >= MAX_ITEMS }
					>
						{ __( '項目を追加', 'lumen-blocks' ) }
					</Button>
				</PanelBody>
			</InspectorControls>

			<div { ...blockProps }>
				<dl className="lumen-stats__list">
					{ items.map( ( item, index ) => (
						<div className="lumen-stats__item" key={ index }>
							<RichText
								tagName="dt"
								className="lumen-stats__label"
								value={ item.label }
								onChange={ ( value ) =>
									updateItem( index, { label: value } )
								}
								placeholder={ __( 'ラベル', 'lumen-blocks' ) }
								allowedFormats={ [] }
							/>
							<dd className="lumen-stats__value">
								{ item.prefix && (
									<span className="lumen-stats__affix">
										{ item.prefix }
									</span>
								) }
								<span className="lumen-stats__number">
									{ formatNumber(
										item.value,
										item.decimals
									) }
								</span>
								{ item.suffix && (
									<span className="lumen-stats__affix">
										{ item.suffix }
									</span>
								) }
							</dd>
						</div>
					) ) }
				</dl>
			</div>
		</>
	);
}
