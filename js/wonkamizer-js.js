( function() {
	'use strict';

	if ( document.querySelector( '.home') ) {
    if ( document.querySelector( '.featured-item') ) { feature_slider_setup(); }

    
  }

})();

function feature_slider_setup() {
  var image = document.querySelector( '.featured-item-1'),
  indicator = document.querySelector( '.indicator-dot-1');

  image.classList.add( 'active' );
  indicator.classList.add( 'active' );

}