<?php
/**
 * Top Controller
 * PHP 5
 *
 * @category Controller
 * @package
 * @version
 * @author nikitiki
 * @license 
 * @link 
 */

App::import( 'Core', array( 'Xml' ) );

class DocosController extends AppController
{

    var $name = 'docos';
    var $uses = array( 'marker' );
    var $helpers = array(
        'Js',
        'Form',
        'Xml'
    );

    // {{{ index
    function index() {

        // $B:G?7$N%^!<%+!<>pJs<hF@(B
        $markers = $this->marker->find( 'all' );

        // xml$B@_Dj(B
        $options = array(
            'root' => 'markers',     // root$B%N!<%I(B
            'attributes' => false, 
            'format' => 'attributes'
        );

        // xml$B%$%s%9%?%s%9:n@.(B
        $data = new Xml($markers, $options);

        // xml$B$rJ8;zNs$KJQ49(B
        $markers_string = "'" . $data->toString( $options + array( 'header' => false) ) . "'";

        // xml$B:n@.(B
        $this->set( 'markers', $markers_string );

    }
    // }}}

    // {{{ search
    function search() {

        // $B2hA|%G!<%?JV5QMQJQ?t(B
        $markers_string = null;

        // POST
        if( !empty( $this->data ) &&
            $address = Set::extract( 'Marker.address', $this->data ) ) {

            // UTF8$B$KJQ49(B
//            $address = mb_convert_encoding( $address, 'UTF-8', 'AUTO' );

            // URL$B%(%s%3!<%I(B
//            $address = urlencode( $address );

            // $BAw?.%Q%i%a!<%?=i4|2=(B
            $queries = array();

            // $BAw?.%Q%i%a!<%?@8@.(B
            $queries['q']      = $address;
            $queries['key']    = GOOGLE_MAP_API_KEY;
            $queries['sensor'] = false;
            $queries['output'] = 'xml';
            $queries['gl']     = 'jp';

            // $BAw?.(BURL$B@8@.(B
            $url = 'http://maps.google.com/maps/geo?' . http_build_query( $queries );

            // api$BAw?.(B
            $xml = new Xml( $url );

            // $B%*%V%8%'%/%H$rG[Ns$KJQ49(B
            $xml_array = Set::reverse( $xml );

            // api$BDL?.$N%9%F!<%?%9%3!<%I$r<hF@(B
            $status_code = Set::extract( 'Kml.Response.Status.code', $xml_array );

            // $B%8%*%3!<%G%#%s%0$,<hF@$G$-$F$$$l$P(B200
            if( $status_code == "200" ) {

                // $B%8%*%3!<%G%#%s%0<hF@(B
                $geocoding = Set::extract( 'Kml.Response.Placemark.Point.coordinates', $xml_array );

                // $B0^EY!"7PEY!"9bEY$KJ,3d(B
                $geocoding = explode( ',', $geocoding );

                // $B7PEY<hF@(B
                $lng = $geocoding[0];

                // $B0^EY<hF@(B
                $lat = $geocoding[1];

                // $B2hA|<hF@>r7o3JG<JQ?t(B
                $conditions = array();

                // $BI=<(HO0O!J$h$j$A$g$C$H9-$a!K$N0^EY$r<hF@(B
                $conditions['lat_min'] = (float)$lat - LAT_BUFFER;
                $conditions['lat_max'] = (float)$lat + LAT_BUFFER;

                // $BI=<(HO0O!J$h$j$A$g$C$H9-$a!K$N7PEY$r<hF@(B
                $conditions['lng_min'] = (float)$lng - LNG_BUFFER;
                $conditions['lng_max'] = (float)$lng + LNG_BUFFER;

                // $B2hA|<hF@(B
                //$markers =  $this->marker->findExpand( $conditions );
                $markers =  $this->marker->find( 'all' );

                if( $markers ) {

                    // xml$B@_Dj(B
                    $options = array(
                        'root' => 'markers',     // root$B%N!<%I(B
                         'attributes' => false, 
                         'format' => 'attributes'
                    ); 

                   // xml$B%$%s%9%?%s%9:n@.(B
                   $data = new Xml($markers, $options);

                    // xml$B$rJ8;zNs$KJQ49(B
                    $markers_string = "'" . $data->toString( $options + array( 'header' => false) ) . "'";

                }
            }
        }

        // string$B$N6uJ8;z$r:n@.(B(view$B$G(Bjavascript$B$G%(%i!<$K$J$i$J$$$h$&$K(B)
        if( empty( $markers_string ) ) {

            $markers_string =  "''";
        }

        $this->set( 'markers', $markers_string );
        $this->render( 'index' );
    }
    // }}}

    // {{{
    function add() {


    }

}
?>
