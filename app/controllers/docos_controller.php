<?php
/**
 * Top Controller
 * PHP 5
 *
 * @category Controller
 * @package
 * @version
 * @author nikitiki
 * @license 
 * @link 
 */

App::import( 'Core', array( 'Xml' ) );

class DocosController extends AppController
{

    var $name = 'docos';
    var $uses = array( 'picture', 'marker', 'user' );
    var $components = array( 'OauthConsumer', 'Twitpic', 'Twitter' );
    var $helpers = array(
        'Js',
        'Form',
        'Xml'
    );

    // {{{ veforeFilter
    /**
     * 初期処理
     * セッションチェック
     */
    function beforeFilter() {

        // ログインチェックをするアクション
        $deny = array( 'add', 'create' );

        foreach( $deny as $action ) {
            // 現在実行しているアクションがログインチェックするアクションか
            if( Set::extract( 'action', $this->params ) == $action ) {
                // セッションチェック
                if($this->Session->check('User') == false)
                {   
                    $this->redirect( '/oauth/authorize/twitter'  );
                    exit();
                }
            }
        }

        parent::beforeFilter();
    }

    // {{{ index
    /**
     * Top画面
     */
    function index() {

        // 最新の投稿写真を取得
        $cond = array(
            'conditions' => array( 'picture.delete_flg !=' => 1 ),
            'order' => array( 'picture.created desc' ),
            'limit' => 9
        );
        $pictures = $this->picture->find( 'all', $cond );

        // viewに投稿写真をセット
        $this->set( 'pictures', $pictures );

        // 最新のマーカー情報取得
        $markers = $this->marker->find( 'all' );

        // xml設定
        $options = array(
            'root' => 'markers',     // rootノード
            'attributes' => false, 
            'format' => 'attributes'
        );

        // xmlインスタンス作成
        $data = new Xml($markers, $options);

        // xmlを文字列に変換
        $markers_str = "'" . $data->toString( $options + array( 'header' => false) ) . "'";

        // xml作成
        $this->set( 'markers', $markers_str );

    }
    // }}}

    // {{{ search
    /**
     * 検索後表示画面
     */
    function search() {

        // stringの空文字を作成(viewでjavascriptでエラーにならないように)
        // 画像データテンプレート用変数
        $set_markers = "''";

        // 経度・緯度テンプレートセット用変数
        $set_lat= "''";
        $set_lng = "''";

        // POST
        if( !empty( $this->data ) &&
            $address = Set::extract( 'Marker.address', $this->data ) ) {

            // UTF8に変換
//            $address = mb_convert_encoding( $address, 'UTF-8', 'AUTO' );

            // URLエンコード
//            $address = urlencode( $address );

            // 送信パラメータ初期化
            $queries = array();

            // 送信パラメータ生成
            $queries['q']      = $address;
            $queries['key']    = GOOGLE_MAP_API_KEY;
            $queries['sensor'] = false;
            $queries['output'] = 'xml';
            $queries['gl']     = 'jp';

            // 送信URL生成
            $url = 'http://maps.google.com/maps/geo?' . http_build_query( $queries );

            // api送信
            $xml = new Xml( $url );

            // オブジェクトを配列に変換
            $xml_array = Set::reverse( $xml );

            // api通信のステータスコードを取得
            $status_code = Set::extract( 'Kml.Response.Status.code', $xml_array );

            // ジオコーディングが取得できていれば200
            if( $status_code == "200" ) {

                // ジオコーディング取得
                $geocoding = Set::extract( 'Kml.Response.Placemark.Point.coordinates', $xml_array );

                // 緯度、経度、高度に分割
                $geocoding = explode( ',', $geocoding );

                // 経度取得
                $lng = $geocoding[0];
                $set_lng = "'" . $lng . "'";

                // 緯度取得
                $lat = $geocoding[1];
                $set_lat = "'" . $lat . "'";

                // 画像取得条件格納変数
                $conditions = array();

                // 表示範囲（よりちょっと広め）の緯度を取得
                $conditions['lat_min'] = (float)$lat - LAT_BUFFER;
                $conditions['lat_max'] = (float)$lat + LAT_BUFFER;

                // 表示範囲（よりちょっと広め）の経度を取得
                $conditions['lng_min'] = (float)$lng - LNG_BUFFER;
                $conditions['lng_max'] = (float)$lng + LNG_BUFFER;

                // 画像取得
                $markers =  $this->marker->findExpand( $conditions );
//                $markers =  $this->marker->find( 'all' );

                if( $markers ) {

                    // xml設定
                    $options = array(
                        'root' => 'markers',     // rootノード
                         'attributes' => false, 
                         'format' => 'attributes'
                    ); 

                   // xmlインスタンス作成
                   $data = new Xml($markers, $options);

                    // xmlを文字列に変換
                    $set_markers = "'" . $data->toString( $options + array( 'header' => false) ) . "'";

                } else {

                    $this->Session->setFlash( __('該当する住所はありませんでした', true) );
                }
            }
        }

        $this->set( 'markers', $set_markers );
        $this->set( 'lat',     $set_lat );
        $this->set( 'lng',     $set_lng );
    }
    // }}}

    // {{{ add
    // 登録入力画面
    function add() {

    }
    // }}}

    // {{{
    function create() {

        // POST only
        if( !empty( $this->data ) ) {

            // 明示的にパリデート処理

            // TwitPicに保存処理開始
            $twitpic = $this->Twitpic->upload( $this->data['Picture'] );

            if( isset( $twitpic->errors ) ) {
            // 保存処理失敗時
                // @TODO ロールバック処理

                // 登録失敗 登録画面に戻る
                $this->_createFail();
                return;

            } else {

                // トランザクション開始

                // Pictureモデルに保存
                if ( !$picture_id = $this->picture->save( $twitpic ) ) {
                // 保存処理失敗
                    // @TODO ロールバック処理

                    // 登録失敗 登録画面に戻る
                    $this->_createFail();
                    return;
                }

                // Markerモデルに登録
                $marker_data = $this->data['Marker'];
                $marker_data['picture_id'] = $picture_id;
                if( !$marker_id = $this->marker->save( $marker_data ) ) {

                    // 登録失敗 登録画面に戻る
                    $this->_createFail();
                    return;
                }

                // twitterにつぶやき
                // つぶやきパラメータセット
                $options = array();
                $status = $this->Twitter->status_update( 
                    $twitpic, 
                    $this->data['Marker'], 
                    $options );

                if( !$status ) {
                    // @TODO ロールバック処理

                    // 登録失敗 登録画面に遷移
                    $this->_createFail();
                    return;
                }

                // 登録成功文言セット
                $this->Session->setFlash( __('登録が成功しました', true) );

                // @TODO 詳細ページに遷移
                $this->redirect( '/docos/index' );
            }
        }

        // @TODO 暫定処理 後リダイレクト処理に変更
        $this->render( 'add' );
    }
    // }}}

    // {{{ _createFail
    private function _createFail() {

        // エラー文言セット
        $this->Session->setFlash( __('登録失敗しました。もう一度試してみて＞＜', true) );
        // 登録画面に戻る
        $this->render( 'add' );
    }
    // }}}

}
?>
