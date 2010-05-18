<?php echo $this->addScript( $javascript->link('top/index.js') ) ?>
Google mapを見せてくよ

<br />

検索したい住所<input type="text" name="geocode" value="" size="50" />
<input type="button" value="検索" id="search" />

<div id="map" style="width:650px; height:300px" ></div>

<input type="text" id="text_lat" name="lat" value="" />
<br />
<input type="text" id="text_lng" name="lng" value="" />
<br />
<input type="file" name="picture" />
