// {{{ E2G.DocosAdd
/**
 * 
 */
//E2G.RootTop = Ext.extend( E2G.WindowUtil, {  // ExtJS用
$.extend( E2G.DocosAdd = {}, E2G.WindowUtil, { 

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

            return false;
        })
    },

    // {{{ onMapClicked
    // 追加したアイコンをクリックするとポップアップ表示
    // 
    onMapClicked : function( overlay, latlng ) {

        // クラスオブジェクト取得
        var ref = E2G.DocosAdd;

        // 地図がクリックされるとoverlayがnull
        if( overlay == null ) {

            if( ref.add_marker !== null ) 
                ref.map_canvas.removeOverlay( ref.add_marker );

            // マーカーインスタンス生成
            ref.add_marker = new GMarker( latlng );

/*
            GEvent.addListener( ref.add_marker, "click", function(){

                var txt = "緯度：" + ref.add_marker.getLatLng().lat() + "<br />" +
                          "経度：" + ref.add_marker.getLatLng().lng();

                ref.add_marker.openInfoWindowHtml(txt);

            });
*/

            // 地図にマーカーを描画
            ref.map_canvas.addOverlay( ref.add_marker );

            // クリックした位置をhiddenに格納
            document.getElementById('lat').value = ref.add_marker.getLatLng().lat();
            document.getElementById('lng').value = ref.add_marker.getLatLng().lng();
        }
    },
    // }}}


    // {{{ getGeocoding
    /**
     * 住所で検索した位置情報を取得
     */
    getGeocoding : function( latlng ) {

        var ref = E2G.DocosAdd;

        // 該当する住所が取得できたか判別
        if( latlng === null ) {

            // @TODO 該当する住所はありませんでしたの旨表示
        } else {

            // 取得した位置で地図再配置
            ref.map_canvas.setCenter( latlng, 16 );
        }
    }
    // }}}

});
// }}}



// Top画面インスタンス生成
//var root_top = new E2G.RootTop(); // ExtJS用
E2G.DocosAdd.load();

// Top画面ロード処理実行
//root_top.load(); // ExtJS用

// Google map初期化処理
//GEvent.addDomListener( window, "load", E2G.RootTop.load );
GEvent.addDomListener( window, "unload", GUnload );

