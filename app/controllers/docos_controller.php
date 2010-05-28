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
    var $uses = array( 'marker' );
    var $helpers = array(
        'Js',
        'Form',
        'Xml'
    );

    // {{{ index
    function index() {

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
        $markers_string = "'" . $data->toString( $options + array( 'header' => false) ) . "'";

        // xml作成
        $this->set( 'markers', $markers_string );

    }
    // }}}

    // {{{ search
    function search() {

        // 画像データ返却用変数
        $markers_string = null;

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

                // 緯度取得
                $lat = $geocoding[1];

                // 画像取得条件格納変数
                $conditions = array();

                // 表示範囲（よりちょっと広め）の緯度を取得
                $conditions['lat_min'] = (float)$lat - LAT_BUFFER;
                $conditions['lat_max'] = (float)$lat + LAT_BUFFER;

                // 表示範囲（よりちょっと広め）の経度を取得
                $conditions['lng_min'] = (float)$lng - LNG_BUFFER;
                $conditions['lng_max'] = (float)$lng + LNG_BUFFER;

                // 画像取得
                //$markers =  $this->marker->findExpand( $conditions );
                $markers =  $this->marker->find( 'all' );

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
                    $markers_string = "'" . $data->toString( $options + array( 'header' => false) ) . "'";

                }
            }
        }

        // stringの空文字を作成(viewでjavascriptでエラーにならないように)
        if( empty( $markers_string ) ) {

            $markers_string =  "''";
        }

        $this->set( 'markers', $markers_string );
        $this->render( 'index' );
    }
    // }}}

    // {{{
    function add() {


    }

}
?>
