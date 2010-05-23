<?php
/**
 * 
 */
// {{{
class MarkerController extends AppController
{

    var $name = 'marker';
    var $uses = array( 'marker', 'picture' );
    var $helpers = array(
        'Js',
        'Form'
    );


    // {{{
    /**
     *  詳細画面Top
     */
    function index() {

        // 画像ID（マーカーIDがなかったらTop画面遷移）

        // 画像取得

    }
    // }}}


    // {{{
    /**
     * 画像・マーカー追加
     */
    function add() {

        // 

    }
    // }}}


    // {{{ create 
    /**
     *
     */
    function create() {

        // POST only
        if( !empty($this->data) ) {

            // DB登録
            if( $this->marker->save() ) {


                // 詳細画面へ
                $this->redirect( 'controller' => 'marker', 'action' => 'view' );
            } else {

        }

        // 入力画面へ遷移
        $this->render( 'add' );
    }
    // }}}


    // {{{ 
    /**
     *
     */
    function del() {

        // id存在チェック

    }

}
?>
