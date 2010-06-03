<?php e( $html->script( 'vendor/charCount.js' ) ) ?>
<?php e( $html->script( 'docos/common.js' ) ) ?>


<?php /* @TODO Growlで表示 */ ?>
<?php echo $session->flash(); ?>

<!--left-->
<div id="left">

<!-- form -->
<?php e( $form->create( 'Picture', array( 'url' => '/docos/create', 
 'id' => 'PictureForm', 'type' => 'file' ) ) ) ?>

<div class="leftbox">
<div class="othertitle">美味しい写真と食べた場所を投稿しましょう！</div>

<!-- search -->
<div class="search">
<strong>1、投稿する地域を入力してください。（例：新宿、大阪）</strong><br />
    <div class="search_box">

        <?php e( $form->input( 'Marker.address', array( 'type' => 'text', 
            'label' => false, 'id' => 'address', 'div' => false ) ) ) ?>


        <?php e( $js->submit( 'search_go.gif',
            array( 'div' => false, 'class' => 'search_go', 'id' => 'search',))
        ) ?>

    </div>
</div>
<!-- /search -->

<!--search表示エリア-->
<div class="comment">↓食べたお店や場所をクリックしてください↓</div>

<div class="map" id="map">
</div
<!--／search表示エリア-->

<div class="otherbox">
    <strong>2、アップする写真を選んでください。</strong><br />
    <?php e( $form->input( 'file', array( 'type' => 'file',
        'size' => 30, 'label' => false, 'div' => false ) ) ) ?>
</div>

<div class="otherbox">
<strong>3、どこで何を食べましたか？
  （のこり
  <span id="counter" class="counter">100</span>
  文字）</strong><br />

<?php e( $form->input( 'text', array( 'type' => 'textarea',
    'id' => 'text', 'label' => false, 'div' => false, 
    'cols' => 60, 'rows' => 10, 'text' ) ) ) ?>

</div>

<div class="otherbox">
<?php e( $js->submit( 'botan_twit.gif',
    array( 'target_id' => 'PictureForm', 'div' => false ) ) ) ?>


</div>

<div class="box_bottom">&nbsp;</div>
</div>

<?php e( $form->hidden( 'Marker.lat', array( 'id' => 'lat' ) ) ) ?>
<?php e( $form->hidden( 'Marker.lng', array( 'id' => 'lng' ) ) ) ?>

<?php e( $form->end() )  ?>

</div>
<!--／left-->

<!--right-->
<div id="right">

<?php e( $this->element( 'twitter_badge' ) ) ?>
</div>
<!--／right-->

<?php e( $html->script( 'docos/add.js' ) ) ?>
