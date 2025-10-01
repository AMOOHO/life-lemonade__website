/* **********************************************************************************************************************
 * GOOGLE-MAPS.JS
 *
 * Initializes the Google Map instance on the page.
 * Features:
 *   - Custom map center and zoom level
 *   - Styled map with site-specific colors and design
 *   - Optional custom markers (currently commented out)
 *   - Controls and UI options (disable default UI, zoom, draggable, scrollwheel)
 *
 * Dependencies:
 *   - Google Maps JavaScript API
 *
 * Usage:
 *   Call `initMap()` on page load or when the map container is present in the DOM.
 *
 * Copyright (c) 2025 OHO Design GmbH. All rights reserved.
 * Unauthorized copying, distribution, or use of this file is strictly prohibited.
 *
 * Author: OHO Design GmbH
 * Date: 2025-01-01
 **********************************************************************************************************************/

function initMap() {
  var map = new google.maps.Map(document.getElementById("map"), {
    // main map pin
    center: {
      lat: 46.94986011401814,
      lng: 7.441512283468726,
    },

    // conrols, ui settings
    disableDefaultUI: true,
    zoom: 16.0,
    scrollwheel: false,
    scaleControl: true,
    draggable: true,
    zoomControl: true,
    zoomControlOptions: {
      style: google.maps.ZoomControlStyle.SMALL,
    },

    // main map styles
    styles: [
      {
        elementType: "geometry",
        stylers: [
          {
            color: "#f5f5f5",
          },
        ],
      },
      {
        elementType: "labels.icon",
        stylers: [
          {
            visibility: "off",
          },
        ],
      },
      {
        elementType: "labels.text.fill",
        stylers: [
          {
            color: "#616161",
          },
        ],
      },
      {
        elementType: "labels.text.stroke",
        stylers: [
          {
            color: "#f5f5f5",
          },
        ],
      },
      {
        featureType: "administrative.land_parcel",
        elementType: "labels.text.fill",
        stylers: [
          {
            color: "#bdbdbd",
          },
        ],
      },
      {
        featureType: "poi",
        elementType: "geometry",
        stylers: [
          {
            color: "#eeeeee",
          },
        ],
      },
      {
        featureType: "poi",
        elementType: "labels.text.fill",
        stylers: [
          {
            color: "#757575",
          },
        ],
      },
      {
        featureType: "poi.park",
        elementType: "geometry",
        stylers: [
          {
            color: "#e5e5e5",
          },
        ],
      },
      {
        featureType: "poi.park",
        elementType: "labels.text.fill",
        stylers: [
          {
            color: "#9e9e9e",
          },
        ],
      },
      {
        featureType: "road",
        elementType: "geometry",
        stylers: [
          {
            color: "#ffffff",
          },
        ],
      },
      {
        featureType: "road.arterial",
        elementType: "labels.text.fill",
        stylers: [
          {
            color: "#757575",
          },
        ],
      },
      {
        featureType: "road.highway",
        elementType: "geometry",
        stylers: [
          {
            color: "#dadada",
          },
        ],
      },
      {
        featureType: "road.highway",
        elementType: "labels.text.fill",
        stylers: [
          {
            color: "#616161",
          },
        ],
      },
      {
        featureType: "road.local",
        elementType: "labels.text.fill",
        stylers: [
          {
            color: "#9e9e9e",
          },
        ],
      },
      {
        featureType: "transit.line",
        elementType: "geometry",
        stylers: [
          {
            color: "#e5e5e5",
          },
        ],
      },
      {
        featureType: "transit.station",
        elementType: "geometry",
        stylers: [
          {
            color: "#eeeeee",
          },
        ],
      },
      {
        featureType: "water",
        elementType: "geometry",
        stylers: [
          {
            color: "#c9c9c9",
          },
        ],
      },
      {
        featureType: "water",
        elementType: "labels.text.fill",
        stylers: [
          {
            color: "#9e9e9e",
          },
        ],
      },
    ],
  });

  // // Google map pin icon
  // var iconUrl = '/wp-content/themes/oishiibern/media/no-index/map-pin.png';
  // var marker = new google.maps.Marker({
  //   position: {
  //     lat: 46.94986011401814,
  //     lng:  7.441512283468726
  //     // 46.94986011401814, 7.441512283468726
  //   },
  //   map: map,
  //   icon: {
  //     url: iconUrl,
  //     scaledSize: new google.maps.Size(35, 45),
  //     anchor: new google.maps.Point(40, 45)
  //   },
  //   optimized: false,
  //   title: 'marker'
  // });
  //
  // marker.addListener('click', function() {
  //   window.open('https://goo.gl/maps/T6b6ynn5XQLF9WyD7','_blank');
  // });

  // google.maps.event.addListener(map, "zoom_changed", function() {
  //   updateMapMarker(map, marker);
  // });
}
