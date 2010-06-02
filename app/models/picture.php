<?php
/**
 *
 */
// {{{
class Picture extends AppModel
{

   var $name = 'picture';

    // {{{ save
    /**
     * PictureテーブルにTwitPicから返却された値を保存
     *
     * $params $data array
     * $return mixed success insert_id / fail false
     * $author @cypher-woks.com
     */
    function save( $twitpic_data = array() ) {

        if( empty( $twitpic_data ) ) {
            return false;
        }

        // インサートデータ格納
        $data = array();
        $data['picture']['twitpic_id']  = $twitpic_data->id;
        $data['picture']['text']        = $twitpic_data->text;
        $data['picture']['url']         = $twitpic_data->url;
        $data['picture']['width']       = $twitpic_data->width;
        $data['picture']['height']      = $twitpic_data->height;
        $data['picture']['size']        = $twitpic_data->size;
        $data['picture']['type']        = $twitpic_data->type;
        $data['picture']['timestamp']   = $twitpic_data->timestamp;
        $data['picture']['user_id']     = $twitpic_data->user->id;
        $data['picture']['screen_name'] = $twitpic_data->user->screen_name;

         // インサート 
        $res = parent::save( $data );

        if( !$res ) {
            return false;
        }

        // インサートID返却
        return $this->getLastInsertID();
    }
    // }}}

}
?>

