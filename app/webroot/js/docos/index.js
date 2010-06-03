// {{{ E2G.RootTop
/**
 * 
 */
//E2G.RootTop = Ext.extend( E2G.WindowUtil, {  // ExtJS用
$.extend( E2G.RootTop = {}, E2G.WindowUtil, { 

    // 地図描画オブジェクト格納変数
    map_canvas: null,

    // マーカーオブジェクト格納変数
    add_marker: null,

    // ジオコーディングインスタンス格納用変数
    geocoder: null,

    // {{{ init 
    // ロード時処理
    init : function() {

        // キーイベント設定
        this.setKeyEvents();

        // ブラウザでGoogleマップが使用できるか判定
        if( GBrowserIsCompatible() ) {

            // 地図生成判定
//            if ( !$("body").is(":has('#map')") ) { 
//                return;
//            } 

            // 中心地点取得 該当する住所がなかったら東京タワー
            lat = ( lat === '' ) ? 35.658613 : lat;
            lng = ( lng === '' ) ? 139.745525 : lng;

            // 経度・緯度apiインスタンス生成
            var init_pos  = new GLatLng( lat, lng );
            var init_zoom = 15;

            // 地図インスタンス生成
            this.map_canvas = new GMap2( document.getElementById( "map" ) );

            // 中心地点設定
            this.map_canvas.setCenter( init_pos, init_zoom );

            // 検索用ジオコーディングのインスタンスを生成
            this.geocoder = new GClientGeocoder();

            // コントローラー設定
            this.map_canvas.addControl( new GLargeMapControl() );

            // 地図タイプコントロール設定
            this.map_canvas.addControl( new GMapTypeControl() );

            // 概観地図
//            this.map_canvas.addControl( new GOverviewMapControl() );

            // 地図キャンバス移動時イベント設定
            GEvent.addListener( this.map_canvas, 'moveend', this.onMapMoveend );

            // xmlをパース
            var xml = GXml.parse( j_markers );

            // タグ名がmarkerのノードを取得
            var markers = xml.documentElement.getElementsByTagName("marker");

            // markerの各子ノードを取得
            for( var i = 0; i < markers.length; i++ ) {
                var address  = markers[i].getAttribute( "address" );
                var img      = markers[i].getAttribute( "url" );
                var text     = markers[i].getAttribute( "text" );
                var view_url = markers[i].getAttribute( "view_url" );

                var point = new GLatLng(parseFloat(markers[i].getAttribute("lat")),
                                        parseFloat(markers[i].getAttribute("lng")));

console.log( markers[i] );
                // マーカー設定
                var marker = this.createMarker( point, img, text, view_url );

                // キャンバスにマーカーを追加
                this.map_canvas.addOverlay( marker );
            }
        }
    },
    // }}}


    // {{{ setKeyEvents
    /**
     * イベント発火設定関数
     */
    setKeyEvents : function() {
        var ref = this;

    },

    // {{{ createMarker
    /**
     * 初期表示時に登録画像をマーカーを追加する要領で表示
     */
    createMarker : function( point, img, text, view_url ) {

        // アイコンの作成
        var markerIcon = new GIcon();
        markerIcon.image = img;
        markerIcon.iconSize = new GSize( 50, 50 );
        markerIcon.iconAnchor = new GPoint( 30, 40 );
        markerIcon.infoWindowAnchor = new GPoint( 30, 25 );
        // @TODO 影を作成
        // markerIcon.shadow = "icon/shadow50.png";
        // markerIcon.shadowSize = new GSize( 74, 68 );

        // マーカーの作成
        var marker = new GMarker(point, markerIcon );
        var html = "<b>" + text + "</b> <br/>";
        html += "<a href='" + view_url + "'>" + view_url + "</a>";
console.log(html);
        GEvent.addListener(marker, 'click', function() {
            marker.openInfoWindowHtml(html);
        });
        return marker;
    },
    // }}}

    // {{{
    /**
     * mapが移動したときAjaxで表示座行をサーバーに送る。
     * 表示した地図の画像を取得 
     */
    onMapMoveend : function() {

        // 自クラスオブジェクト取得
        var ref = E2G.RootTop;        

        // 表示範囲オブジェクト取得
        var bounds = ref.map_canvas.getBounds();

        // 南西の地理座標（左下）取得
        var sw = bounds.getSouthWest();

        // 北東の地理座標（右上）取得
        var ne = bounds.getNorthEast();

        // 短形のサイズを表す
        var span = bounds.toSpan();

        // サーバーに位置情報を送る

console.log(span);
    }
    // }}}

});
// }}}



// Top画面インスタンス生成
//var root_top = new E2G.RootTop(); // ExtJS用
E2G.RootTop.load();

// Top画面ロード処理実行
//root_top.load(); // ExtJS用

// Google map初期化処理
//GEvent.addDomListener( window, "load", E2G.RootTop.load );
GEvent.addDomListener( window, "unload", GUnload );

