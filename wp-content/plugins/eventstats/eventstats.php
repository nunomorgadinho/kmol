<?php 
/*
 * Plugin Name: event stats plugin
* Plugin URI: event stats plugin 
* Description: event stats plugin
* Author: widgilabs
* Version: 1.0
* Author URI: fillme
* License: fillme
*/

//Define plugin directories
define( 'WP_EVENTSTATS_URL', WP_PLUGIN_URL.'/'.plugin_basename(dirname(__FILE__)) );
define( 'WP_EVENTSTATS_DIR', WP_PLUGIN_DIR.'/'.plugin_basename(dirname(__FILE__)) );

register_activation_hook(__FILE__, 'eventstats_activation');
function eventstats_activation() {
	eventstats_db_install();
}

// creates the database tables
function eventstats_db_install(){
	global $wpdb;

	/*
	 * stats table records events
	 * 		event_id - id
	 *		created - timestamp
	 *		event_type - play, like, dislike, complete, download, game error, report_flag, in-game-checkpoint, etc.
	 *		resource_id - game id that is being played, etc.
	 *		source_type - where the event happened: page template kind, iPhone, etc
	 *		source_id - the unique identifier for that source - permalink, iPhone UDID
	 *		user_id - the wordpress user id
	 *		client_useragent - the requester's user agent string,
	 *		client_ipaddress - the client's ip address
	 */
	$eventstats = "CREATE TABLE " . $wpdb->prefix . "eventstats (
	event_id int(11) NOT NULL AUTO_INCREMENT,
	created TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
	event_type text NOT NULL, 
	resource_id int(11) DEFAULT NULL,
	source_type varchar(10) NOT NULL,
	source_id int(11) NOT NULL,
	user_id int(50) NOT NULL,
	client_useragent varchar(400) NOT NULL,
	client_ipaddress varchar(100) NOT NULL,
	PRIMARY KEY (event_id)
	);";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

	dbDelta($eventstats);
}


function eventstats_receive() {

	/*
	 * api call to record an event
	 * 		POST only
	 * 		event_type
	 * 		resource_id
	 * 		source_type
	 * 		source_id
	 * 		user_id
	 */
	if(isset($_REQUEST['log_event']))
	{

		$event_type = $_REQUEST['event_type'];
		$resource_id =  $_REQUEST['resource_id'];
		$source_type = $_REQUEST['source_type'];
		$source_id = $_REQUEST['source_id'];
		$user_id = $_REQUEST['user_id'];
		$client_useragent = $_SERVER['REMOTE_ADDR'];
		$client_ipaddress = $_SERVER['HTTP_USER_AGENT'];
		
		eventstats_log_event($event_type, $resource_id, $source_type, $source_id, $user_id, $client_useragent, $client_ipaddress);
		
		die;
	}

	if(isset($_REQUEST['get_total_counts']))
	{
		$resource_id =  $_REQUEST['resource_id'];
	
		$custom_fields = get_post_custom($resource_id);
		$gfstats_play_sum_alltime = intval($custom_fields['_gfstats_play_sum_alltime'][0]);
		$gfstats_like_sum_alltime = intval($custom_fields['_gfstats_like_sum_alltime'][0]);
		$gfstats_dislike_sum_alltime = intval($custom_fields['_gfstats_dislike_sum_alltime'][0]);

		$result = array();
		$result["plays"] = $gfstats_play_sum_alltime;
		$result["likes"] = 	$gfstats_like_sum_alltime;
		$result["dislikes"] = $gfstats_dislike_sum_alltime;
		
		die('['.json_encode($result).']');
	}
	
}

add_action('init', 'eventstats_receive', 12);


/* utilities */

/* 
 * _gfstats_play_sum_alltime
 * _gfstats_like_sum_alltime
 * _gfstats_dislike_sum_alltime
 */

function eventstats_log_event($event_type, $resource_id=-1, $source_type='', $source_id=-1, $user_id=-1, $client_useragent='', $client_ipaddress='') {
	global $wpdb;
	
	$wpdb->query($wpdb->prepare(
			"INSERT INTO " . $wpdb->prefix . "eventstats
			(event_type, resource_id, source_type, source_id, user_id, client_useragent, client_ipaddress)
			VALUES
			(%s, %s, %s, %s, %s, %s, %s)
			", $event_type, $resource_id, $source_type, $source_id, $user_id, $client_useragent, $client_ipaddress
	));
	
	/* update global counts */
	// resource_id is our game id
	// event_type is play, like or dislike
	$custom_fields = get_post_custom($resource_id);
	$gfstats_play_sum_alltime = intval($custom_fields['_gfstats_play_sum_alltime'][0]);
	$gfstats_like_sum_alltime = intval($custom_fields['_gfstats_like_sum_alltime'][0]);
	$gfstats_dislike_sum_alltime = intval($custom_fields['_gfstats_dislike_sum_alltime'][0]);
	
	if ($event_type == "play") {
		if (!update_post_meta($resource_id, '_gfstats_play_sum_alltime', ($gfstats_play_sum_alltime+1))) {
			$newvalue=1;
			add_post_meta($resource_id, '_gfstats_play_sum_alltime', 1, true);
		} else {
			$newvalue=$gfstats_play_sum_alltime+1;
		}
		echo $newvalue;
	}

	if ($event_type == "like") {
		if (!update_post_meta($resource_id, '_gfstats_like_sum_alltime', ($gfstats_like_sum_alltime+1))) {
			$newvalue=1;
			add_post_meta($resource_id, '_gfstats_like_sum_alltime', 1, true);
		} else {
			$newvalue=$gfstats_like_sum_alltime+1;
		}
		echo $newvalue;
	}

	if ($event_type == "dislike") {
		if (!update_post_meta($resource_id, '_gfstats_dislike_sum_alltime', ($gfstats_dislike_sum_alltime+1))) {
			$newvalue=1;
			add_post_meta($resource_id, '_gfstats_dislike_sum_alltime', 1, true);
		} else {
			$newvalue=$gfstats_dislike_sum_alltime+1;
		}
		echo $newvalue;
	}
}




/**
 * 
 * Adding menu pages for stats display
 */

add_action( 'admin_menu', 'stats_menu' );

function stats_menu() {

	add_menu_page( 'KMOL Stats', 'KMOL Stats', 'manage_options', 'kmol-stats', 'kmol_stats' );

}


function kmol_stats() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap">';
	display_content();
	echo '</div>';
}



function display_content(){
	?>

	<h2><?php _e('Estatísticas KMOL','eventstats');?></h2>

	
	
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script type="text/javascript"> google.load('visualization', '1.0', {'packages':['corechart']});</script>
	<script type="text/javascript" src="<?php echo WP_PLUGIN_URL.'/'.plugin_basename(dirname(__FILE__)) ?>/js/charts.js"></script>

	<link type="text/css" href="<?php echo WP_PLUGIN_URL.'/'.plugin_basename(dirname(__FILE__)) ?>/css/smoothness/jquery-ui-1.8.22.custom.css" rel="stylesheet" />
		<script type="text/javascript" src="<?php echo WP_PLUGIN_URL.'/'.plugin_basename(dirname(__FILE__)) ?>/js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="<?php echo WP_PLUGIN_URL.'/'.plugin_basename(dirname(__FILE__)) ?>/js/jquery-ui-1.8.22.custom.min.js"></script>
	
	
	
	
	<div class="tool-box">

	
	<p><?php _e('Esta secção vai permitir consultar um conjunto de métricas de interesse para a marca KMOL.','eventstats');?><br/>
	<?php _e('Vai poder consultar, o número de registos e subscrições à newsletter por dia;','eventstats');?>
	</p>
	</div>
	
	
	
	<div id="tabs">
	<ul>
		<li><a id="tb1" href="#tabs-1"><?php _e('Registo Site','eventstats')?></a></li>
		<li><a id="tb2" href="#tabs-2"><?php _e('Subscrição da Newsletter','eventstats');?></a></li>
	</ul>
	
	
	<div id="tabs-1">
		
			<p>
				<strong><?php _e('Total de Registos:','eventstats');?></strong> <?php $total = get_total('register'); echo $total;?>
			</p>
			<p><?php _e('Escolha o Intervalo de tempo que quer pesquisar.','eventstats');?></p>
			<p>
				<?php _e('de','eventstats');?> <input type="text" id="mindatepicker" class="fav-first" value="" />
				<?php _e('até','eventstats');?> <input type="text" id="maxdatepicker" class="fav-first" value="" /><button id="drawg" type="button"><?php _e('Go','eventstats');?></button>
			</p>

				<?php if($total >0){?>
				<div id="register"></div>
				<?php }?>
		
	</div> <!-- tabs-1 -->
	
	
	
	<div id="tabs-2">
	<p>
		<?php $total = get_total('subscription'); ?>
		<strong><?php _e('Total subscrições newsletter')?></strong> <?php echo $total;?>
	</p>
	
	<p><?php _e('Escolha o Intervalo de tempo que quer pesquisar.','eventstats');?></p>
		<p>
			<?php _e('de','eventstats');?> <input type="text" id="mindatepicker2" class="fav-first" value="" />
			<?php _e('até','eventstats');?> <input type="text" id="maxdatepicker2" class="fav-first" value="" /><button id="drawg2" type="button"><?php _e('Go','eventstats');?></button>
	</p>
	
	<?php if($total >0){?>
	
	<div id="subscription"></div>
	
	
	
	<?php }?>
	</div> <!-- tabs 2 -->
	
</div><!-- #tabs -->
	
		
	<?php 
	
}



function get_total( $event_type){
		$result = 0;
		
		global $wpdb;
		
		$res = $wpdb->get_results($wpdb->prepare(
				"SELECT * FROM " . $wpdb->prefix . "eventstats
				WHERE event_type =  %s
				", $event_type
		));
		
	
		
		if($res)
			$result = count($res);
		
		return $result;
}


function get_by_date($event_type, $date_start, $date_end)
{
	// select distint das datas.
	global $wpdb;
	
	//get all dates
	$myrows = $wpdb->get_results($wpdb->prepare(
				"SELECT DISTINCT DATE(created) AS date FROM " . $wpdb->prefix . "eventstats
				WHERE event_type =  %s AND created BETWEEN %s AND %s ORDER BY created DESC
				", $event_type, $date_start, $date_end
		 ));
	
	$result = array();
	
	if(empty($myrows)) return $result; // leave nothing on database
	
	switch ($event_type) {
		case 'register':
		$result[] = array("Data", "Registos");
		break;
		
		case 'subscription':
		$result[] = array("Data", "Subscrição Newsletter");
		break;
		
	}
	
	
	
	// get stats by day
	foreach ($myrows as $date)
	{
		
		$nemails = 0;
		
		if($event_type == 'popystyle')
		{
			// get by style
			
			//popycasual
			$onthisdate = $wpdb->get_results($wpdb->prepare(
					"SELECT * FROM " . $wpdb->prefix . "eventstats
					WHERE DATE(created) =  %s AND event_type = %s AND source_type = %s
					", $date->date , $event_type, 'casual'
			));
			
			$causal = count($onthisdate);
			
			
			//popyclassic
			$onthisdate = $wpdb->get_results($wpdb->prepare(
					"SELECT * FROM " . $wpdb->prefix . "eventstats
					WHERE DATE(created) =  %s AND event_type = %s AND source_type = %s
					", $date->date , $event_type, 'classic'
			));
			
			$classic = count($onthisdate);
			
			//popyfashion
			$onthisdate = $wpdb->get_results($wpdb->prepare(
					"SELECT * FROM " . $wpdb->prefix . "eventstats
					WHERE DATE(created) =  %s AND event_type = %s AND source_type = %s
					", $date->date , $event_type, 'fashion'
			));
			
			$fashion = count($onthisdate);
			
			
			//popyglam
			$onthisdate = $wpdb->get_results($wpdb->prepare(
					"SELECT * FROM " . $wpdb->prefix . "eventstats
					WHERE DATE(created) =  %s AND event_type = %s AND source_type = %s
					", $date->date , $event_type, 'glam'
			));
			
			$glam = count($onthisdate);
			
			//popystar
			$onthisdate = $wpdb->get_results($wpdb->prepare(
					"SELECT * FROM " . $wpdb->prefix . "eventstats
					WHERE DATE(created) =  %s AND event_type = %s AND source_type = %s
					", $date->date , $event_type, 'star'
			));
			
			$star = count($onthisdate);
			
		}
		
		$onthisdate = $wpdb->get_results($wpdb->prepare(
				"SELECT * FROM " . $wpdb->prefix . "eventstats
				WHERE DATE(created) =  %s AND event_type = %s
				", $date->date , $event_type
		));
		
		
		switch ($event_type) {
			
			case 'register':
				$result[] = array($date->date,count($onthisdate));
				
				//echo " No dia <strong>".$date->date."</strong> foram enviados <strong>".count($onthisdate)."</strong> primeiros e-mails.<br/>";
			break;
			
			case 'subscription':
				$result[] = array($date->date,count($onthisdate));
				//echo " No dia <strong>".$date->date."</strong> foram enviados <strong>".count($onthisdate)."</strong> segundos e-mails.<br/>";
			break;		
		}
		
		
	
	}
	// depois para cada um deles fazemos a contagem.
	//die(json_encode($results));
	return $result;
	
}


/* ajax signup */
add_action('wp_ajax_get_by_date', 'get_by_date_callback');

/**
 * 
 */
function get_by_date_callback(){
	$event_type = $_GET['event_type'];
	$date_start =  strtotime($_GET['date_start']);
	$date_end = strtotime($_GET['date_end']);
	
	$date_start = strftime("%Y-%m-%d", $date_start);
	$date_end = strftime("%Y-%m-%d", $date_end);
	
	die(json_encode(get_by_date($event_type,$date_start,$date_end)));

}



add_action('wp_ajax_export_csv', 'export_csv_callback');
add_action('wp_ajax_nopriv_export_csv', 'export_csv_callback');
function export_csv_callback() {
	$data = json_decode(stripslashes($_REQUEST['data']), true);
	//die(var_dump($data));
	$header = $data['header'];
	$body = $data['body'];
	$col_sep = ",";
	$row_sep = "\n";
	$qut = '"';
	$i = 0;
	if ($header)
	{
		foreach ($header as $key => $val)
		{
			//Escaping quotes.
			$val = str_replace($qut, "$qut$qut", $val);
			$output .= "$col_sep$qut$val$qut";
		}
		$output = substr($output, 1).$row_sep;
	}
	function lastAtt($cell_val, $col_sep, $qut) {
		$cell_val = str_replace($qut, "$qut$qut", $cell_val);
		if(is_numeric($cell_val))
			$tmp .= "$col_sep$cell_val";
		else if(is_string($cell_val))
			$tmp .= "$col_sep$cell_val";
		else if(is_array($cell_val)) {
			foreach($cell_val as $key => $val)
				$tmp .= lastAtt($val, $col_sep, $qut);
		}
		else
			$tmp .= "$col_sep$qut$cell_val$qut";
		return $tmp;
	}
	foreach ($body as $key => $val)
	{
		if ($i == 0) {
			$i++;
			continue;
		}
		$tmp = '';
		if(!is_numeric($key))
			$tmp .= lastAtt($key, $col_sep, $qut);
		foreach ($val as $cell_key => $cell_val)
		{
			if($cell_key != 'id')
				$tmp .= lastAtt($cell_val, $col_sep, $qut);
		}
		$output .= substr($tmp, 1).$row_sep;
	}

	header("Content-type: application/csv");
	header("Content-Disposition: attachment; filename=file.csv");
	header("Pragma: no-cache");
	header("Expires: 0");

	die($output);
}


add_action('admin_enqueue_scripts', 'eventstats_admin_scripts');

function eventstats_admin_scripts(){
	wp_enqueue_script('jquery-ui-datepicker');
}

/**
 * Handle newsletter subscriptions events
 * */
add_action('init', 'callback_handler');

function callback_handler() {
	
	
	if(isset($_REQUEST['wysija-page']) && $_REQUEST['wysija-page']==1 && $_REQUEST['controller'] && $_REQUEST['controller']=='confirm' )
	{		
		eventstats_log_event('subscription', '', 'direct-confirmation');
		
	}
}


?>