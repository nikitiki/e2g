<?php e( $html->script( 'vendor/charCount.js' ) ) ?>
<?php e( $html->script( 'docos/common.js' ) ) ?>

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
<?php e( $js->submit( __( 'ツイートする', true ),
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

<div class="twitter_badge">
     <script src="http://widgets.twimg.com/j/2/widget.js"></script>
      <script>
      new TWTR.Widget({
        version: 2,
        type: 'search',
        search: '#rapeco',
        interval: 6000,
        title: 'リアルタイムドコデタベター',
        subject: 'ドコデタベター',
        width: 'auto',
        height: 200,
        theme: {
          shell: {
            background: '#d3e73a',
            color: '#331713'
          },
          tweets: {
            background: '#ffffff',
            color: '#333',
            links: '#C10E24'
          }
        },
        features: {
          scrollbar: false,
          loop: true,
          live: true,
          hashtags: true,
          timestamp: true,
          avatars: true,
          behavior: 'default'
        }
      }).render().start();
      </script>
</div>

</div>
<!--／right-->

<?php e( $html->script( 'docos/add.js' ) ) ?>
