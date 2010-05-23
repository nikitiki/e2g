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

            var init_pos  = new GLatLng( 35.658613, 139.745525 );
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

            // クリック時マーカー追加設定
            GEvent.addListener( this.map_canvas, "click", this.onMapClicked );

            // 地図キャンバス移動時イベント設定
            GEvent.addListener( this.map_canvas, 'moveend', this.onMapMoveend );

            // 暫定処理マーカーアイコンに写真を表示できるかテスト
            // アイコンの作成
            var markerIcon = new GIcon();
            markerIcon.image = PROJECT_URI + "img/users/m.jpg";
            markerIcon.iconSize = new GSize( 40, 40 );
            markerIcon.iconAnchor = new GPoint( 24, 40 );
            markerIcon.infoWindowAnchor = new GPoint( 24, 18 );
//             @TODO 影を作成
//            markerIcon.shadow = "icon/shadow50.png";
//            markerIcon.shadowSize = new GSize( 74, 68 );

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

console.log( markers[i] )
                // マーカー設定
                var marker = this.createMarker( point, markerIcon, name, address );

console.log( marker );
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

        // 検索ボタン押下
        $( "#search" ).bind( "click", function() {

            // 検索値取得
            var address = $( "#address" ).val();

            if( address ) {

                // ジオコーディング処理
                ref.geocoder.getLatLng( address, ref.getGeocoding );
            }
        })
    },

    // {{{ createMarker
    /**
     * 初期表示時に登録画像をマーカーを追加する要領で表示
     */
    createMarker : function( point, icon, name, address ) {
        var marker = new GMarker(point, icon );
        var html = "<b>" + name + "</b> <br/>" + address;
        GEvent.addListener(marker, 'click', function() {
            marker.openInfoWindowHtml(html);
        });
        return marker;
    },
    // }}}


    // {{{ onMapClicked
    // 追加したアイコンをクリックするとポップアップ表示
    // 
    onMapClicked : function( overlay, latlang ) {

        // クラスオブジェクト取得
        var ref = E2G.RootTop;

        // 地図がクリックされるとoverlayがnull
        if( overlay == null ) {

            if( ref.add_marker !== null ) 
                ref.map_canvas.removeOverlay( ref.add_marker );

            // 
            ref.add_marker = new GMarker( latlang );

            GEvent.addListener( ref.add_marker, "click", function(){

                var txt = "緯度：" + ref.add_marker.getLatLng().lat() + "<br />" +
                          "経度：" + ref.add_marker.getLatLng().lng();

                ref.add_marker.openInfoWindowHtml(txt);

            });

            // 地図にマーカーを描画
            ref.map_canvas.addOverlay( ref.add_marker );

            // 
            document.getElementById('text_lat').value = ref.add_marker.getLatLng().lat();
            document.getElementById('text_lng').value = ref.add_marker.getLatLng().lng();
        }
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

    },
    // }}}


    // {{{ getGeocoding
    /**
     *
     */
    getGeocoding : function( latlng ) {

        // 
console.log( latlng );

    }

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

