/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import {
	InspectorControls,
	useBlockProps,
	useInnerBlocksProps,
} from '@wordpress/block-editor';
import { PanelBody, RangeControl } from '@wordpress/components';

const ALLOWED_BLOCKS = [ 'lumen/service-card' ];

const TEMPLATE = [
	[
		'lumen/service-card',
		{
			icon: 'strategy',
			title: 'Web戦略設計',
			text: 'アクセス解析と競合調査から、成果につながるサイト構成とKPIを設計します。',
		},
	],
	[
		'lumen/service-card',
		{
			icon: 'design',
			title: 'LP・サイト制作',
			text: 'デザインカンプを忠実に再現し、更新しやすいWordPressで構築します。',
		},
	],
	[
		'lumen/service-card',
		{
			icon: 'media',
			title: 'オウンドメディア運用',
			text: '記事企画からSEO改善まで、継続的に読まれるメディアを育てます。',
		},
	],
];

export default function Edit( { attributes, setAttributes } ) {
	const { columns } = attributes;

	const blockProps = useBlockProps( {
		className: `lumen-service-cards has-${ columns }-columns`,
	} );
	const innerBlocksProps = useInnerBlocksProps( blockProps, {
		allowedBlocks: ALLOWED_BLOCKS,
		template: TEMPLATE,
		orientation: 'horizontal',
		renderAppender: false,
	} );

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'レイアウト', 'lumen-blocks' ) }>
					<RangeControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __( 'PCでの列数', 'lumen-blocks' ) }
						help={ __(
							'スマートフォンでは自動的に1列になります。',
							'lumen-blocks'
						) }
						value={ columns }
						onChange={ ( value ) =>
							setAttributes( { columns: value ?? 3 } )
						}
						min={ 2 }
						max={ 4 }
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...innerBlocksProps } />
		</>
	);
}
