/**
 * Front-end behaviour of lumen/faq (Interactivity API, script module).
 *
 * - Click / Enter / Space on a question toggles its answer (native <button>).
 * - Arrow Up / Down move focus between questions, Home / End jump to the
 *   first / last one (WAI-ARIA Authoring Practices accordion pattern).
 */

/**
 * WordPress dependencies
 */
import { getContext, store } from '@wordpress/interactivity';

const TOGGLE_SELECTOR = '.lumen-faq-item__toggle';

store( 'lumen/faq', {
	actions: {
		toggle() {
			const context = getContext();
			context.isOpen = ! context.isOpen;
		},
		onKeydown( event ) {
			if ( ! event.target.matches?.( TOGGLE_SELECTOR ) ) {
				return;
			}
			const toggles = Array.from(
				event.currentTarget.querySelectorAll( TOGGLE_SELECTOR )
			);
			const index = toggles.indexOf( event.target );
			let next;
			switch ( event.key ) {
				case 'ArrowDown':
					next = toggles[ ( index + 1 ) % toggles.length ];
					break;
				case 'ArrowUp':
					next =
						toggles[
							( index - 1 + toggles.length ) % toggles.length
						];
					break;
				case 'Home':
					next = toggles[ 0 ];
					break;
				case 'End':
					next = toggles[ toggles.length - 1 ];
					break;
				default:
					return;
			}
			event.preventDefault();
			next.focus();
		},
	},
} );
