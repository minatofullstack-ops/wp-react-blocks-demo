/**
 * Helpers shared by edit, save and deprecations.
 */

/**
 * CSS object-position value from a FocalPointPicker value.
 *
 * @param {{x:number,y:number}|undefined} focalPoint Focal point.
 * @return {string|undefined} e.g. "50% 30%".
 */
export function objectPosition( focalPoint ) {
	if ( ! focalPoint ) {
		return undefined;
	}
	const x = Math.round( focalPoint.x * 100 );
	const y = Math.round( focalPoint.y * 100 );
	return `${ x }% ${ y }%`;
}

export const BUTTONS_TEMPLATE = [
	[
		'core/buttons',
		{},
		[
			[ 'core/button', { text: '無料で相談する', url: '/contact/' } ],
			[
				'core/button',
				{
					text: '導入事例を見る',
					url: '/works/',
					className: 'is-style-outline',
				},
			],
		],
	],
];
