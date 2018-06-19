( function() {
	'use strict';

	if ( document.querySelector( '.home') ) {
    if ( document.querySelectorAll( '.wonka-slider-images') ) { 
    	var wonka_sliders = document.querySelectorAll( '.wonka-slider-images'),
    	wonka_slider_controls = document.querySelectorAll( '.control-btn' );
    	wonka_sliders.forEach( function( element ) { wonka_slider_setup( element ); } );
    	wonka_slider_controls.forEach( control_listener );
    }

    
  }

})();

function wonka_slider_setup( current_slider ) {
  var image = document.querySelector( '#' + current_slider.id + ' .wonka-slider-item-1'),
  current_wrapper = current_slider.parentNode,
  indicator = current_wrapper.querySelector( '.indicator-dot-1' );

  image.classList.add( 'active' );
  indicator.classList.add( 'active' );

}

function control_listener( cur_control ) {
	cur_control.addEventListener( 'click', function( el ) { slide_setup( el ); } );
}

function slide_setup(el) {
	var slide_control, direction, current_parent, current_dot, next_dot, current_slide, next_slide, slider_obj;

	if ( el.target.nodeName == 'A' ) {
		slide_control = el.target;
	} else {
		slide_control = el.target.parentElement;
	}

	if ( el.target.nodeName == 'LI' ) {
		slide_control = el.target;
	}
	
	direction = slide_control.getAttribute('data-slider-btn');
	current_parent = slide_control.parentElement;
	current_dot = current_parent.querySelector( '.indicator-dot.active' );
	current_slide = current_parent.querySelector( '.wonka-slider-item.active' );

	if ( direction == 'previous' ) {
		next_slide = current_slide.previousElementSibling;
		if ( next_slide === null ) {
			next_slide = current_slide.parentElement.lastElementChild;
			next_dot = current_dot.parentElement.lastElementChild;
		} else {
			next_dot = current_dot.previousElementSibling;
		}
			
	}

	if ( direction == 'next' ) {
		next_slide = current_slide.nextElementSibling;
		if ( next_slide === null ) {
			next_slide = current_slide.parentElement.firstElementChild;
			next_dot = current_dot.parentElement.firstElementChild;
		} else {
			next_dot = current_dot.nextElementSibling;
		}
			
	}

	slider_obj = {'controller': slide_control,'direction': direction, 'cur_indicator': current_dot, 'cur_slide': current_slide, 'next_indicator': next_dot, 'next_slide': next_slide};

	do_slide( slider_obj );
}

function do_slide( slider_obj ) {
	if ( slider_obj.direction === 'previous' ) {
		slider_obj.cur_indicator.classList.remove( 'active' );
		slider_obj.cur_slide.classList.add( 'slide-right' );
		slider_obj.next_slide.classList.add( 'previous' );
	}
} 