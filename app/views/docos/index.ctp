<script type="text/javascript">
//<![CDATA[
    // マーカー取得
    var j_markers = <?php echo $markers ?>;
//]]>
</script>

<!--left-->
<div id="left">
    <?php e( $html->image( 'top_lead.gif', 
        array( 'width' => 620, 'height' => 182, 'class' => 'lead' ) ) ) ?>

<div class="leftbox">
<div class="search">
    <?php e( $html->image( 'search_title.gif', 
        array( 'width' => 385, 'height' => 21, 'alt' => 'Search' ) ) ) ?>

    <div class="search_box">

    <?php e( $form->input( 'Marker.address', array( 'type' => 'text', 
        'label' => false, 'id' => 'address', 'div' => false ) ) ) ?>

    <?php e( $html->image( 'search_go.gif', array( 'alt' => 'Search',
        'width' => 62, 'height' => 34, 'class' => 'search_go' ) ) ) ?>

    </div>
    <br />人気：<a href="">新宿</a>、<a href="">大阪</a>、<a href="">北海道</a>
    </div>
    <div class="box_bottom">&nbsp;</div>
    </div>

<div class="leftbox">
<div class="newentry">
    <?php e( $html->image( 'entry_title.gif', 
        array( 'width' => 145, 'hight' => 21, 'alt' => 'NEW Entry', 
        'class' => 'entry_title' ) ) ) ?>
    <br />

<dl>
<dt>
     <?php e( $html->link( $html->image( 'sample.jpg', 
         array( 'width' => 187, 'height' => 140 ) )
         , array( 'controller' => 'docos', 'action' => 'view' )
         , array( 'escape' => false ) )
      ); ?>
</dt>
<dd>from&nbsp;<a href="">tikitikipoo</a>
</dd>
</dl>
<dl>
<dt><a href="details.html"><img src="img/sample.jpg" width="187" height="140" alt="" /></a></dt>
<dd>from&nbsp;<a href="">tikitikipoo</a>
</dd>
</dl>
<dl>
<dt><a href="details.html"><img src="img/sample.jpg" width="187" height="140" alt="" /></a></dt>
<dd>from&nbsp;<a href="">tikitikipoo</a>
</dd>
</dl>
</div>
<div class="box_bottom">&nbsp;</div>
</div>

</div>
<!--／left-->

<!--right-->
<div id="right">

<div class="topentry">
<ul>
<li><a href=""><img src="img/top_entry_botan01_off.gif" width="168" height="53" alt="投稿する" /></a></li>
<li><a href=""><img src="img/top_entry_botan02_off.gif" width="168" height="53" alt="使い方" /></a></li>
</ul>
</div>

<div class="rightbox">
<div class="news">
<img src="img/news_title.gif" width="61" height="15" alt="お知らせ" />
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
