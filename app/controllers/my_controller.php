<?php
/**
 *
 */
// {{{
class MyController extends AppController
{

    var $name  = 'My';
    var $uses = array( 'marker', 'picture' );
    var $helpers = array();


    // {{{
    function beforeFilter() {
 
        // ユーザーセッションチェック
        
        // twitterログイン画面へ遷移

        

        // 
        parent::beforeFilter();
    }
    // }}}

    // {{{ index
    /**
     * マイページTop画面
     * 投稿した画像を表示
     */
    function index() {

        // 

    }
    // }}}

}
// }}}
