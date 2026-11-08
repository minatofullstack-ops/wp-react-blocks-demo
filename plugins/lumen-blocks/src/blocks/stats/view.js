/**
 * Front-end behaviour of lumen/stats (Interactivity API, script module).
 *
 * Each item starts from the server-rendered final value. When it scrolls into
 * view the digits count up from 0. Visitors who enabled "reduce motion" keep
 * the static final value.
 */

/**
 * WordPress dependencies
 */
import {
	getContext,
	getElement,
	store,
	withScope,
} from '@wordpress/interactivity';

/**
 * Internal dependencies
 */
import { formatNumber, valueAt } from '../../utils/count-up';

const prefersReducedMotion = () =>
	typeof window.matchMedia === 'function' &&
	window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

store( 'lumen/stats', {
	callbacks: {
		init() {
			const context = getContext();

			if (
				prefersReducedMotion() ||
				! context.duration ||
				typeof window.IntersectionObserver !== 'function'
			) {
				return;
			}

			const { ref } = getElement();
			context.display = formatNumber( 0, context.decimals );

			const animate = withScope( ( start ) => {
				const step = withScope( ( now ) => {
					const progress = Math.min(
						( now - start ) / context.duration,
						1
					);
					context.display = formatNumber(
						valueAt( context.target, progress, context.decimals ),
						context.decimals
					);
					if ( progress < 1 ) {
						window.requestAnimationFrame( step );
					}
				} );
				window.requestAnimationFrame( step );
			} );

			const observer = new window.IntersectionObserver(
				( entries ) => {
					if ( entries.some( ( entry ) => entry.isIntersecting ) ) {
						observer.disconnect();
						animate( window.performance.now() );
					}
				},
				{ threshold: 0.4 }
			);
			observer.observe( ref );

			return () => observer.disconnect();
		},
	},
} );
