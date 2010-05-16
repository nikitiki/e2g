
var map_canvas;

var marker = null;

// 
function initialize() {

    // 
    if( GBrowserIsCompatible() ) {
        var init_pos  = new GLatLng( 35.658613, 139.745525 );
        var init_zoom = 12;

        map_canvas = new GMap2( document.getElementById( "map" ) );
        map_canvas.setCenter( init_pos, init_zoom );

        GEvent.addListener( map_canvas, "click", onMapClicked );

        // 暫定処理マーカーアイコンに写真を表示できるかテスト
        // アイコンの作成
        var markerIcon = new GIcon();
        markerIcon.image = REQUEST_URI + "img/users/m.jpg";
//        markerIcon.image = "icon/green-dot.png";
        markerIcon.iconSize = new GSize( 40, 40 );
        markerIcon.iconAnchor = new GPoint( 24, 40 );
        markerIcon.infoWindowAnchor = new GPoint( 24, 18 );
//        markerIcon.shadow = "icon/shadow50.png";
//        markerIcon.shadowSize = new GSize( 74, 68 );

        // マーカーのオプション
        var markerOpts = {
            icon : markerIcon
        };

        var marker1 = new GMarker( init_pos, markerOpts );

        GEvent.addListener( marker1, "click", function(){
            marker1.openInfoWindow( 'marker1' );
        });


        map_canvas.addOverlay( marker1 );
    }
}

function onMapClicked( overlay, latlang ) {

    // 地図がクリックされるとoverlayがnull
    if( overlay == null ) {

        if( marker !== null ) map_canvas.removeOverlay( marker );

        // 
        marker = new GMarker( latlang );

        GEvent.addListener( marker, "click", function(){ 

            var txt = "緯度：" + marker.getLatLng().lat() + "<br />" +
                      "経度：" + marker.getLatLng().lng();

            marker.openInfoWindowHtml(txt);

        });

        map_canvas.addOverlay( marker );

        document.getElementById('text_lat').value = marker.getLatLng().lat();
        document.getElementById('text_lng').value = marker.getLatLng().lng();
    }
}

GEvent.addDomListener( window, "load", initialize );
GEvent.addDomListener( window, "unload", GUnload );
