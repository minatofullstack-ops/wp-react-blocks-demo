/**
 * Line icons for the service card block (24x24, stroke based).
 *
 * The icon is chosen by key and serialized as inline SVG, so editors pick from
 * a fixed, on-brand set instead of uploading arbitrary images.
 */

/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';

const PATHS = {
	strategy: [ 'M3 3v18h18', 'M7 14l4-4 3 3 5-6', 'M15 7h4v4' ],
	design: [ 'M12 20h9', 'M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z' ],
	code: [ 'M8 6l-6 6 6 6', 'M16 6l6 6-6 6', 'M14 4l-4 16' ],
	media: [ 'M4 4h16v12H4Z', 'M8 20h8', 'M12 16v4', 'M8 8h8', 'M8 12h5' ],
	search: [ 'M11 18a7 7 0 1 0 0-14 7 7 0 0 0 0 14Z', 'M21 21l-5-5' ],
	megaphone: [
		'M3 11v2a1 1 0 0 0 1 1h3l6 4V6L7 10H4a1 1 0 0 0-1 1Z',
		'M17 9a4 4 0 0 1 0 6',
	],
};

export const ICON_OPTIONS = [
	{ value: 'strategy', label: __( '戦略・分析', 'lumen-blocks' ) },
	{ value: 'design', label: __( 'デザイン', 'lumen-blocks' ) },
	{ value: 'code', label: __( '開発', 'lumen-blocks' ) },
	{ value: 'media', label: __( 'メディア', 'lumen-blocks' ) },
	{ value: 'search', label: __( 'SEO', 'lumen-blocks' ) },
	{ value: 'megaphone', label: __( '広告・集客', 'lumen-blocks' ) },
];

/**
 * Inline SVG icon (decorative).
 *
 * @param {Object} props      Props.
 * @param {string} props.name Icon key.
 * @return {Element|null} SVG element.
 */
export function Icon( { name } ) {
	const paths = PATHS[ name ];
	if ( ! paths ) {
		return null;
	}
	return (
		<svg
			className="lumen-icon"
			xmlns="http://www.w3.org/2000/svg"
			viewBox="0 0 24 24"
			width="28"
			height="28"
			fill="none"
			stroke="currentColor"
			strokeWidth="1.75"
			strokeLinecap="round"
			strokeLinejoin="round"
			aria-hidden="true"
			focusable="false"
		>
			{ paths.map( ( d ) => (
				<path key={ d } d={ d } />
			) ) }
		</svg>
	);
}
