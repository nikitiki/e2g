<!--left-->
<div id="left">

<div class="leftbox">
<div class="othertitle">美味しい写真と食べた場所を投稿しましょう！</div>
<div class="search">
<strong>1、投稿する地域を入力してください。（例：新宿、大阪）</strong><br />
<div class="search_box"><input type="text" name="user_name" value="" maxlength="" size="" /><img src="img/search_go.gif" width="62" height="34" alt="Search" class="search_go" /></div>
</div>

<!--search表示エリア-->
<!--必要なさそうだからコメントアウト<div class="search_title"><span>検索ワード：</span>新宿</div>-->
<div class="comment">↓食べたお店や場所をクリックしてください↓</div>

<div class="map">
<iframe width="594" height="274" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.co.jp/maps?f=q&amp;source=s_q&amp;hl=ja&amp;geocode=&amp;q=%E6%96%B0%E5%AE%BF&amp;sll=37.370157,136.40625&amp;sspn=56.328832,59.941406&amp;brcurrent=3,0x60188cd4cfbaff57:0x12385d2a418fd33d,0&amp;ie=UTF8&amp;hq=&amp;hnear=%E6%96%B0%E5%AE%BF%E9%A7%85%EF%BC%88%E6%9D%B1%E4%BA%AC%EF%BC%89&amp;ll=35.690921,139.700258&amp;spn=0.024398,0.036478&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe>
</div
<!--／search表示エリア-->

<div class="otherbox">
<strong>2、アップする写真を選んでください。</strong><br />
<input id="yum_upload" name="yum[upload]" size="30" type="file" />
</div>

<div class="otherbox">
<strong>3、どこで何を食べましたか？（全<span style="color: #C10E24;">100</span>文字）</strong><br />
<textarea cols="60" id="yum_tweets_text" name="yum[tweets][text]" rows="10"></textarea>
</div>

<div class="otherbox">
<input id="yum_submit" name="commit" type="submit" value="ツイート" />
</div>

<div class="box_bottom">&nbsp;</div>
</div>

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

