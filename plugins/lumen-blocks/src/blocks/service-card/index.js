/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';
import { RichText, useBlockProps } from '@wordpress/block-editor';

/**
 * Internal dependencies
 */
import metadata from './block.json';
import Edit from './edit';
import { Icon } from '../../utils/icons';
import './editor.scss';

registerBlockType( metadata.name, {
	edit: Edit,
	save( { attributes } ) {
		const { icon, title, text, url, linkText } = attributes;
		return (
			<article
				{ ...useBlockProps.save( { className: 'lumen-service-card' } ) }
			>
				<span className="lumen-service-card__icon">
					<Icon name={ icon } />
				</span>
				<RichText.Content
					tagName="h3"
					className="lumen-service-card__title"
					value={ title }
				/>
				<RichText.Content
					tagName="p"
					className="lumen-service-card__text"
					value={ text }
				/>
				{ url && (
					<a className="lumen-service-card__link" href={ url }>
						{ linkText }
						<span aria-hidden="true">→</span>
					</a>
				) }
			</article>
		);
	},
} );
