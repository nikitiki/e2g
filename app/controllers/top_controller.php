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

class TopController extends AppController
{

    var $name = 'top';
    var $uses = array( 'marker' );
    var $helpers = array(
        'Javascript',
        'Ajax',
        'Xml'
    );

    // {{{ index
    /**
     *
     */
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
        $data =& new Xml($markers, $options);

        // xml$B:n@.(B
        $this->set( 'markers', $data->toString($options + array('header' => false)) );

    }
    // }}}
}
?>
