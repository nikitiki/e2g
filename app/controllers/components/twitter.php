<?php
/**
 * Twitter component
 * 
 */
class TwitterComponent extends Object
{

    var $components = array( 'OauthConsumer', 'Session' );

    // {{{ initialize
    /** 
     * 初期化処理
     * プロパティの設定
     *
     * @param object $controller 呼び出し元コントローラー
     * @access pubic
     * @return void
     * @author @cypher-works.com
     */
    function initialize( &$controller ) { 

        $this->_controller =& $controller;
    }   
    // }}}



    // {{{ status_update
    /**
     * つぶやきpost
     *
     * @params $twitpic_data object twitpicから返却されたオブジェクト
     * @params $marker_data array 緯度、経度情報
     * @params $opions status/update apiで利用できるパラメータをセット
     * @return mixed success array / fail false
     * @author @cypher-works.com
     */
    function status_update( $twitpic_data, $marker_data, $options = array() ) {

        // セッションからuser_idを取得
        $user = $this->Session->read( 'User' );
        if( !$user ) {
            return false;
        }
        // access_keyとaccess_token取得
        $user = $this->_controller->user->findById( $user['id'] );

        // access_tokenとaccess_token_secret取得
        $access_key    = $user['user']['oauth_key'];
        $access_secret = $user['user']['oauth_secret'];

        // status_updateに送信するパラメータセット
        $post_data = array();
        $post_data['status'] = $twitpic_data->text;
// @TODO
        $post_data['status'] .= '  ' . $twitpic_data->url;
        $post_data['lat']    = $marker_data['lat'];
        $post_data['long']   = $marker_data['lng'];

        // その他apiパラメータ設定
        $post_data = array_merge( $post_data, $options );

        // twitterに投稿
        $json = $this->OauthConsumer->post("twitter", 
            TWITTER_UPDATE_STATUS,
            $post_data, 
            $access_key, 
            $access_secret );

        $res = json_decode( $json );

        if( isset( $res->error ) ) {
            return false;
        }

        return $res;

    }
    // }}}

}
?>
