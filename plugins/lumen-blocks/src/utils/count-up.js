/**
 * Pure helpers for the 実績・数字 (stats) block.
 *
 * They are shared by the editor preview and the front-end view module and
 * are covered by unit tests (`npm test`).
 */

/**
 * Clamp a number into a range.
 *
 * @param {number} value Value.
 * @param {number} min   Lower bound.
 * @param {number} max   Upper bound.
 * @return {number} Clamped value.
 */
export function clamp( value, min, max ) {
	return Math.min( Math.max( value, min ), max );
}

/**
 * Normalise the number of decimal places (0–2).
 *
 * @param {unknown} decimals Raw attribute value.
 * @return {number} Integer between 0 and 2.
 */
export function normalizeDecimals( decimals ) {
	const parsed = parseInt( decimals, 10 );
	return Number.isFinite( parsed ) ? clamp( parsed, 0, 2 ) : 0;
}

/**
 * Format a number the same way PHP's number_format() does in render.php,
 * so the server-rendered value and the animated value never differ.
 *
 * @param {number|string} value    Number to format.
 * @param {number}        decimals Decimal places (0–2).
 * @return {string} e.g. formatNumber( 1234.5, 1 ) === '1,234.5'
 */
export function formatNumber( value, decimals = 0 ) {
	const number = Number( value );
	if ( ! Number.isFinite( number ) ) {
		return '0';
	}
	const digits = normalizeDecimals( decimals );
	return new Intl.NumberFormat( 'ja-JP', {
		minimumFractionDigits: digits,
		maximumFractionDigits: digits,
	} ).format( number );
}

/**
 * Ease-out cubic easing.
 *
 * @param {number} t Progress 0–1.
 * @return {number} Eased progress 0–1.
 */
export function easeOutCubic( t ) {
	const p = clamp( t, 0, 1 );
	return 1 - Math.pow( 1 - p, 3 );
}

/**
 * Value to display at a given point of the animation.
 *
 * @param {number} target   Final value.
 * @param {number} progress Linear progress 0–1.
 * @param {number} decimals Decimal places.
 * @return {number} Rounded intermediate value.
 */
export function valueAt( target, progress, decimals = 0 ) {
	const factor = Math.pow( 10, normalizeDecimals( decimals ) );
	return Math.round( target * easeOutCubic( progress ) * factor ) / factor;
}
