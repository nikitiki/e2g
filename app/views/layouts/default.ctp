<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja" dir="ltr">
<head>
<?php echo $this->Html->charset(); ?>
<title>
<?php echo $title_for_layout; ?>
</title>
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-script-type" content="text/javascript" />
<meta name="keywords" content="ココデタベター,twitter,ツイッター" />
<meta name="description" content="ココデタベター" />

<?php

        // icon
        echo $this->Html->meta('icon');

        // css
        echo $this->Html->css('screen.css');

        // jquery
        echo "<!-- jQuery JS  -->\n";
        echo $html->script( 'extjs/jquery-1.4.2.min' );
        echo $html->script( 'extjs/jquery-ui-1.8.1.custom.min.js' );
        echo $html->script( 'extjs/adapter/jquery/ext-jquery-adapter.js' );
        echo "<!-- /jQuery JS -->\n";

        // extjs
        echo "<!-- Ext JS -->\n";
        echo $html->script( 'extjs/ext-all.js' );
        echo $html->script( 'extjs/src/locale/ext-lang-ja.js' );
        echo "<!-- /Ext JS -->";

        // google map api
        echo "<!-- MAP.GOOGLE.JS -->\n";
        echo $html->script('http://maps.google.co.jp/maps?file=googleapi&v=2&key=' . GOOGLE_MAP_API_KEY );
        echo "<!-- /MAP.GOOGLE.JS -->\n";

        // application
        echo "<!-- Application -->\n";
        echo $html->script( 'common/default.js' );
        echo $html->script( 'common/NameSpace.js' );
        echo $html->script( 'common/App.js' );
        echo $html->script( 'common/WindowUtil.js' );
        echo "<!-- /Application -->\n";

		echo $scripts_for_layout;
	?>

<script type="text/javascript">
//<![CDATA[

    var PROJECT_URI = "<?php echo PROJECT_URI ?>";

//]]>
</script>
</head>
<body>
<a name="#top" id="top"></a>
<div id="container">

<div id="wrapper">

<!--header-->
<?php e( $this->element( 'header' ) ) ?>
<!--／header-->

<!--contents-->
<div id="contents">

    <?php echo $content_for_layout; ?>
  
</div>
<!--／contents-->

</div>

<!--footer-->
<?php e( $this->element( 'footer' ) ) ?>
<!--/footer-->

</div>
<!--/container-->

</div>
<?php echo $this->element('sql_dump'); ?>
</body>
</html>
