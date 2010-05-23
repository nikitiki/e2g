<?php
/**
 * Marker Model
 *
 */
class Marker extends AppModel
{

    var $name = 'markers';

    // $B%Q%j%G!<%HDj5A(B

    // {{{
    /**
     *
     */
    function findExpand( $latLng= array() ) {

        $cond = array();

        // $B8!:w>r7oDI2CH=Dj(B
        if( !empty( $latLng ) ) {

            // $B<hF@HO0O$N>r7oDI2C(B
            $cond = array(
                'conditions' => array(
                    'marker.lat >' => $latLng['lat_min'],
                    'marker.lat <' => $latLng['lat_max'],
                    'marker.lng >' => $latLng['lng_min'],
                    'marker.lng <' => $latLng['lng_max']
                )
            );
        }

        // $BEj9F2hA|<hF@(B
        $markers = $this->find( 'all', array( 'conditions' => $cond['conditions'] ) );

        return $markers;
    }

}
?>
