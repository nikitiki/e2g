
var map_canvas;

// 
function initialize() {

    // 
    if( GBrowserIsCompatible() ) {
      var init_pos  = new GLatLng( 35.658613, 139.745525 );
      var init_zoom = 12;
      //

      map_canvas = new GMap2( document.getElementById( "map" ) );
      map_canvas.setCenter( init_pos, init_zoom );

      GEvent.addListener( map_canvas, "click", onMapClicked );

    }
}

function onMapClicked( overlay, latlang ) {

    // 地図がクリックされるとoverlayがnull
    if( overlay == null ) {

        // 
        var marker = new GMarker( latlang );

        GEvent.addListener( marker, "click", function(){ 

            var txt = "緯度：" + marker.getLatLng().lat() + "<br />" +
                      "経度：" + marker.getLatLng().lng();

            marker.openInfoWindowHtml(txt);

        });

        map_canvas.addOverlay( marker );
    }
}

GEvent.addDomListener( window, "load", initialize );
GEvent.addDomListener( window, "unload", GUnload );
