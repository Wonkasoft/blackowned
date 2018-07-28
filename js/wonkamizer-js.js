( function() {
	'use strict';

	var search_btn = document.querySelector('#search-btn');
	var self_timer;

	search_btn.onclick = function(e) { search_bar_toggle(e); };

	if ( document.querySelector( '.home' ) ) {
	    if ( document.querySelectorAll( '.wonka-slider-images') ) { 
	    	var wonka_sliders = document.querySelectorAll( '.wonka-slider-images'),
	    	wonka_slider_controls = document.querySelectorAll( '.control-btn' ),
	    	wonka_slider_indicators = document.querySelectorAll( '.slider-indicators li' );
	    	wonka_slider_indicators.forEach( control_listener );
	    	wonka_sliders.forEach( function( element ) { wonka_slider_setup( element ); } );
	    	wonka_slider_controls.forEach( control_listener );

	    	set_self_timer();
	    }
  	}

  	if ( document.querySelector( '.page-id-30' ) ) {
  		var sell_page = document.querySelector( '.page-id-30' );
  		sell_page.onload = function() {
  			var toggler = document.querySelector( '.toggle-group' );
	  		var switch_btn = document.querySelector( '.toggle input[type=checkbox]' );
	  		package_toggle( switch_btn );
	  		toggler.addEventListener( 'click', function() { package_toggle( switch_btn ); });
  		};
  	}

  	function package_toggle( switch_btn ) {
		var package_modules = document.querySelectorAll( '.membership-package-modules' );
		var response_obj, data, json_data, package_name, package_name_send, do_ajax = new XMLHttpRequest();
		package_modules.forEach( function ( item, index ) {
			package_name = item.querySelector( 'h2' ).innerText.toLowerCase();
			package_name_send = package_name;

			setTimeout( function() { 
				
				if ( switch_btn.checked === false ) {
					item.querySelector( '.pricing-window' ).classList.add( 'yearly-pricing' );
					package_name_send = package_name + '-year';
				} else if ( switch_btn.checked ) {
					if ( item.querySelector( '.yearly-pricing' ) ) {
						item.querySelector( '.pricing-window' ).classList.remove( 'yearly-pricing' );
						package_name_send = package_name;
					}
				}

				data = { "action":"packages_get", "security": BO_AJAX.security, "package": package_name_send };
				json_data = JSON.stringify( data );
				do_ajax.setRequestHeader( "Content-type", "application/json" );
				do_ajax.onreadystatechange = function() {
					if ( this.readyState == 4 && this.status == 200 ) {
						console.log(this.responseText);
					}
				};
				do_ajax.open( "POST", wpAjaxUrl, true);
				do_ajax.send( json_data );
			}, 125);
		});
  	}

	function wonka_slider_setup( current_slider ) {
	  var image = current_slider.querySelector( '.wonka-slider-item'),
	  current_wrapper = current_slider.parentNode,
	  indicator = current_wrapper.querySelector( '.indicator-dot-1' );

	  image.classList.add( 'active' );
	  indicator.classList.add( 'active' );

	}

	function control_listener( cur_control ) {
		cur_control.addEventListener( 'click', function( e ) { slide_setup( e ); } );
	}

	function slide_setup( e ) {
		clearInterval( self_timer );
		var slide_control, new_target, direction, current_parent, previous_dot, current_dot, next_dot, current_slide, next_slide, slider_obj, a, b;
		if ( e.target.nodeName === 'I' || e.target.nodeName === 'DIV' ) {
			new_target = e.target.parentElement;
		} else {
			new_target = e.target;
		}


		if ( new_target.nodeName === 'A' ) {
			slide_control = new_target;
			direction = slide_control.getAttribute('data-slider-btn');
			current_parent = slide_control.parentElement;
		}

		if ( new_target.nodeName === 'LI'  ) {
			current_parent = new_target.parentElement.parentElement;
			slide_control = new_target;
			current_parent = slide_control.parentElement.parentElement;
		}
		
		current_dot = current_parent.querySelector( '.indicator-dot.active' );
		current_slide = current_parent.querySelector( '.wonka-slider-item.active' );

		if ( current_dot === new_target ) {
			set_self_timer();
			return;
		}

		if ( new_target.nodeName === 'LI' ) {
			a = current_dot.classList[1].substr( current_dot.classList[1].length - 1);
			b = slide_control.classList[1].substr( slide_control.classList[1].length - 1);
			if ( a < b ) {
				direction = 'next';
			}
			if ( a > b ) {
				direction = 'previous';
			}
		}
		if ( direction === 'previous' ) {
			next_slide = ( slide_control.nodeName == 'LI' ) ? current_parent.querySelector( '.wonka-slider-item-' + b ): current_slide.previousElementSibling;
			next_dot = ( slide_control.nodeName == 'LI' ) ? current_parent.querySelector( '.indicator-dot-' + b ): current_dot.previousElementSibling;
			if ( next_slide === null ) {
				next_slide = current_slide.parentElement.lastElementChild;
				next_dot = current_dot.parentElement.lastElementChild;
			}
		}

		if ( direction === 'next' ) {
			next_slide = ( slide_control.nodeName == 'LI' ) ? current_parent.querySelector( '.wonka-slider-item-' + b ): current_slide.nextElementSibling;
			next_dot = ( slide_control.nodeName == 'LI' ) ? current_parent.querySelector( '.indicator-dot-' + b ): current_dot.nextElementSibling;
			if ( next_slide === null ) {
				next_slide = current_slide.parentElement.firstElementChild;
				next_dot = current_dot.parentElement.firstElementChild;
			}
		}
		slider_obj = {'controller': slide_control,'direction': direction, 'cur_indicator': current_dot, 'cur_slide': current_slide, 'next_indicator': next_dot, 'next_slide': next_slide};

		if ( current_slide.classList.contains( 'fade-set' ) && slider_obj.next_slide !== slider_obj.cur_slide) {
			do_fade( slider_obj );
		} else if ( slider_obj.next_slide !== slider_obj.cur_slide ) {
			do_slide( slider_obj );
		} else {
			set_self_timer();
		}
	}

	function do_slide( slider_obj ) {
		if ( slider_obj.direction === 'previous' ) {
			slider_obj.cur_indicator.classList.remove( 'active' );
			slider_obj.cur_slide.classList.add( 'slide-right' );
			setTimeout( function() {
				slider_obj.cur_slide.style.left = '110%';
				setTimeout( function() {
					slider_obj.cur_slide.style.display = 'none';
					slider_obj.cur_slide.classList.remove( 'active');
					slider_obj.cur_slide.classList.remove( 'slide-right');
					slider_obj.cur_slide.removeAttribute( 'style' );
					slider_obj.next_slide.classList.add( 'previous' );
					slider_obj.next_slide.classList.add( 'active' );
					setTimeout( function() {
						slider_obj.next_slide.style.right = '0';
						slider_obj.next_indicator.classList.add( 'active' );
						setTimeout( function() {
							slider_obj.next_slide.removeAttribute( 'style' );
							slider_obj.next_slide.classList.remove( 'previous' );
						}, 300 );
					}, 200 );
				}, 200 );
			}, 200 );
		}

		if ( slider_obj.direction === 'next' ) {
			slider_obj.cur_indicator.classList.remove( 'active' );
			slider_obj.cur_slide.classList.add( 'slide-left' );
			setTimeout( function() {
				slider_obj.cur_slide.style.right = '110%';
				setTimeout( function() {
					slider_obj.cur_slide.style.display = 'none';
					slider_obj.cur_slide.classList.remove( 'active');
					slider_obj.cur_slide.classList.remove( 'slide-left');
					slider_obj.cur_slide.removeAttribute( 'style' );
					slider_obj.next_slide.classList.add( 'next' );
					slider_obj.next_slide.classList.add( 'active' );
					setTimeout( function() {
						slider_obj.next_slide.style.left = '0';
						slider_obj.next_indicator.classList.add( 'active' );
						setTimeout( function() {
							slider_obj.next_slide.removeAttribute( 'style' );
							slider_obj.next_slide.classList.remove( 'next' );
						}, 300 );
					}, 200 );
				}, 200 );
			}, 200 );
		}
		set_self_timer();
	} 

	function do_fade( slider_obj ) {
		slider_obj.cur_slide.classList.add( 'fade-out' );
		slider_obj.next_slide.classList.add( 'fade-in' );
		setTimeout( function() {
			slider_obj.cur_indicator.classList.remove( 'active' );
			slider_obj.cur_slide.style.opacity = '0';
			slider_obj.next_indicator.classList.add( 'active' );
			setTimeout( function() {
				slider_obj.cur_slide.style.display = 'none';
				slider_obj.cur_slide.classList.remove( 'active');
				slider_obj.cur_slide.classList.remove( 'fade-out');
				slider_obj.cur_slide.removeAttribute( 'style' );
				slider_obj.next_slide.classList.add( 'active' );
				slider_obj.next_slide.removeAttribute( 'style' );
				slider_obj.next_slide.classList.remove( 'fade-in' );
			}, 800 );
		}, 400 );

		set_self_timer();
	} 

	function set_self_timer() {
		var delay = 5000;
		self_timer = setInterval( function() {
			var active_indicators = document.querySelectorAll( '.slider-indicators li.active' ),
			currently,
			next;
			active_indicators.forEach( function( el ) {
				currently = el;
				next = currently.nextElementSibling;
	    		if ( next !== null ) {
	    			next.click();
	    		} else {
	    			next = currently.parentElement.firstElementChild;
	    			next.click();
	    		}
			});

		}, delay );
	}

	function search_bar_toggle(e) {
		var browser_width = window.innerWidth;
		var search_bar = document.querySelector( '.search-slide' );
		if ( browser_width < 992 ) {
			search_bar.style.display = 'block';
			setTimeout( function() {
				search_bar.classList.add( 'searchable' );
				search_bar.focus();
				search_bar.value = '';
				search_bar.onblur = function() {
					search_bar.classList.remove( 'searchable' ); 
					setTimeout( function() { search_bar.removeAttribute( 'style' ); } );
				};
			}, 250 );
		}
	}

})();