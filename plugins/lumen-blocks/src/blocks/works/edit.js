/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import {
	Disabled,
	PanelBody,
	RangeControl,
	SelectControl,
	ToggleControl,
} from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { store as coreStore } from '@wordpress/core-data';
import ServerSideRender from '@wordpress/server-side-render';

export default function Edit( { attributes, setAttributes, name } ) {
	const { count, category, columns, showExcerpt } = attributes;

	// Terms of the custom taxonomy, fetched through the REST API (show_in_rest).
	const { terms, isResolving } = useSelect( ( select ) => {
		const query = {
			per_page: -1,
			hide_empty: false,
			_fields: 'id,slug,name',
		};
		return {
			terms: select( coreStore ).getEntityRecords(
				'taxonomy',
				'works_category',
				query
			),
			isResolving: select( coreStore ).isResolving( 'getEntityRecords', [
				'taxonomy',
				'works_category',
				query,
			] ),
		};
	}, [] );

	const categoryOptions = [
		{ value: '', label: __( 'すべてのカテゴリー', 'lumen-blocks' ) },
		...( terms || [] ).map( ( term ) => ( {
			value: term.slug,
			label: term.name,
		} ) ),
	];

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( '表示設定', 'lumen-blocks' ) }>
					<RangeControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __( '表示件数', 'lumen-blocks' ) }
						value={ count }
						onChange={ ( value ) =>
							setAttributes( { count: value ?? 3 } )
						}
						min={ 1 }
						max={ 12 }
					/>
					<SelectControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __( 'カテゴリーで絞り込み', 'lumen-blocks' ) }
						value={ category }
						options={ categoryOptions }
						disabled={ isResolving }
						onChange={ ( value ) =>
							setAttributes( { category: value } )
						}
					/>
					<RangeControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __( 'PCでの列数', 'lumen-blocks' ) }
						value={ columns }
						onChange={ ( value ) =>
							setAttributes( { columns: value ?? 3 } )
						}
						min={ 1 }
						max={ 4 }
					/>
					<ToggleControl
						__nextHasNoMarginBottom
						label={ __( '抜粋を表示', 'lumen-blocks' ) }
						checked={ showExcerpt }
						onChange={ ( value ) =>
							setAttributes( { showExcerpt: value } )
						}
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...useBlockProps() }>
				<Disabled>
					<ServerSideRender
						block={ name }
						attributes={ attributes }
						skipBlockSupportAttributes
					/>
				</Disabled>
			</div>
		</>
	);
}
