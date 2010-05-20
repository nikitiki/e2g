
var map_canvas;

var add_marker = null;

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
        markerIcon.iconSize = new GSize( 40, 40 );
        markerIcon.iconAnchor = new GPoint( 24, 40 );
        markerIcon.infoWindowAnchor = new GPoint( 24, 18 );
//        markerIcon.shadow = "icon/shadow50.png";
//        markerIcon.shadowSize = new GSize( 74, 68 );

        // マーカーのオプション
        var markerOpts = {
            icon : markerIcon
        };

        // xmlをパース
        var xml = GXml.parse( j_markers );

        // タグ名がmarkerのノードを取得
        var markers = xml.documentElement.getElementsByTagName("marker");

        // markerの各子ノードを取得
        for( var i = 0; i < markers.length; i++ ) {
            var name    = markers[i].getAttribute( "name" );
            var address = markers[i].getAttribute( "address" );

            var point = new GLatLng(parseFloat(markers[i].getAttribute("lat")),
                                    parseFloat(markers[i].getAttribute("lng")));


            // マーカー設定
            var marker = createMarker( point, markerIcon, name, address );

            // キャンバスにマーカーを追加
            map_canvas.addOverlay( marker );
        }
    }
}

// {{{ onMapClicked
// 追加したアイコンをクリックするとポップアップ表示
// 
function onMapClicked( overlay, latlang ) {

    // 地図がクリックされるとoverlayがnull
    if( overlay == null ) {

        if( add_marker !== null ) map_canvas.removeOverlay( add_marker );

        // 
        add_marker = new GMarker( latlang );

        GEvent.addListener( add_marker, "click", function(){ 

            var txt = "緯度：" + add_marker.getLatLng().lat() + "<br />" +
                      "経度：" + add_marker.getLatLng().lng();

            add_marker.openInfoWindowHtml(txt);

        });

        map_canvas.addOverlay( add_marker );

        document.getElementById('text_lat').value = add_marker.getLatLng().lat();
        document.getElementById('text_lng').value = add_marker.getLatLng().lng();
    }
}
// }}}

// {{{ createMarker
//
//
function createMarker( point, icon, name, address ) {
    var marker = new GMarker(point, icon );
    var html = "<b>" + name + "</b> <br/>" + address;
    GEvent.addListener(marker, 'click', function() {
        marker.openInfoWindowHtml(html);
    });
    return marker;
}
// }}}


// {{{
// mapが移動したときAjaxで表示座行をサーバーに送る。表示した地図の画像を取得


GEvent.addDomListener( window, "load", initialize );
GEvent.addDomListener( window, "unload", GUnload );
