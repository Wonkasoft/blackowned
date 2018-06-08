( function() {
	'use strict';

	var search_btn = document.getElementById('search-btn');
	
	search_btn.addEventListener( "click", search_slide );

})();

function search_slide() {
  var search_input = document.getElementById('s');
  if ( search_input.classList.contains( 'active' ) ) {
    search_input.classList.remove('active');
  } else {
    search_input.classList.add('active');
    setTimeout( function() {search_input.focus();}, 500 );
    search_input.onblur = function() { search_input.classList.remove( 'active' ); search_input.value = ''; };
  }
}

// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

var placeSearch, autocomplete;

function initAutocomplete() {
  // Create the autocomplete object, restricting the search to geographical
  // location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
      {types: ['geocode']});
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
      });
      autocomplete.setBounds(circle.getBounds());
    });
  }
}