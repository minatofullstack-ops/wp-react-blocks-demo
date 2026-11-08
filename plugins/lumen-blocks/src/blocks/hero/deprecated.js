/**
 * Block deprecations for lumen/hero.
 *
 * v1.0 rendered the background as an inline CSS `background-image` and stored
 * the image in `backgroundUrl` / `backgroundId`. v1.1 switched to an <img>
 * element (better LCP, lazy-loading and focal point support) and renamed the
 * attributes. Posts saved with v1.0 are detected by this entry and migrated
 * automatically the next time an editor opens them: no "invalid block"
 * warning and no manual work for editors.
 */

/**
 * WordPress dependencies
 */
import { InnerBlocks, RichText, useBlockProps } from '@wordpress/block-editor';

const v1 = {
	apiVersion: 3,
	attributes: {
		backgroundId: {
			type: 'number',
		},
		backgroundUrl: {
			type: 'string',
		},
		minHeight: {
			type: 'number',
			default: 600,
		},
		heading: {
			type: 'string',
			source: 'html',
			selector: '.lumen-hero__title',
		},
		lead: {
			type: 'string',
			source: 'html',
			selector: '.lumen-hero__lead',
		},
		align: {
			type: 'string',
			default: 'full',
		},
	},
	supports: {
		html: false,
		anchor: true,
		align: [ 'wide', 'full' ],
	},
	migrate( attributes, innerBlocks ) {
		const { backgroundId, backgroundUrl, ...rest } = attributes;
		return [
			{
				...rest,
				mediaId: backgroundId,
				mediaUrl: backgroundUrl,
			},
			innerBlocks,
		];
	},
	save( { attributes } ) {
		const { backgroundUrl, minHeight, heading, lead } = attributes;
		const blockProps = useBlockProps.save( {
			className: 'lumen-hero',
			style: {
				backgroundImage: backgroundUrl
					? `url(${ backgroundUrl })`
					: undefined,
				minHeight: minHeight ? `${ minHeight }px` : undefined,
			},
		} );

		return (
			<section { ...blockProps }>
				<div className="lumen-hero__inner">
					<RichText.Content
						tagName="h1"
						className="lumen-hero__title"
						value={ heading }
					/>
					<RichText.Content
						tagName="p"
						className="lumen-hero__lead"
						value={ lead }
					/>
					<div className="lumen-hero__actions">
						<InnerBlocks.Content />
					</div>
				</div>
			</section>
		);
	},
};

export default [ v1 ];
