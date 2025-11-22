wp_enqueue_script('woo-filter-js', get_template_directory_uri() . "/assets/js/woo-filter.js", array('jquery'), '1.0', true);

     wp_localize_script('woo-filter-js', 'ajax_object', [
        'ajax_url' => admin_url('admin-ajax.php')
    ]);
