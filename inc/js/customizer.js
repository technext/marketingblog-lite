/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */


( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( 'a.navbar-brand' ).text( to );
		} );
	} );

    wp.customize( 'marketingblog_custom_css', function( value ) {
        value.bind( function( to ) {
            $('#marketingblog_customizer_css').html(to);
        } );
    } );

} )( jQuery );
