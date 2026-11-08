/**
 * External dependencies
 */
import { describe, expect, it } from 'vitest';

/**
 * Internal dependencies
 */
import {
	clamp,
	easeOutCubic,
	formatNumber,
	normalizeDecimals,
	valueAt,
} from '../count-up';

describe( 'formatNumber', () => {
	it( 'adds thousands separators like PHP number_format()', () => {
		expect( formatNumber( 1234567 ) ).toBe( '1,234,567' );
	} );

	it( 'keeps the requested number of decimals', () => {
		expect( formatNumber( 2.4, 1 ) ).toBe( '2.4' );
		expect( formatNumber( 98, 1 ) ).toBe( '98.0' );
		expect( formatNumber( 1234.5, 2 ) ).toBe( '1,234.50' );
	} );

	it( 'accepts numeric strings and rejects garbage', () => {
		expect( formatNumber( '320' ) ).toBe( '320' );
		expect( formatNumber( 'abc' ) ).toBe( '0' );
	} );
} );

describe( 'normalizeDecimals', () => {
	it( 'clamps to 0–2', () => {
		expect( normalizeDecimals( -1 ) ).toBe( 0 );
		expect( normalizeDecimals( '1' ) ).toBe( 1 );
		expect( normalizeDecimals( 5 ) ).toBe( 2 );
		expect( normalizeDecimals( undefined ) ).toBe( 0 );
	} );
} );

describe( 'animation helpers', () => {
	it( 'clamp() bounds values', () => {
		expect( clamp( 5, 0, 1 ) ).toBe( 1 );
		expect( clamp( -5, 0, 1 ) ).toBe( 0 );
	} );

	it( 'easeOutCubic() starts at 0, ends at 1 and is monotonic', () => {
		expect( easeOutCubic( 0 ) ).toBe( 0 );
		expect( easeOutCubic( 1 ) ).toBe( 1 );
		expect( easeOutCubic( 0.5 ) ).toBeGreaterThan( 0.5 );
		expect( easeOutCubic( 2 ) ).toBe( 1 );
	} );

	it( 'valueAt() reaches the exact target and respects decimals', () => {
		expect( valueAt( 320, 1 ) ).toBe( 320 );
		expect( valueAt( 2.4, 1, 1 ) ).toBe( 2.4 );
		expect( valueAt( 100, 0 ) ).toBe( 0 );
		expect( Number.isInteger( valueAt( 333, 0.37 ) ) ).toBe( true );
	} );
} );
