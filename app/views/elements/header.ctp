<div id="header">
<div id="logo">
<h1>
    <?php e( $html->link( $html->image( 'logo.gif' 
                , array( 'width' => 273, 'height' => 57 ) )
                , array( 'controller' => 'docos', 'action' => 'index' )
                , array( 'escape' => false )
            )
        );
    ?>
</h1>
</div>

<div id="menu">
<ul>
<li><?php e( $html->link( 'ホーム',
    array( 'controller' => 'docos', 'action' => 'index'  ) ) ) ?>
</li>
<li><?php e( $html->link( '使い方',  
    array( 'controller' => 'pages', 'action' => 'use' ) ) ) ?>
</li>
<li><?php e( $html->link( '新着フォト',
    array( 'controller' => '', 'action' => '' ) ) ) ?>
</li>
<li><?php e( $html->link( 'マイページ',
    array( 'controller' => '', 'action' => '' ) ) ) ?>
</li>

<li class="entry">
    <?php e(
        $html->link( $html->image( 'menu_entry_off.gif',
            array( 'width' => 89, 'height' => 39, 'alt' => '投稿する' ) )
            , array( 'controller' => 'docos', 'action' => 'add' )
            , array( 'escape' => false )
        )
    ); ?>
</li>
</ul>
</div>
</div>
