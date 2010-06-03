<?php
/**
 *
 */
// {{{
class Picture extends AppModel
{

    var $name = 'picture';

    var $hasOne = 'Marker';

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

        do {
            // docos_id作成
            $docos_id = $this->getRandomString();

            // 重複チェック処理
            $unique_flg = $this->uniqueCheck( $docos_id );

        } while ( !$unique_flg ) ;

        // インサートデータ格納
        $data = array();
        $data['picture']['docos_id']    = $docos_id;
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

    // {{{
    /**
     * 生成したdocos_idが存在しているか
     *
     * @return 存在していると false していないと true
     */
    function uniqueCheck( $docos_id ) {

        // docos_idで情報取得
        $unique_flg = $this->findByDocosId( $docos_id );

        if( $unique_flg ) {
            return false;
        } else {
            return true;
        }
    }
    // }}}

    //{{{
    /**
     * ランダムな文字列作成
     *
     * @return string 
     */
    function getRandomString() {

        $length = 0;

        // ５文字か６文字か設定
        $odd_or_even  = time() % 2;
        if( $odd_or_even ) {
             $length = 5;
        } else {
             $length = 6;
        }

        // 生成文字列リスト
        $char_list = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        
        // 乱数の種生成
        mt_srand();

        // ランダムな文字列作成
        $str = '';
        for( $i = 0; $i <= $length; $i++ ) {

            $str .= $char_list[ mt_rand( 0, strlen($char_list) -1 ) ];
        }

        return $str;
    }
    // }}}

}
?>

