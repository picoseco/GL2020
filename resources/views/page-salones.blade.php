@extends('layouts.app')

@section('content')
  {!! App::cardBg('large') !!}
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <h2>Mapa de salones</h2>
        {{-- google maps --}}
        @php
        $args = array(
          'post_type'=>'salon',
          'meta_key' => 'direccion',
          'meta_value' => array(''),
          'meta_compare' => 'NOT IN',
          'orderby'=>'name',
          'order'=>'ASC'
        );
        $the_query = new WP_Query( $args );
        @endphp

        <div id="map" style="height:66vh" class="mb-5"></div>

        <script>
        var escapeChars = { lt: '<', gt: '>', quot: '"', apos: "'", amp: '&' };
        function unescapeHTML(str) {//modified from underscore.string and string.js
          return str.replace(/\&([^;]+);/g, function(entity, entityCode) {
            var match;

            if ( entityCode in escapeChars) {
              return escapeChars[entityCode];
            } else if ( match = entityCode.match(/^#x([\da-fA-F]+)$/)) {
              return String.fromCharCode(parseInt(match[1], 16));
            } else if ( match = entityCode.match(/^#(\d+)$/)) {
              return String.fromCharCode(~~match[1]);
            } else {
              return entity;
            }
          });
        }

        var markers = [];
        var infoWindow;
        var salones = [
          @php $sal = 0; @endphp
          @while($the_query->have_posts())
          @php $the_query->the_post(); $location = get_field('direccion'); @endphp

          ['{{ get_the_title()}}',
          '{{ $location['address'] }}',
          {{ $location['lat'] }},
          {{ $location['lng'] }},
          {{ $sal }},
          '{{ get_field('email') }}',
          '{{ get_field('telefono') }}',
          '{{ get_field('telefono_alt') }}',
          '{{ get_field('web') }}',
          '{{ get_field('facebook') }}',
          '{{ get_field('instagram') }}'],
          @endwhile
        ];

        function initMap() {
          var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 3,
            center: {lat: -12, lng: -75},
            mapTypeControl: false,
            zoomControl: true,
            scaleControl: false,
            streetViewControl: false,
            rotateControl: true,
            fullscreenControl: true,
            styles: [
              {
                "elementType": "geometry",
                "stylers": [
                  {
                    "color": "#d6d6d6"
                  }
                ]
              },
              {
                "elementType": "labels.text.fill",
                "stylers": [
                  {
                    "color": "#616161"
                  }
                ]
              },
              {
                "featureType": "administrative.country",
                "elementType": "geometry.stroke",
                "stylers": [
                  {
                    "color": "#929292"
                  }
                ]
              },
              {
                "featureType": "administrative.land_parcel",
                "elementType": "labels",
                "stylers": [
                  {
                    "visibility": "off"
                  }
                ]
              },
              {
                "featureType": "poi",
                "elementType": "labels.icon",
                "stylers": [
                  {
                    "color": "#a9a9a9"
                  }
                ]
              },
              {
                "featureType": "poi",
                "elementType": "labels.text",
                "stylers": [
                  {
                    "visibility": "off"
                  }
                ]
              },
              {
                "featureType": "road",
                "elementType": "geometry",
                "stylers": [
                  {
                    "color": "#ffffff"
                  }
                ]
              },
              {
                "featureType": "road.highway",
                "elementType": "labels",
                "stylers": [
                  {
                    "visibility": "off"
                  }
                ]
              },
              {
                "featureType": "transit",
                "stylers": [
                  {
                    "saturation": -100
                  }
                ]
              },
              {
                "featureType": "water",
                "stylers": [
                  {
                    "color": "#797979"
                  }
                ]
              }
            ]
          });

          infoWindow = new google.maps.InfoWindow();

          for (var i = 0; i < salones.length; i++) {
            var salon = salones[i];
            var html = '<h6>'+unescapeHTML(salones[i][0])+'</h6>';
            if (salones[i][1]) html += '<i class="fas fa-map-marked-alt"></i> '+salones[i][1];
            if (salones[i][5]) html += '<br><i class="fas fa-envelope"></i> '+salones[i][5];
            if (salones[i][6]) html += '<br><i class="fas fa-phone"></i> '+salones[i][6];
            if (salones[i][7]) html += ' / '+salones[i][7];
            if (salones[i][8]) html += '<br><i class="fas fa-atlas"></i> <a href="'+salones[i][8]+'" target="_blank">'+salones[i][8]+'</a>';
            if (salones[i][9]) html += '<br><i class="fab fa-facebook-square"></i> <a href="'+salones[i][9]+'" target="_blank">'+salones[i][9]+'</a>';
            if (salones[i][10]) html += '<br><i class="fab fa-instagram"></i> <a href="'+salones[i][10]+'" target="_blank">'+salones[i][10]+'</a>';

            var marker = new google.maps.Marker({
              position: {lat: salon[2], lng: salon[3]},
              icon: '@asset('images/marker_gl.png')',
              map: map
            });

            markers.push(marker);

            google.maps.event.addListener(marker,'click', (function(marker,i,html){
              return function() {
                infoWindow.setContent(html);
                infoWindow.open(map,marker);
                map.panTo(marker.getPosition());
              };
            })(marker,i,html));

            // markers[salones[i][4]] = marker;
          }

          var markerCluster = new MarkerClusterer(map, markers, {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m', gridSize: 20 });
        }
        </script>

        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBI4VEZXjBa8qLNm1l3CDcjNSScAcWoAo0&callback=initMap"></script>
        {{-- // google maps --}}
      </div>
      <div class="col-lg-6">
        <h2>Salones por país</h2>
        <div id="accordion" class="accordion">
          @php
          $args = array('post_type'=>'pais','post__not_in' => array(650),'orderby'=>'name','order'=>'ASC'); //excluimos "su pais no está"
          $the_query = new WP_Query( $args );
          @endphp
          @php global $first; /* $first=true; */ @endphp
          @while($the_query->have_posts()) @php $the_query->the_post() @endphp
            @include('partials.content-collapse-salones')
          @endwhile
          @php wp_reset_postdata() @endphp
        </div>
      </div>
    </div>
  </div>
@endsection
