<?php
/**
 * Marker Model
 *
 */
class Marker extends AppModel
{

    var $name = 'markers';

    // パリデート定義

    // {{{
    /**
     *
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
                )
            );
        }

        // 投稿画像取得
        $markers = $this->find( 'all', array( 'conditions' => $cond['conditions'] ) );

        return $markers;
    }

}
?>
