<?php
/*
Plugin Name: Instaflavor
Plugin URI: http://firetwister.com/instaflavor
Description: Automatic FLV and thumbnail generator
Author: Ates Goral
Version: 0.1
Author URI: http://magnetiq.com/
*/

function insertHeader() {
    $url_base = WP_PLUGIN_URL . '/'
        . str_replace(basename( __FILE__), "", plugin_basename(__FILE__));
?>
<link href="<?php echo $url_base; ?>instaflavor.css" type="text/css" rel="stylesheet"/>
<script src="http://cdn.jquerytools.org/1.0.2/jquery.tools.min.js"></script>
<script src="http://static.flowplayer.org/js/flowplayer-3.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo $url_base; ?>instaflavor.js"></script>
<script type="text/javascript">var instaflavor_plugin_url = "<?php echo $url_base; ?>";</script>
<?php
}

add_action('wp_head', 'insertHeader');
?>
