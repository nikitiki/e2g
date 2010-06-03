<!--left-->
<div id="left">
    <?php e( $html->image( 'top_lead.gif', 
        array( 'width' => 620, 'height' => 182, 'class' => 'lead' ) ) ) ?>

<!-- leftbox -->
<div class="leftbox">

<?php e( $form->create( 'Marker', array( 'url' => '/docos/search',
    'id' => 'MarkerForm', 'div' => false ) ) ) ?>

<!-- search -->
<div class="search">
    <?php e( $html->image( 'search_title.gif', 
        array( 'width' => 385, 'height' => 21, 'alt' => 'Search' ) ) ) ?>

    <div class="search_box">

    <?php e( $form->input( 'Marker.address', array( 'type' => 'text', 
        'label' => false, 'id' => 'address', 'div' => false ) ) ) ?>

    <?php e( $js->submit( 
        'search_go.gif'
        , array( 'target_id' => 'MarkerForm', 'id' => 'search', 
            'div' => false, 'class' => 'search_go' ) ) 
    ) ?>

    </div>
    <br />人気：<a href="">新宿</a>、<a href="">大阪</a>、<a href="">北海道</a>
</div>
<!-- /search -->

<?php e( $form->end() ) ?>

<div class="box_bottom">&nbsp;</div>
</div>
<!-- /leftbox -->

<!-- leftbox -->
<div class="leftbox">
<!-- newentry -->
<div class="newentry">
    <?php e( $html->image( 'entry_title.gif', 
        array( 'width' => 145, 'hight' => 21, 'alt' => 'NEW Entry', 
        'class' => 'entry_title' ) ) ) ?>
    <br />

    <?php /* 画像出力 */ ?>
    <?php foreach( $pictures as $picture ): ?>
    <dl>
        <dt>
         <?php e( $html->link( $html->image( TWITPIC_THUMB. $picture['picture']['twitpic_id'], 
             array( 'width' => 157, 'height' => 150 ) )
/*             , array( 'controller' => 'docos', 'action' => 'view'
                 ,'id' => $picture['picture']['docos_id'] )
*/
             , '/docos/v/' . $picture['picture']['docos_id']
             , array( 'escape' => false ) )
         ); ?>
        </dt>
        <dd>from&nbsp;
            <a href=""><?php e( $picture['picture']['screen_name'] ) ?></a>
        </dd>
    </dl>
    <?php endforeach; ?>
</div>
<!-- /newentry -->
<div class="box_bottom">&nbsp;</div>
</div>
<!-- leftbox -->
</div>
<!--／left-->

<!--right-->
<div id="right">

<div class="topentry">
    <ul>
        <li>
        <?php e( $html->link(
                $html->image( 'top_entry_botan01_off.gif'
                , array( 'width' => 168, 'height' => 53, 'alt' => '投稿' ) )
                , array( 'action' => 'add' ) 
                , array( 'escape' => false )
            ) );
        ?>

        </li>
        <li>
        <?php e( $html->link(
                $html->image( 'top_entry_botan02_off.gif'
                , array( 'width' => 168, 'height' => 53, 'alt' => '使い方' ) )
                , array( 'controller' => 'pages', 'action' => 'use' )
                , array( 'escape' => false )
            ) )
        ?>
        </li>
    </ul>
</div>

<div class="rightbox">
    <div class="news">
    <?php e( $html->image( 'news_title.gif', 
        array( 'width' => 61, 'height' => 15, 'alt' => 'お知らせ' ) ) ) ?>
    <dl>
    <dt>10/05/23</dt>
    <dd>○○○を公開しました。</dd>
    </dl>
    <dl>
    <dt>10/05/23</dt>
    <dd>○○○を公開しました。</dd>
    </dl>
    <dl>
    <dt>10/05/23</dt>
    <dd>○○○を公開しました。</dd>
    </dl>
</div>
<div class="box_bottom">&nbsp;</div>
</div>

<?php e( $this->element( 'twitter_badge' ) ) ?>

</div>
<!--／right-->
