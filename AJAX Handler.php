<?php

function ajax_filter_products() {

    $categories = $_POST['categories'];
    $sizes = $_POST['sizes'];

    $tax_query = [];

    // Category filter
    if ($categories !== 'all') {
        $tax_query[] = [
            'taxonomy' => 'product_cat',
            'field'    => 'term_id',
            'terms'    => $categories
        ];
    }

    // Size filter
    if (!empty($sizes)) {
        $tax_query[] = [
            'taxonomy' => 'pa_size',
            'field'    => 'term_id',
            'terms'    => $sizes
        ];
    }

    // Build final query
    $args = [
        'post_type' => 'product',
        'posts_per_page' => -1,
        'tax_query' => $tax_query
    ];

    $products = new WP_Query($args);

    if ($products->have_posts()) {
        while ($products->have_posts()) {
            $products->the_post();
            wc_get_template_part('content', 'product');
        }
        wp_reset_postdata();
    } else {
        echo "<p>No products found.</p>";
    }

    wp_die();
}

add_action('wp_ajax_filter_products', 'ajax_filter_products');
add_action('wp_ajax_nopriv_filter_products', 'ajax_filter_products');
