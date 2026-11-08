/**
 * WordPress dependencies
 */
import {
	RichText,
	useBlockProps,
	useInnerBlocksProps,
} from '@wordpress/block-editor';

/**
 * Internal dependencies
 */
import { objectPosition } from './shared';

/**
 * v1.1 markup: the background is a real <img> (lazy-loading/srcset/LCP friendly,
 * focal point via object-position) instead of a CSS background-image.
 * See deprecated.js for the v1.0 markup and its migration.
 *
 * @param {Object} props            Block props.
 * @param {Object} props.attributes Attributes.
 * @return {Element} Saved markup.
 */
export default function save( { attributes } ) {
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

	const blockProps = useBlockProps.save( {
		className: 'lumen-hero',
		style: { minHeight: minHeight ? `${ minHeight }px` : undefined },
	} );
	const innerBlocksProps = useInnerBlocksProps.save( {
		className: 'lumen-hero__actions',
	} );

	return (
		<section { ...blockProps }>
			{ mediaUrl && (
				<img
					className={ `lumen-hero__media${
						mediaId ? ` wp-image-${ mediaId }` : ''
					}` }
					src={ mediaUrl }
					alt=""
					style={ { objectPosition: objectPosition( focalPoint ) } }
				/>
			) }
			<span
				className="lumen-hero__overlay"
				aria-hidden="true"
				style={ { opacity: dimRatio / 100 } }
			/>
			<div className="lumen-hero__inner">
				{ ! RichText.isEmpty( eyebrow ) && (
					<RichText.Content
						tagName="p"
						className="lumen-hero__eyebrow"
						value={ eyebrow }
					/>
				) }
				<RichText.Content
					tagName="h1"
					className="lumen-hero__title"
					value={ heading }
				/>
				{ ! RichText.isEmpty( lead ) && (
					<RichText.Content
						tagName="p"
						className="lumen-hero__lead"
						value={ lead }
					/>
				) }
				<div { ...innerBlocksProps } />
			</div>
		</section>
	);
}
