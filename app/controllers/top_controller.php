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

class TopController extends AppController
{

    var $name = 'top';
    var $uses = array( 'marker' );
    var $helpers = array(
        'Javascript',
        'Ajax',
        'Xml'
    );

    // {{{ index
    /**
     *
     */
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
        $data =& new Xml($markers, $options);

        // xml作成
        $this->set( 'markers', $data->toString($options + array('header' => false)) );

    }
    // }}}
}
?>
