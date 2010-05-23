<script type="text/javascript">
//<![CDATA[
    // マーカー取得
    var j_markers = <?php echo $markers ?>;
//]]>
</script>

Google mapを見せてくよ

<br />

<!-- search form -->
<?php e( $form->create( 'Marker', array( 'url' => '/top/search',
 'id' => 'MarkerForm' ) ) ) ?>

検索したい住所
<?php e( $form->input( 'Marker.address', array( 'type' => 'text', 
 'label' => false, 'id' => 'address', 'div' => false ) ) ) ?>

<?php e( $js->submit( __('検索', true ), array( 'target_id' => 'MarkerForm',
 'id' => 'search', 'div' => false ) ) ) ?>
<?php e( $form->end() ) ?>
<!-- /search form -->

<!-- map -->
<div id="map" style="width:650px; height:300px" ></div>
<!-- /map -->


<input type="text" id="text_lat" name="lat" value="" />
<br />
<input type="text" id="text_lng" name="lng" value="" />
<br />
<input type="file" name="picture" />

<?php echo $html->script( 'top/index.js' ) ?>
