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
     * $B=i4|2==hM}(B
     * $B%W%m%Q%F%#$N@_Dj(B
     *
     * @param object $controller $B8F$S=P$785%3%s%H%m!<%i!<(B
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
     * $B$D$V$d$-(Bpost
     *
     * @params $twitpic_data object twitpic$B$+$iJV5Q$5$l$?%*%V%8%'%/%H(B
     * @params $marker_data array $B0^EY!"7PEY>pJs(B
     * @params $opions status/update api$B$GMxMQ$G$-$k%Q%i%a!<%?$r%;%C%H(B
     * @return mixed success array / fail false
     * @author @cypher-works.com
     */
    function status_update( $twitpic_data, $marker_data, $options = array() ) {

        // $B%;%C%7%g%s$+$i(Buser_id$B$r<hF@(B
        $user = $this->Session->read( 'User' );
        if( !$user ) {
            return false;
        }
        // access_key$B$H(Baccess_token$B<hF@(B
        $user = $this->_controller->user->findById( $user['id'] );

        // access_token$B$H(Baccess_token_secret$B<hF@(B
        $access_key    = $user['user']['oauth_key'];
        $access_secret = $user['user']['oauth_secret'];

        // status_update$B$KAw?.$9$k%Q%i%a!<%?%;%C%H(B
        $post_data = array();
        $post_data['status'] = $twitpic_data->text;
// @TODO
        $post_data['status'] .= '  ' . $twitpic_data->url;
        $post_data['lat']    = $marker_data['lat'];
        $post_data['long']   = $marker_data['lng'];

        // $B$=$NB>(Bapi$B%Q%i%a!<%?@_Dj(B
        $post_data = array_merge( $post_data, $options );

        // twitter$B$KEj9F(B
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
