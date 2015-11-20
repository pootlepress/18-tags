/**
 * jscroll-init.js
 *
 * Initialize the jscroll script
 */
( function() {
	$( document ).ready( function() {
		$( 'div[class^="columns"] + .storefront-sorting' ).hide();

		$( '.site-main' ).jscroll({
		    loadingHtml: '<img src="loading.gif" alt="Loading" /> Loading...',
		    nextSelector: 'a.next',
		    contentSelector: '.scroll-wrap',
		});
	});
} )();
