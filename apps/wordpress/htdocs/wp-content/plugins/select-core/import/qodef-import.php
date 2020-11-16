<?php
if (!function_exists ('add_action')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

class QodefCoreImport {
	/**
	 * @var instance of current class
	 */
	private static $instance;

	/**
	 * Name of folder where revolution slider will stored
	 * @var string
	 */
	private $revSliderFolder;
	
	/**
	 *
	 * URL where are import files
	 * @var string
	 */
	private $importURI;
	
	/**
	 * @return QodefCoreImport
	 */
	public static function getInstance() {
		if(self::$instance === null) {
			return new self();
		}

		return self::$instance;
	}

    public $message = "";
    public $attachments = false;
    function __construct() {
		$this->revSliderFolder 	= 'qodef-rev-sliders';
		$this->importURI		= 'http://export.select-themes.com/';

        add_action('admin_menu', array(&$this, 'qodef_admin_import'));
        add_action('admin_init', array(&$this, 'qodef_register_theme_settings'));
    }
    
    function qodef_register_theme_settings() {
        register_setting( 'qodef_options_import_page', 'qodef_options_import');
    }
	
    public function import_content($file){
		ob_start();
		require_once(QODE_CORE_ABS_PATH . '/import/class.wordpress-importer.php');
		$qodef_import = new WP_Import();
		set_time_limit(0);

		$qodef_import->fetch_attachments = $this->attachments;
		$returned_value = $qodef_import->import($file);
		if(is_wp_error($returned_value)){
			$this->message = esc_html__('An Error Occurred During Import', 'select-core');
		}
		else {
			$this->message = esc_html__('Content imported successfully', 'select-core');
		}
		ob_get_clean();
    }

    public function import_widgets($file, $file2){
        $this->import_custom_sidebars($file2);
        $options = $this->file_options($file);
        foreach ((array) $options['widgets'] as $qodef_widget_id => $qodef_widget_data) {
            update_option( 'widget_' . $qodef_widget_id, $qodef_widget_data );
        }
        $this->import_sidebars_widgets($file);
        $this->message = esc_html__('Widgets imported successfully', 'select-core');
    }

    public function import_sidebars_widgets($file){
        $qodef_sidebars = get_option("sidebars_widgets");
        unset($qodef_sidebars['array_version']);
        $data = $this->file_options($file);
        if ( is_array($data['sidebars']) ) {
            $qodef_sidebars = array_merge( (array) $qodef_sidebars, (array) $data['sidebars'] );
            unset($qodef_sidebars['wp_inactive_widgets']);
            $qodef_sidebars = array_merge(array('wp_inactive_widgets' => array()), $qodef_sidebars);
            $qodef_sidebars['array_version'] = 2;
            wp_set_sidebars_widgets($qodef_sidebars);
        }
    }

    public function import_custom_sidebars($file){
        $options = $this->file_options($file);
        update_option( 'qodef_sidebars', $options);
        $this->message = esc_html__('Custom sidebars imported successfully', 'select-core');
    }

    public function import_options($file){
        $options = $this->file_options($file);
        $result = update_option( 'qodef_options_bazaar', $options);
        $this->message = esc_html__('Options imported successfully', 'select-core');
    }

    public function import_menus($file){
        global $wpdb;
        $qodef_terms_table = $wpdb->prefix . "terms";
        $this->menus_data = $this->file_options($file);
        $menu_array = array();
        foreach ($this->menus_data as $registered_menu => $menu_slug) {
            $term_rows = $wpdb->get_results($wpdb->prepare("SELECT * FROM $qodef_terms_table where slug=%s", $menu_slug), ARRAY_A);
            if(isset($term_rows[0]['term_id'])) {
                $term_id_by_slug = $term_rows[0]['term_id'];
            } else {
                $term_id_by_slug = null;
            }
            $menu_array[$registered_menu] = $term_id_by_slug;
        }
        set_theme_mod('nav_menu_locations', array_map('absint', $menu_array ) );
    }
    
    public function import_settings_pages($file){
        $pages = $this->file_options($file);
        foreach($pages as $qodef_page_option => $qodef_page_id){
            update_option( $qodef_page_option, $qodef_page_id);
        }
    }
	
	public function rev_sliders() {
		$rev_sldiers = array(
			'asymmetric-shop.zip',
			'classic-shop.zip',
			'grid-home.zip',
			'landing-bottom.zip',
			'landing-top.zip',
			'main-home.zip',
			'modern-shop.zip',
			'product-showcase.zip',
		);

		return $rev_sldiers;
	}

	public function create_rev_slider_files($folder) {
		$rev_list = $this->rev_sliders();
		$dir_name = $this->revSliderFolder;

		$upload		= wp_upload_dir();
		$upload_dir = $upload['basedir'];
		$upload_dir = $upload_dir . '/' . $dir_name;
		if (!is_dir($upload_dir)) {
			mkdir($upload_dir, 0700);
			mkdir($upload_dir . '/' . $folder, 0700);
		}

		foreach ($rev_list as $rev_slider) {
			file_put_contents(WP_CONTENT_DIR . '/uploads/' . $dir_name . '/'. $folder . '/' . $rev_slider, file_get_contents($this->importURI .'/' . $folder . '/revslider/' . $rev_slider));
		}
	}

	public function rev_slider_import($folder){
		$this->create_rev_slider_files($folder);

		$rev_sliders = $this->rev_sliders();
		$dir_name = $this->revSliderFolder;
		$absolute_path = __FILE__;
		$path_to_file = explode( 'wp-content', $absolute_path );
		$path_to_wp = $path_to_file[0];

		require_once( $path_to_wp.'/wp-load.php' );
		require_once( $path_to_wp.'/wp-includes/functions.php');
		require_once( $path_to_wp.'/wp-admin/includes/file.php');

		$rev_slider_instance = new RevSlider();

		foreach ($rev_sliders as $rev_slider) {
			$nf = WP_CONTENT_DIR . '/uploads/' . $dir_name . '/' . $folder . '/' . $rev_slider;
			$rev_slider_instance->importSliderFromPost(true, true, $nf);
		}
	}

    public function file_options($file){
        $file_content = $this->qodef_file_contents($file);
        
        if ($file_content) {
            $unserialized_content = unserialize(base64_decode($file_content));
            if ($unserialized_content) {
                return $unserialized_content;
            }
        }
        
        return false;
    }

    function qodef_file_contents( $path ) {
		$url      = $this->importURI . $path;
		$response = wp_remote_get($url);
		$body     = wp_remote_retrieve_body($response);
		return $body;
    }

    function qodef_admin_import() {
        if (qodef_core_theme_installed()) {
            global $bazaar_qodef_Framework;

            $slug = "_tabimport";
            $this->pagehook = add_submenu_page(
                'bazaar_qodef_theme_menu',
	            esc_html__( 'Select Options - Qode Import', 'select-core' ),    // The value used to populate the browser's title bar when the menu page is active
				esc_html__( 'Import', 'select-core' ),        // The text of the menu in the administrator's sidebar
                'administrator',                  // What roles are able to access the menu
                'bazaar_qodef_theme_menu'.$slug,                // The ID used to bind submenu items to this menu
                array($bazaar_qodef_Framework->getSkin(), 'renderImport')
            );

            add_action('admin_print_scripts-'.$this->pagehook, 'bazaar_qodef_enqueue_admin_scripts');
            add_action('admin_print_styles-'.$this->pagehook, 'bazaar_qodef_enqueue_admin_styles');
        }
    }

	function qodef_update_meta_fields_after_import( $folder ) {
		global $wpdb;

		$url       = esc_url( home_url( '/' ) );
		$demo_urls = $this->qodef_import_get_demo_urls( $folder );

		foreach ( $demo_urls as $demo_url ) {
			$sql_query   = "SELECT meta_id, meta_value FROM {$wpdb->postmeta} WHERE meta_key LIKE 'qode%' AND meta_value LIKE '" . esc_url( $demo_url ) . "%';";
			$meta_values = $wpdb->get_results( $sql_query );

			if ( ! empty( $meta_values ) ) {
				foreach ( $meta_values as $meta_value ) {
					$new_value = $this->qodef_recalc_serialized_lengths( str_replace( $demo_url, $url, $meta_value->meta_value ) );

					$wpdb->update( $wpdb->postmeta,	array( 'meta_value' => $new_value ), array( 'meta_id' => $meta_value->meta_id )	);
				}
			}
		}
	}

	function qodef_update_options_after_import( $folder ) {
		$url       = esc_url( home_url( '/' ) );
		$demo_urls = $this->qodef_import_get_demo_urls( $folder );

		foreach ( $demo_urls as $demo_url ) {
			$global_options    = get_option( 'qodef_options_bazaar' );
			$new_global_values = str_replace( $demo_url, $url, $global_options );

			update_option( 'qodef_options_bazaar', $new_global_values );
		}
	}

	function qodef_import_get_demo_urls( $folder ) {
		$demo_urls  = array();
		$domain_url = defined( 'QODE_PROFILE_SLUG' ) ? str_replace( '/', '', $folder ) . '.' . QODE_PROFILE_SLUG . '-themes.com/' : '';

		$demo_urls[] = ! empty( $domain_url ) ? 'http://' . $domain_url : '';
		$demo_urls[] = ! empty( $domain_url ) ? 'https://' . $domain_url : '';

		return $demo_urls;
	}

	function qodef_recalc_serialized_lengths( $sObject ) {
		$ret = preg_replace_callback( '!s:(\d+):"(.*?)";!', 'qodef_recalc_serialized_lengths_callback', $sObject );

		return $ret;
	}

	function qodef_recalc_serialized_lengths_callback( $matches ) {
		return "s:" . strlen( $matches[2] ) . ":\"$matches[2]\";";
	}
}