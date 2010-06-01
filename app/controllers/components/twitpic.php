<?php
/**
 * TwitPic
 */
class TwitpicComponent extends Object
{

    var $components = array( 'OauthConsumer', 'Session' );

    // twitpicのApiキー
    var $twitpic_api_key;

    // twitpicアップロードAPI URL
    var $twitpic_url;

    // oauth用twitter確認URL
    var $twitter_verify_url;

    // twitter_cosumer_key
    var $twitter_consumer_key;

    // twitter_consumer_secret
    var $twitter_consumer_secret;


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

        // 設定情報を保存
        $this->twitpic_api_key    = TWITPIC_API_KEY;
        $this->twitpic_url        = TWITPIC_URL;
        $this->twitter_verify_url = TWITTER_VERYFY_URL;
        
    }
    // }}}


    // {{{ starup
    /**
     * 初期化処理
     * 処理を開始
     *
     * @param object $controller 呼び出し元コントローラー
     * @access public
     * @return void
     * @author @cypher-works.com
     */
    function startup( &$controller ) {
    }
    // }}}


    // {{{  upload
    /**
     * 写真投稿
     */
    function upload( $picture ) {

        $media = Set::extract( 'file', $picture );

        if( empty( $media ) ) {
            return false;
        }

        // twtpicへの投稿データ作成
        $postdata = array();
        $postdata['key']     = $this->twitpic_api_key;
        $postdata['media']   = '@' . $media['tmp_name'];
        $postdata['message'] = html_entity_decode( $picture['text'] );

        // twitterのconsumer_keyとconsumer_secretを取得
        $consumer = $this->OauthConsumer->createConsumer( 'twitter' );

        // consumer_keyとconsumer_secretをセット
        $this->twitter_consumer_key = $consumer->key;
        $this->twitter_consumer_secret = $consumer->secret;

        // user情報取得
        $user = $this->Session->read( 'User' );
        if( !$user ) {
            return false;
        }
        $user = $this->_controller->user->findById( $user['id'] );

        // access_tokenとaccess_token_secret取得
        $access_key    = $user['user']['oauth_key'];
        $access_secret = $user['user']['oauth_secret'];

        // tokenをオブジェクトに変換
        $accessToken = new OAuthToken($access_key, $access_secret);

        // リクエスト初期設定
        $request = OAuthRequest::from_consumer_and_token($consumer, $accessToken, 'GET', $this->twitter_verify_url );

        // シグネチャ設定
        $request->sign_request(new OAuthSignatureMethod_HMAC_SHA1(), $consumer, $accessToken);

        // httpヘッダ作成
        // x-verify-credentials-authorization用のhttpヘッダ
        $x_verify_url = $request->to_header_x_verify( 'http://api.twitter.com/' );

        // x-auth_service-provider用のhttpヘッダ
        // erify_credentials を行う twitpic API v2 指定の URL 
        $x_auth_url = 'X-Auth-Service-Provider: ' . $this->twitter_verify_url;

        // ヘッダーに格納
        $header = array();
        $header[] = $x_verify_url;
        $header[] = $x_auth_url;

         // curl処理
         $curl = curl_init();
         curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
         curl_setopt($curl, CURLOPT_HEADER, false);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($curl, CURLOPT_BINARYTRANSFER, true);
         curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
         // twitpic api
         curl_setopt($curl, CURLOPT_URL, $this->twitpic_url );
         // twitpic への投稿データ用
         curl_setopt($curl, CURLOPT_POST, true);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata );
         curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

         // 送信
         $result = curl_exec( $curl );

         if($result === false) {
             $json = 'Curl error: ' . curl_error($curl);
         } else {
             $json = json_decode($result);
         }
         curl_close($curl);

         return $json;
    }
    // }}}

}
?>
