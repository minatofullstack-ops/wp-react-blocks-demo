/**
 * "導入事例の情報" panel in the document sidebar of the works post type.
 *
 * Native alternative to an ACF field group: the fields are registered post
 * meta (register_post_meta + show_in_rest) edited with core components, so
 * they are versioned in Git, need no extra plugin, and can be used in block
 * bindings (see the theme template single-works.html).
 */

/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { registerPlugin } from '@wordpress/plugins';
import {
	PluginDocumentSettingPanel,
	store as editorStore,
} from '@wordpress/editor';
import { TextControl } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { useEntityProp } from '@wordpress/core-data';

const FIELDS = [
	{
		key: 'lumen_client',
		label: __( 'クライアント（業種）', 'lumen-blocks' ),
		help: __( '例：BtoB SaaS企業', 'lumen-blocks' ),
	},
	{
		key: 'lumen_result',
		label: __( '成果ハイライト', 'lumen-blocks' ),
		help: __(
			'一覧カードに表示されます。例：問い合わせ数 2.4倍',
			'lumen-blocks'
		),
	},
	{
		key: 'lumen_period',
		label: __( '支援期間', 'lumen-blocks' ),
		help: __( '例：6か月', 'lumen-blocks' ),
	},
];

function WorksMetaPanel() {
	const postType = useSelect(
		( select ) => select( editorStore ).getCurrentPostType(),
		[]
	);
	const [ meta, setMeta ] = useEntityProp( 'postType', 'works', 'meta' );

	if ( postType !== 'works' || ! meta ) {
		return null;
	}

	return (
		<PluginDocumentSettingPanel
			name="lumen-works-meta"
			title={ __( '導入事例の情報', 'lumen-blocks' ) }
			initialOpen
		>
			{ FIELDS.map( ( field ) => (
				<TextControl
					key={ field.key }
					__nextHasNoMarginBottom
					__next40pxDefaultSize
					label={ field.label }
					help={ field.help }
					value={ meta[ field.key ] ?? '' }
					onChange={ ( value ) =>
						setMeta( { ...meta, [ field.key ]: value } )
					}
				/>
			) ) }
		</PluginDocumentSettingPanel>
	);
}

registerPlugin( 'lumen-works-meta', { render: WorksMetaPanel } );
