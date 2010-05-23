<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
        <meta http-equiv="Cache-Control" content="no-cache">
	<?php
		echo $this->Html->meta('icon');

//		echo $this->Html->css('cake.generic');

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
        echo $html->script( 'common/NameSpace.js' );
        echo $html->script( 'common/App.js' );
        echo $html->script( 'common/WindowUtil.js' );
        echo "<!-- /Application -->\n";

		echo $scripts_for_layout;
	?>

<script type="text/javascript">
//<![CDATA[

    var PROJECT_URI = "<?php echo $PROJECT_URI ?>";

//]]>
</script>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1></h1>
			<?php echo $this->Session->flash(); ?>

			<?php echo $content_for_layout; ?>

		</div>
		<div id="footer">
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
