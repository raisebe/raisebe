<?php
/**
Plugin Name: CWS SVGicons
Plugin URI: http://cwsthemes.com/
Description: Adds support of SVG icons.
Text Domain: cws-svgi
Version: 1.5.4
*/

define( 'CWSSVGI_VERSION', '1.5.4' );
define( 'CWS_SVGI_REQUIRED_WP_VERSION', '4.0' );

if (!defined('CWSSVGI_HOST'))
	define('CWSSVGI_HOST', 'http://up.cwsthemes.com/cws-svgicons/');

if (!defined('CWS_SVGI_THEME_DIR'))
	define('CWS_SVGI_THEME_DIR', ABSPATH . 'wp-content/themes/' . get_template());

if (!defined('CWS_SVGI_HOST'))
	define('CWS_SVGI_HOST', 'http://up.cwsthemes.com/cws-svgicons');

if (!defined('CWS_SVGI_PLUGIN_NAME'))
	define('CWS_SVGI_PLUGIN_NAME', trim(dirname(plugin_basename(__FILE__)), '/'));

if (!defined('CWS_SVGI_PLUGIN_DIR'))
	define('CWS_SVGI_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . CWS_SVGI_PLUGIN_NAME);

if (!defined('CWS_SVGI_PLUGIN_URL'))
	define('CWS_SVGI_PLUGIN_URL', WP_PLUGIN_URL . '/' . CWS_SVGI_PLUGIN_NAME);

$theme = wp_get_theme();
if ($theme->get( 'Template' )) {
	define('CWSSVGI_THEME_SLUG', $theme->get('Template'));
} else {
	define('CWSSVGI_THEME_SLUG', $theme->get('TextDomain'));
}

add_action('admin_menu', 'cws_svgi_plugin_menu');

function cws_svgi_plugin_menu() {
	add_theme_page('CWS SVGIcons Options', 'CWS SVGIcons', 'edit_theme_options', 'cws_svgicons', 'cws_svgi_page');
}

function cws_svgi_page() {
	if (isset($_FILES['zip_import'])) {
		global $wp_filesystem;
		WP_Filesystem();

		$collection = $_POST['collection'];

		$upload = wp_handle_upload( $_FILES['zip_import'], array( 'test_form' => false, 'test_type' => false ) );
		if ( isset( $upload['error'] ) ) { return; }

		$upload_dir = wp_upload_dir();
		$svg_folder = $upload_dir['basedir'] . '/cws-svgicons/' . md5($collection) . '/';
		//if ( $wp_filesystem->is_dir($svg_folder) )
			//$wp_filesystem->delete($svg_folder, true);
		$result = extract_svg( $upload['file'], $svg_folder );
		unlink($upload['file']);
		$old_value = get_option('cwssvgi');
		if (empty($old_value)) {
			$old_value = array($collection => $result);
		} else {
			$old_value[$collection] = $result;
		}
		update_option('cwssvgi', $old_value);
		esc_html_e('All done, have fun!', CWSSVGI_THEME_SLUG);
		echo '<script>parent.window.location.reload(true);</script>';
	} else if (isset($_FILES['settings_import'])) {
		$upload = wp_handle_upload( $_FILES['settings_import'], array( 'test_form' => false, 'test_type' => false ) );
		if ( isset( $upload['error'] ) ) { return; }
		$upload_dir = wp_upload_dir();
		$svg_folder = $upload_dir['basedir'] . '/cws-svgicons/';
		$zip = new ZipArchive;
		if ($zip->open($upload['file']) === TRUE) {
			$zip->extractTo($svg_folder);
			$zip->close();
			$read_json = file_get_contents($svg_folder . '/cwssvgi.json');
			if ($read_json) {
				$svgi = json_decode($read_json, true);
				if (is_array($svgi)) {
					if (isset($svgi['cwssvgi_o'])) {
						update_option('cwssvgi', $svgi['cwssvgi_o']);
					}
					if (isset($svgi['cwssvgi_t'])) {
						// create table if not exist and replace everything with new values
						global $wpdb;
						$cwssvgi_tname = $wpdb->prefix . 'cwssvgi';
						cwssvgi_plugin_loaded();
						$svgi_t = $svgi['cwssvgi_t'];
						foreach ($svgi_t as $name => $atts) {
							$wpdb->query("INSERT INTO $cwssvgi_tname(name, atts) VALUES('$name', '$atts') ON DUPLICATE KEY
UPDATE name=VALUES(name), atts=VALUES(atts)");
						}
					}
				}
			}
			unlink($svg_folder . '/cwssvgi.json');
		}
		echo '<script>parent.window.location.reload(true);</script>';
	} else {
		$bytes = apply_filters( 'import_upload_size_limit', wp_max_upload_size() );
		$size = size_format( $bytes );
		$upload_dir = wp_upload_dir();
		if ( ! empty( $upload_dir['error'] ) ) :
			?><div class="error"><p><?php esc_html_e('Before you can upload your import file, you will need to fix the following error:', 'cws_svgicons'); ?></p>
			<p><strong><?php echo $upload_dir['error']; ?></strong></p></div><?php
		else :
	?>
			<p>
			<form enctype="multipart/form-data" id="cwsfi-upload-form" method="post" class="wp-form" action="<?php echo esc_url( wp_nonce_url( 'themes.php?page=cws_svgicons', 'cwsfi-upload' ) ); ?>">
			<label for="collection"><?php esc_html_e( 'New Collection name:', 'cws_svgicons'); ?></label>
			<input type="text" name="collection" value="New Collection" />
			<span class="error collection" style="display:none"><?php esc_html_e( 'This collection already exits. Use some other name or delete existent collection first.', 'cws_svgicons'); ?></span>
			<label for="upload"><?php esc_html_e( 'Choose a zip file you\'ve downloaded from http://www.flaticon.com/ :', 'cws_svgicons'); ?></label> (<?php printf( esc_html__('Maximum size: %s', 'cws_svgicons'), $size ); ?>)
			<input type="file" id="upload" accept=".zip" name="zip_import" size="25" />
			<input type="hidden" name="action" value="save" />
			<input type="hidden" name="max_file_size" value="<?php echo $bytes; ?>" />
			<?php
				submit_button( esc_attr__( 'Import SVGIcons', 'cws_svgicons' ), 'primary', 'cwsfi-upload', false );
				echo '<div class="right_buttons">';
				echo '<a href="'.CWS_SVGI_PLUGIN_URL.'/export.php" name="cwsfi-export" id="cwsfi-export" class="button">Export settings</a>';
				submit_button( esc_attr__( 'Import settings', 'cws_svgicons' ), 'secondary', 'cwsfi-import', false );
				echo '</div>';
			?>
			</form>
			<form enctype="multipart/form-data" style="display:none" id="cwsfi-import-form" method="post" class="wp-form" action="<?php echo esc_url( wp_nonce_url( 'themes.php?page=cws_svgicons', 'cwsfi-import-form' ) ); ?>">
				<label for="upload"><?php esc_html_e( 'Choose a zip file with settings :', 'cws_svgicons'); ?></label> (<?php printf( esc_html__('Maximum size: %s', 'cws_svgicons'), $size ); ?>)
				<input type="file" id="upload" accept=".zip" name="settings_import" size="25" />
				<br/>
				<?php
				submit_button( esc_attr__( 'Import Settings', 'cws_svgicons' ), 'primary', 'cwsfi-import-form', false );
				submit_button( esc_attr__( 'Cancel', 'cws_svgicons' ), 'secondary', 'cwsfi-import-cancel', false );
				?>
			</form>
			</p>
		<?php
			$cwssvgi = get_option('cwssvgi');
			if (!empty($cwssvgi)) {
				require_once( CWS_SVGI_PLUGIN_DIR . '/pbfw.php' );
				require_once( CWS_SVGI_PLUGIN_DIR . '/sections.php' );

				echo '<div class="cwssvgi_container">';
				wp_enqueue_script( 'jquery-ui-selectable');

				wp_enqueue_script('jquery-ui-dialog');
				wp_enqueue_style('wp-jquery-ui-dialog');

				wp_enqueue_style( 'cwssvgi-css', CWS_SVGI_PLUGIN_URL . '/cwssvgi.css');
				wp_enqueue_script( 'cwssvgi-js',  CWS_SVGI_PLUGIN_URL . '/cwssvgi.js', '', CWSSVGI_VERSION, true );
				wp_enqueue_script( 'cwssvgi-fw-js',  CWS_SVGI_PLUGIN_URL . '/cwsfw.js', '', CWSSVGI_VERSION, true );

				echo '<div class="library">';
				$out = '<select name="collections" id="cwssvgi_collections">';
				foreach ($cwssvgi as $k => $v) {
					$out .= '<option value="' . $k . '">' . $k . '</option>';
				}
				$out .= '</select>';
				echo $out;
				submit_button( esc_attr__( 'Delete this Collection', 'cws_svgicons' ), 'secondary', 'cwsfi-delete-collection', false );

				reset($cwssvgi);
				$first_s = key($cwssvgi);
				$upload_dir = wp_upload_dir();
				$this_folder = $upload_dir['basedir'] . '/cws-svgicons/' . md5($first_s) . '/';
				//$this_folder = $upload_dir['baseurl'] . '/cws-svgicons/' . md5($first_s) . '/';
				echo '<ul class="cwssvgi_icons">';

				foreach ($cwssvgi[$first_s] as $key) {
					if (file_exists($this_folder . $key)) {
						echo '<li><i class="svg">'.file_get_contents($this_folder . $key).'</i></li>';
					}
				}
				echo '</ul>';
				echo '</div>';
				echo '<div class="effects">';

				echo '<svg class="primitives" xmlns="http://www.w3.org/2000/svg">';
				echo '<symbol id="circle"><circle cx="25" cy="25" r="24"/></symbol>';
				echo '<symbol id="rect"><rect x="0" y="32" width="40" height="20"/></symbol>';
				echo '<symbol id="ellipse"><ellipse cx="25" cy="35" rx="24" ry="15"/></symbol>';
				echo '<symbol id="line"><rect x="97.72" y="269.57" width="387" height="28" transform="translate(-259.72 152.13) rotate(-45)"/></symbol>';
				echo '<symbol id="polygon"><polygon points="2.91 55.58 0 41.65 21.1 0 47.93 27.04 56.69 49.93 2.91 55.58"/></symbol>';
				echo '<symbol id="polyline"><polygon points="1.11 57.8 0 55.7 29.46 0 32.37 46.2 53.15 0.4 59.5 29.4 58.02 30.6 52.68 6.1 31.2 53.3 28.24 6.5 1.11 57.8"/></symbol>';
				echo '<symbol id="path"><rect y="57" width="9.33" height="9.33"/><rect x="60" width="9.33" height="9.33"/><path class="cls-2" d="M15,69.33C15,22.67,75,72,75,21.67" transform="translate(-10.33 -12.33)"/></symbol>';
				echo '</svg>';

				echo '<div class="layers">';
				echo '<label><input type="checkbox" id="layers_all">(De)select All</label>';
				echo '<div class="layers_inner">';
				echo '</div>';
				echo '</div>';

				echo '</div>'; // effects
				echo '<div class="controls">';
				echo cwssvgi_print_names($manage_css_dlg);
				echo cwssvgi_print_layout($controls, '');
				echo '</div>'; // controls

				echo '<div class="clear"></div>';
				echo '</div>';
			}
		endif;
	}
}

function cwssvgi_print_names($dlg) {
	global $wpdb;
	$cwssvgi_tname = $wpdb->prefix . 'cwssvgi';
	$results = $wpdb->get_results("SELECT name FROM $cwssvgi_tname", ARRAY_A);
	$out = '';
	$out_anim = '';
	$out_pre = '';
	$out_css_pre = '';

	if (count($results) > 0) {
		$out .= '<select id="cwssvgi_names">';
		$out .= '<option value=""></option>';
		foreach ($results as $key => $value) {
			if (0 === strpos($value['name'], '(preset)')) {
				$title = substr($value['name'], 8); // skip preset
				$out_pre .= '<option value="' . $value['name'] . '">' . $title . '</option>';
			} else if (0 === strpos($value['name'], '(css_preset)')) {
				$title = substr($value['name'], 12); // skip css_preset
				$out_css_pre .= '<option value="' . $value['name'] . '">' . $title . '</option>';
			} else {
				$title = $value['name'];
				$out_anim .= '<option value="' . $value['name'] . '">' . $title . '</option>';
			}
		}
		$out .= '<optgroup class="presets" label="Presets">';
		if (!empty($out_pre)) {
			$out .= $out_pre;
		}
		$out .= '</optgroup>';

		$out .= '<optgroup class="css_presets" label="CSS Presets">';
		if (!empty($out_pre)) {
			$out .= $out_css_pre;
		}
		$out .= '</optgroup>';

		$out .= '<optgroup class="animations" label="Animations">';
		$out .= $out_anim;
		$out .= '</optgroup>';
		$out .= '</select>';
	}
	$out .= '&nbsp;<button id="cwssvgi_del_names" class="button button-primary">Delete selected name</button>';
	$out .= '<br/><button id="cwssvgi_manage_css" class="button button-secondary">Manage Preset Css items</button>';

	$out .= '<div style="display:none"><div id="manage_css_dlg" data-title="'.esc_attr('Manage Presets', 'cws-svgi').'">' . cwssvgi_print_layout($dlg, '') . '</div></div>';
	return $out;
}

function cwssvgi_front_script() {
	wp_enqueue_script( 'cwssvgi-f-js',  CWS_SVGI_PLUGIN_URL . '/cwssvgi_f.js', '', CWSSVGI_VERSION, true );
	wp_enqueue_style( 'cwssvgi-f-css',  CWS_SVGI_PLUGIN_URL . '/cwssvgi_f.css' );
}

add_action('wp_enqueue_scripts', 'cwssvgi_front_script');

class CwsSvgNumberingCallback {
	private $counter;

	function __construct($counter) { $this->counter = $counter; }

	public function callback($m) {
		$this->counter++;
		return sprintf("\n%sclass=\"cwssvgi_%d\" ", $m[0], $this->counter);
	}
}

function extract_svg($file, $out_folder) {
	$zip = zip_open($file);
	$out = array();
	if (!empty($zip)) {
		if (!file_exists($out_folder)) {
			mkdir($out_folder, 0777, true);
		}
		while($entry = zip_read($zip)) {
			$filen = zip_entry_name($entry);
			if (strpos($filen, '.svg')) {
				$slashpos = strrpos($filen, '/');
				$slashpos = $slashpos ? $slashpos : -1;
				$filename = substr( $filen, $slashpos+1 );
				if ('Flaticon.svg' !== $filename) {
					zip_entry_open($zip, $entry, "r");
					$svg_content = zip_entry_read($entry, zip_entry_filesize($entry));
					$svg_content = preg_replace('/>\s+/', '>', $svg_content);
					$svg_content = preg_replace('/<\/g>/', '', $svg_content);
					$svg_content = preg_replace('/<g>/', '', $svg_content);
					$svg_content = preg_replace('/(<\?xml|<!--|<!DOCTYPE).*?>/', '', $svg_content);
					$svg_content = preg_replace('/\s+/', ' ', $svg_content);

					$svg_content = preg_replace('/(<svg.[^<]*?)(\s+height=[\'"].+?[\'"])(.[^<]*?>)/', '$1$3', $svg_content);
					$svg_content = preg_replace('/(<svg.[^<]*?)(\s+width=[\'"].+?[\'"])(.[^<]*?>)/', '$1$3', $svg_content);

					$svg_content = preg_replace('/(<svg\s.*?)(\s+id=["\'].*?["\'])/', '$1', $svg_content);
					if (preg_match('/data-cwssvg-init/', $svg_content) != 1){
						if (1 == preg_match('/(<svg\s.[^<]*?class=["\']).*?(["\'])/', $svg_content)) {
							$svg_content = preg_replace('/(<svg\s.[^<]*?class=["\']).*?(["\'])/', "\${1}{$filename}$2", $svg_content);
						} else {
							$svg_content = preg_replace('/(<svg\s+)/', "\${1}class=\"{$filename}\" ", $svg_content);
						}
					}
					//$svg_content = preg_replace('/\s(width|height)=[\'"].+?[\'"]/', '', $svg_content);
					/*
					*/
					// now we need to acquire viewBox params, group everything and add our background layer, invisible by default
					/*preg_match('/viewBox=[\'"][0-9.]+\s+[0-9.]+\s+([0-9.]+)\s+([0-9.]+)/', $svg_content, $viewBox);

					$svg_tag_end = strpos($svg_content, '>');
					$svg_closetag_start = strpos($svg_content, '</svg>', $svg_tag_end);*/

					$counter = -1;
					$callback = new CwsSvgNumberingCallback($counter);

					if (preg_match('/data-cwssvg-init/', $svg_content) != 1){
						$svg_content = preg_replace_callback("/<(circle|path|ellipse|rect|line|polygon|polyline)\s/", array($callback, 'callback'), $svg_content);
						$svg_content = preg_replace('/<svg/', "<svg data-cwssvg-init ", $svg_content);
					}

					$new_svg = fopen($out_folder . $filename, 'w+');
					fwrite($new_svg, $svg_content);
					fclose($new_svg);
					$out[] = $filename;
				}
			}
		}
	}
	return $out;
}

if (!function_exists('zip_open')) {
	function shellfix($s)	{ return "'".str_replace("'", "'\''", $s)."'"; }


	function zip_open($s)	{
		$fp = @fopen($s, 'rb');
		if(!$fp) return false;

		$lines = Array();
		$cmd = 'unzip -v '.shellfix($s);
		exec($cmd, $lines);

		$contents = Array();
		$ok=false;
		foreach($lines as $line)
		{
			if($line[0]=='-') { $ok=!$ok; continue; }
			if(!$ok) continue;

			$length = (int)$line;
			$fn = trim(substr($line,58));

			$contents[] = Array('name' => $fn, 'length' => $length);
		}

		return
			Array('fp'       => $fp,
						'name'     => $s,
						'contents' => $contents,
						'pointer'  => -1);
	}

	function zip_read(&$fp)	{
		if(!$fp) return false;

		$next = $fp['pointer'] + 1;
		if($next >= count($fp['contents'])) return false;

		$fp['pointer'] = $next;
		return $fp['contents'][$next];
	}

	function zip_entry_name(&$res) {
		if(!$res) return false;
		return $res['name'];
	}

	function zip_entry_filesize(&$res) {
		if(!$res) return false;
		return $res['length'];
	}

	function zip_entry_open(&$fp, &$res) {
		if(!$res) return false;

		$cmd = 'unzip -p '.shellfix($fp['name']).' '.shellfix($res['name']);

		$res['fp'] = popen($cmd, 'r');
		return !!$res['fp'];
	}

	function zip_entry_read(&$res, $nbytes)	{
		$contents = '';
		while (!feof($res['fp'])) {
			$contents .= fread($res['fp'], 8192);
		}
		return $contents;
	}

	function zip_entry_close(&$res)	{
		fclose($res['fp']);
		unset($res['fp']);
	}

	function zip_close(&$fp) {
		fclose($fp['fp']);
	}
}

function cwssvgi_plugin_loaded () {
	global $wpdb;
	$cwssvgi_tname = $wpdb->prefix . 'cwssvgi';
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $cwssvgi_tname (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		name varchar(255) NOT NULL,
		atts mediumtext NOT NULL,
		PRIMARY KEY (id),
		UNIQUE KEY name (name(128))
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}

add_action('plugins_loaded', 'cwssvgi_plugin_loaded');

add_action( 'wp_ajax_cwssvgi_ajax_update_template', 'cwssvgi_ajax_update_template' );
add_action( 'wp_ajax_cwssvgi_ajax_get_collection', 'cwssvgi_ajax_get_collection' );
add_action( 'wp_ajax_cwssvgi_ajax_get_animations', 'cwssvgi_ajax_get_animations' );
add_action( 'wp_ajax_cwssvgi_ajax_get_svg_atts', 'cwssvgi_ajax_get_svg_atts' );
add_action( 'wp_ajax_cwssvgi_ajax_del_name', 'cwssvgi_ajax_del_name' );
add_action( 'wp_ajax_cwssvgi_ajax_del_col', 'cwssvgi_ajax_del_col' );

add_action( 'wp_ajax_cwssvgi_ajax_get_css_presets_names', 'cwssvgi_ajax_get_css_presets_names' );
add_action( 'wp_ajax_cwssvgi_ajax_get_css_presets_css', 'cwssvgi_ajax_get_css_presets_css' );
add_action( 'wp_ajax_cwssvgi_ajax_save_css_presets', 'cwssvgi_ajax_save_css_presets' );

function cwssvgi_ajax_get_svg_atts() {
	if ( wp_verify_nonce( $_REQUEST['nonce'], 'cwssvgi_ajax') ) {
		$results = getSvgParams($_POST['name']);
		if (!empty($results))
			echo json_encode($results);
	} else {
		echo esc_html('Security issues, try to reload this page.', 'cwssvgi');
	}
	die();
}

function cwssvgi_ajax_get_css_presets_css() {
	if ( wp_verify_nonce( $_REQUEST['nonce'], 'cwssvgi_ajax') ) {
		echo get_css_preset($_POST['name']);
	} else {
		echo esc_html('Security issues, try to reload this page.', 'cwssvgi');
	}
	die();
}

function get_css_preset($name) {
	global $wpdb;
	$cwssvgi_tname = $wpdb->prefix . 'cwssvgi';
	$results = $wpdb->get_results("SELECT atts FROM $cwssvgi_tname where name like '(css_preset)$name'", ARRAY_A);
	$out = '';
	if (!empty($results)) {
		$atts = maybe_unserialize($results[0]['atts']);
		$out = $atts['css'];
	}
	return  $out;
}

function cwssvgi_ajax_get_css_presets_names() {
	if ( wp_verify_nonce( $_REQUEST['nonce'], 'cwssvgi_ajax') ) {
		global $wpdb;
		$cwssvgi_tname = $wpdb->prefix . 'cwssvgi';

		$results = $wpdb->get_results("SELECT atts FROM $cwssvgi_tname where name like '(css_preset)%'", ARRAY_A);

		$out = '';
		foreach ($results as $key => $value) {
			$atts = maybe_unserialize($value['atts']);
			var_dump($key);
			$title = substr($atts['title'], 12);
			$out .= '<option value="'.$title.'">'.$title.'</option>';
		}
		echo $out;
	} else {
		echo esc_html('Security issues, try to reload this page.', 'cwssvgi');
	}
	die();
}

function cwssvgi_ajax_save_css_presets() {
	if ( wp_verify_nonce( $_REQUEST['nonce'], 'cwssvgi_ajax') ) {
		global $wpdb;
		$cwssvgi_tname = $wpdb->prefix . 'cwssvgi';

		$post_name = $_POST['name'];
		$name = '(css_preset)' . $post_name;
		$css = $_POST['css'];
		$ret = array();
		if (is_array($css)) {
			// we have several keyframes, $name - prefix
			foreach ($css as $key => $value) {
				$ret[$post_name . '-' . $key] = 'add';
				$item_name = $name . '-' . $key;
				$atts = maybe_serialize(array(
					'title' => $item_name,
					'css' => $value,
				));
				$wpdb->query("INSERT INTO $cwssvgi_tname(name, atts) VALUES('$item_name', '$atts') ON DUPLICATE KEY UPDATE name=VALUES(name), atts=VALUES(atts)");
			}
		} else if (!(empty($css))) {
			$ret[$post_name] = 'add';
			$atts = maybe_serialize(array(
				'title' => $name,
				'css' => $css,
			));

			$wpdb->query("INSERT INTO $cwssvgi_tname(name, atts) VALUES('$name', '$atts') ON DUPLICATE KEY UPDATE name=VALUES(name), atts=VALUES(atts)");
		} else {
			// delete
			$ret[$post_name] = 'del';
			$wpdb->query("DELETE FROM $cwssvgi_tname WHERE name='$name'");
		}
		echo json_encode($ret);
	} else {
		echo esc_html('Security issues, try to reload this page.', 'cwssvgi');
	}
	die();
}

function cwssvgi_ajax_get_animations() {
	if ( wp_verify_nonce( $_REQUEST['nonce'], 'cwssvgi_ajax') ) {
		global $wpdb;
		$cwssvgi_tname = $wpdb->prefix . 'cwssvgi';

		$results = $wpdb->get_results("SELECT atts FROM $cwssvgi_tname where name not like '(preset)%'", ARRAY_A);

		$upload_dir = wp_upload_dir();
		$this_folder = $upload_dir['basedir'] . '/cws-svgicons/';
		$out = '';
		if (count($results) > 0) {
			foreach ($results as $key => $value) {
				$atts = maybe_unserialize($value['atts']);
				$path = explode('/', $atts['svg']);
				$file = $path[1];
				$path = md5($path[0]) . '/';
				if (file_exists($this_folder . $path . $file)) {
					$out .= '<li><i class="svg" data-title="'.$atts['title'].'">'.file_get_contents($this_folder . $path . $file).'</i></li>';
				}
			}
		}
		echo $out;
	} else {
		echo esc_html('Security issues, try to reload this page.', 'cwssvgi');
	}
	die();
}

function cwssvgi_ajax_get_collection() {
	if ( wp_verify_nonce( $_REQUEST['nonce'], 'cwssvgi_ajax') ) {
		$collection = $_POST['collection'];
		$cwssvgi = get_option('cwssvgi');
		$upload_dir = wp_upload_dir();
		$this_folder = $upload_dir['basedir'] . '/cws-svgicons/' . md5($collection) . '/';
		$out = '';
		foreach ($cwssvgi[$collection] as $key) {
			if (file_exists($this_folder . $key)) {
				$out .= '<li><i class="svg">'.file_get_contents($this_folder . $key).'</i></li>';
			}
		}
		echo $out;
	} else {
		echo esc_html('Security issues, try to reload this page.', 'cwssvgi');
	}
	die();
}

function cwssvgi_ajax_del_name() {
	if ( wp_verify_nonce( $_REQUEST['nonce'], 'cwssvgi_ajax') ) {
		global $wpdb;

		$cwssvgi_tname = $wpdb->prefix . 'cwssvgi';
		$name = $_POST['name'];
		$wpdb->query("DELETE FROM $cwssvgi_tname WHERE name='$name'");
	}
	die;
}

function cwssvgi_ajax_del_col() {
	if ( wp_verify_nonce( $_REQUEST['nonce'], 'cwssvgi_ajax') ) {
		global $wpdb;

		// first remove all associated animations from our table
		$cwssvgi_tname = $wpdb->prefix . 'cwssvgi';
		$collection = $_POST['collection'];
		$wpdb->query("DELETE FROM $cwssvgi_tname WHERE atts like '%$collection/%.svg%'");

		$upload_dir = wp_upload_dir();
		$svg_folder = $upload_dir['basedir'] . '/cws-svgicons/' . md5($collection) . '/';

		// now we need to clean up the options
		$cwssvgi_op = get_option('cwssvgi');
		unset($cwssvgi_op[$collection]);
		update_option('cwssvgi', $cwssvgi_op);

		// delete all files and folder
		array_map('unlink', glob("$svg_folder/*.*"));
		rmdir($svg_folder);
	}
	die;
}

function cwssvgi_ajax_update_template() {
	if ( wp_verify_nonce( $_REQUEST['nonce'], 'cwssvgi_ajax') ) {
		global $wpdb;

		$cwssvgi_tname = $wpdb->prefix . 'cwssvgi';

		$name = $_POST['name'];
		$atts = maybe_serialize($_POST['atts']);

		if (!isset($_POST['atts']['collection'])) {
			$wpdb->query("INSERT INTO $cwssvgi_tname(name, atts) VALUES('$name', '$atts') ON DUPLICATE KEY UPDATE name=VALUES(name), atts=VALUES(atts)");
		} else {
			$to_save = $_POST['atts'];
			$collection = $to_save['collection'];
			$prefix = $to_save['title'];
			$items = explode(',', $to_save['items']);
			unset($to_save['collection']);
			unset($to_save['items']);
			foreach ($items as $item) {
				$to_save['svg'] = $collection . '/' . $item;
				$name = $prefix . '-' . substr($item,0,-4); // remove svg extension
				$to_save['title'] = $name; // remove svg extension
				$to_save['nids'] = ''; // means all
				$atts = maybe_serialize($to_save);
				$wpdb->query("INSERT INTO $cwssvgi_tname(name, atts) VALUES('$name', '$atts') ON DUPLICATE KEY UPDATE name=VALUES(name), atts=VALUES(atts)");
			}
		}
	} else {
		echo esc_html('Security issues, try to reload this page.', 'cwssvgi');
	}
	die();
}

function getSvgParams($name) {
	global $wpdb;
	$cwssvgi_tname = $wpdb->prefix . 'cwssvgi';
	$results = $wpdb->get_results("SELECT atts FROM $cwssvgi_tname WHERE name='$name' LIMIT 1", ARRAY_A);
	if (isset($results[0]['atts'])) {
		return maybe_unserialize($results[0]['atts']);
	} else {
		return null;
	}
}

function cwssvg_shortcode($atts) {
	extract( shortcode_atts( array(
		'width' => '64',
		'height' => '64',
		'collection' => '',
		'name' => '',
	), $atts));
	$upload_dir = wp_upload_dir();
	$svg_path = $upload_dir['basedir'] . '/cws-svgicons/' . md5($collection) . '/' . $name;
	$style = ' style="width:' . $width . 'px;height:' . $height . 'px"';
	if (file_exists($svg_path)) {
		return '<i'.$style.' class="svg">'.file_get_contents($svg_path).'</i>';
	} else {
		return '';
	}
}

function cwssvgi_shortcode($atts) {
	extract( shortcode_atts( array(
		'width' => '120',
		'height' => '120',
		'title' => '',
	), $atts));
	if (!empty($title)) {
		$results = getSvgParams($title);
		if (!empty($results)) {
			$path = explode('/', $results['svg']);
			$upload_dir = wp_upload_dir();
			$svg_path = $upload_dir['basedir'] . '/cws-svgicons/' . md5($path[0]) . '/' . $path[1];
			$out = '';
			if (file_exists($svg_path)) {

				$id = uniqid('cwssvgi_') . '_' . time();

				$transform = '';
				$opacity = '';

				if (!isset($results['css_preset'])) {
					if ($results['rotate-0'] !== '0') {	$transform .= ' rotate(' . $results['rotate-0'] . 'deg)'; }
					if ($results['scale-0'] !== '100') {	$transform .= ' scale(' . ($results['scale-0'])/100 . ')'; }

					$t_left = null;
					if (!empty($results['translate-left0'])) {	$t_left = $results['translate-left0']  .  'px'; }
					$t_top = null;
					if (!empty($results['translate-top0'])) {	$t_top = $results['translate-top0']  .  'px'; }

					if ($t_top || $t_left) { $transform  .= ' translate(' . ($t_left ? $t_left:'0px') . ', ' . ($t_top ? $t_top:'0px') . ')'; }

					$transform = trim($transform);
					$opacity0 = '';
					if ($results['opacity-0'] !== '100' && ($results['opacity-0']) < 100) {	$opacity0 = " opacity:" . ($results['opacity-0'])/100 . ";\n"; }

					$out_0 = "0% { " . $opacity0 . " transform: " . $transform . ";-webkit-animation-play-state:paused;}\n";

					$transform0 = 'transform: ' . $transform . ';';
					$transform = '';
					$opacity = '';

					if ($results['rotate-1'] !== '0') {	$transform .= ' rotate(' . $results['rotate-1'] . 'deg)'; }
					if (!empty($results['scale-1'])) {	$transform .= ' scale(' . ($results['scale-1'])/100 . ')'; }

					$t_left = null;
					if (!empty($results['translate-left1'])) {	$t_left = $results['translate-left1']  .  'px'; }
					$t_top = null;
					if (!empty($results['translate-top1'])) {	$t_top = $results['translate-top1']  .  'px'; }

					if ($t_top || $t_left) { $transform .= ' translate(' . ($t_left ? $t_left:'0px') . ', ' . ($t_top ? $t_top:'0px') . ')'; }

					$transform = trim($transform);
					$opacity = '';
					if ($results['opacity-1'] !== '100' && ($results['opacity-1']) < 100) {	$opacity = " opacity:" . ($results['opacity-1'])/100 . ";\r\n"; }

					$out_100 = "100% { " . $opacity . " transform: " . $transform . "; }\r\n";
				} else {
					$css_keyframe = get_css_preset($results['css_preset']);
					preg_match('/@keyframes\s+(\w+)\s+/', $css_keyframe, $matches);
					$key_name = $matches[1] . '_' . $id;
					$css_keyframe = preg_replace('/(@keyframes\s+)(\w+)(\s+)/', "$1" . $key_name . "$3" , $css_keyframe);
					$results['nids'] = ''; // empty it for now
				}

				$out .= '<style type="text/css" id="'.$id.'-s">';
				switch ($results['trigger']) {
					case 'hover':
					case 'hover-rev':
						$out .= printSelectors($results['nids'], $id, ':hover');
						break;
					case 'scroll':
						$out .= printSelectors($results['nids'], $id, '.cwssvgi_animate');
						break;
					case 'onload':
						$out .= printSelectors($results['nids'], $id, '');
						break;
				}
				$out .= "{\r\n";
				//if ('hover' !== $results['trigger']) {
					$repeat = '-1' === $results['repeat'] ? 'infinite' : $results['repeat'];
					$fill_mode = ('hover-rev' === $results['trigger']) ? 'forwards' : 'alternate';
					if (!isset($results['css_preset'])) {
						$out .= sprintf("animation: aniFrames_%s %ss %s %s;\r\n", $id, $results['duration'], $results['timing_func'], $fill_mode);
						$transform_origin = sprintf("transform-origin: %s", str_replace(',', ' ', $results['transform-origin']) );
						$out .= sprintf("transform-origin: %s;\r\n}\r\n", str_replace(',', ' ', $results['transform-origin']) );
						$out .= sprintf("@keyframes aniFrames_%s{\r\n", $id);
						$out .= $out_0;
						$out .= $out_100;
						$out .= "}\r\n";
					} else {
						$out .= sprintf("animation-name: %s;\r\n", $key_name);
						$out .= sprintf("animation-duration: %ss;\r\n", $results['duration']);
						$out .= sprintf("animation-repeat: %s;\r\n", $repeat);
						$out .= sprintf("animation-fill-mode: %s;\r\n", $fill_mode);
						$out .= "}\r\n";
						$out .= $css_keyframe;
						$out .= "\r\n";
					}

				if ('hover-rev' === $results['trigger']) {
					$out .= printSelectors($results['nids'], $id, '', '.out');
					if (!isset($results['css_preset'])) {
						$out .= sprintf("{animation: aniFrames_%s %ss %s reverse;}\r\n", $id, $results['duration'], $results['timing_func']);
						$out .= printSelectors($results['nids'], $id);
						$out .= '{';
						$out .= $transform0;
						$out .= $opacity0;
						$out .= $transform_origin;
						$out .= "}\r\n";
					} else{
						$out .= sprintf("{animation-name: %s;\r\n", $key_name);
						$out .= sprintf("animation-duration: %ss;\r\n", $results['duration']);
						$out .= sprintf("animation-repeat: %s;\r\n", $repeat);
						$out .= "animation-fill-mode: reverse;\r\n";
						$out .= "}\r\n";
					}
				}

				$out .= '</style>';

				$style = ' style="width:' . $width . 'px;height:' . $height . 'px"';

				$out .= '<i id="'.$id.'"'.$style.' class="svg" data-atype="'.$results['trigger'].'">'.file_get_contents($svg_path).'</i>';
			}
			return $out;
		}
	}
}

function printSelectors($nids_s, $id, $add = '', $class = '') {
	$i = 0;
	if (!empty($nids_s)) {
		$nids = explode(',', $nids_s);
		$i = count($nids);
	}
	$out = '';
	if (1 === $i && empty($nids[0])) {
		$out = 'i'.$class.'#' . $id . $add . ' *[class^="cwssvgi_"]';
	} else if (!$i) {
		$out = 'i'.$class.'#' . $id . $add . ' svg';
	} else {
		foreach ($nids as $k => $v) {
			$i--;
			$out .= 'i'.$class.'#' . $id . $add . ' *[class="cwssvgi_'.$v.'"]';
			$out .= $i ? ',' : '';
		}
	}
	return $out;
}

add_shortcode( 'cwssvgi', 'cwssvgi_shortcode');
add_shortcode( 'cwssvg', 'cwssvg_shortcode');

add_filter( 'mce_buttons', 'cwssvgi_mce_buttons', 110 );
add_filter( 'mce_external_plugins', 'cwssvgi_mce_plugin' );
add_filter( 'tiny_mce_before_init', 'cwssvgi_tmce_before_init', 10);

function cwssvgi_tmce_before_init($settings){
	global $wpdb;
	$cwssvgi_tname = $wpdb->prefix . 'cwssvgi';
	$results = $wpdb->get_results("SELECT name FROM $cwssvgi_tname where name not like '(preset)%'", ARRAY_A);
	$out = '';
	if (count($results) > 0) {
		$names = '[';
		foreach ($results as $key => $value) {
			$names .= '{text:"'.$value['name'].'", value:"'.$value['name'].'"},';
		}
		$names .= ']';
		$settings['cwssvgi_names'] = $names;
	}
	return $settings;
}

function cwssvgi_mce_buttons($b) {
	array_push($b, 'cwssvgi_icon');
	return $b;
}

function cwssvgi_mce_plugin($pa) {
	$pa['cwssvgi_sc'] = CWS_SVGI_PLUGIN_URL . '/cwssvgi_tmce.js';
	return $pa;
}

add_action( 'admin_footer', 'cwssvgi_print_templates' );

function cwssvgi_print_templates() {
	$cwssvgi = get_option('cwssvgi');
	$out = '';
	if (!empty($cwssvgi)) {
		$out .= '<script>window.cwssvgi_nonce = "'. wp_create_nonce('cwssvgi_ajax').'";';
		$out .= 'window.cwssvgi = {collections:{';
		$i = 0;
		foreach ($cwssvgi as $collection => $icons) {
			$out .= ($i === 0) ? '' : ',';
			$out .= '"'.$collection . '":""';
			$i++;
		}
		$out .= '}};';
		$out .= '</script>';
	}
	echo $out;
}

/* update */
add_filter( 'pre_set_site_transient_update_plugins', 'cwssvgi_check_for_update' );
set_transient('update_plugins', 24);

function cwssvgi_check_for_update($transient) {
	if (empty($transient->checked)) { return $transient; }
	$plugin_path = CWS_SVGI_PLUGIN_NAME . '/' . CWS_SVGI_PLUGIN_NAME . '.php';

	$result = wp_remote_get(CWSSVGI_HOST . '/cws-update.php');
	if ( isset($result->errors) ) {
		return $transient;
	} else {
		if (200 == $result['response']['code']) {
			$resp = json_decode($result['body']);
			if ( version_compare( CWSSVGI_VERSION, $resp->new_version, '<' ) ) {
				$transient->response[$plugin_path] = $resp;
			}
		}
	}
	return $transient;
}

function cwssvgi_plugins_api($res, $action = null, $args = null) {
	if ( ($action == 'plugin_information') && isset($args->slug) && ($args->slug == CWS_SVGI_PLUGIN_NAME) ) {
		$result = wp_remote_get(CWSSVGI_HOST . '/cws-update.php?info=1');
		if (200 == $result['response']['code']) {
			$res = json_decode($result['body'], true);
			$res = (object) array_map(__FUNCTION__, $res);
		}
	}
	return $res;
}

add_filter('plugins_api', 'cwssvgi_plugins_api', 20, 3);

?>
