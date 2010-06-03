<?php
/**
 * Marker Model
 *
 */
class Marker extends AppModel
{

    var $name = 'marker';

    var $belongsTo = 'Picture';

    var $webroot  = null;

    // パリデート定義

    // {{{ findExpand
    /**
     * 表示されているより広い範囲で画像取得
     */
    function findExpand( $latLng= array() ) {

        $cond = array();

        // 検索条件追加判定
        if( !empty( $latLng ) ) {

            // 取得範囲の条件追加
            $cond = array(
                'conditions' => array(
                    'marker.lat >' => $latLng['lat_min'],
                    'marker.lat <' => $latLng['lat_max'],
                    'marker.lng >' => $latLng['lng_min'],
                    'marker.lng <' => $latLng['lng_max']
                ),
/*
                'fields' => array( 
                    'marker.*',
                    'picture.url as Marker.url' ),
                'joins' => array(
                    array( 'type'  => 'LEFT',
                           'table' => 'pictures',
                           'alias' => 'picture',
                           'conditions' => "`marker`.`picture_id` = `picture`.`id`"
                    )
                )
*/
            );
        }

        // 投稿画像取得
        $markers = $this->find( 'all', $cond );

        if( !$markers ) {
            return false;
        }

        // なんとかしたいこのアホな処理
        // markerとpictureに配列が分かれるのが問題。
        // pictureのカラムurlをmarkerの中で取得したい
        $res = array();
        foreach( $markers as $index => $marker ) {
            $res[$index] = $marker;
            $res[$index]['Marker']['url'] = TWITPIC_MINI . Set::extract( 'Picture.twitpic_id', $marker );
            $res[$index]['Marker']['text'] = Set::extract( 'Picture.text', $marker );
            $res[$index]['Marker']['view_url'] = KOKODE_URL . 'v/' . Set::extract( 'Picture.docos_id', $marker );
        }
        return $res;
    }
    // }}}


}
?>
