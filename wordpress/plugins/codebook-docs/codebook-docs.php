<?php
/*
* Version: 1.0
* Author: Narendra Maurya
* Plugin Name: Codebook Documentation
* Description: Plugin to explore the rest api's of the Codebook Plugin
*/

function codebook_docs_setup_menu(){
    add_menu_page(
        'Codebook Docs', 
        'Codebook Docs', 
        'manage_options', 
        'codebook-plugin', 
        'codebook_init'
    );
}

function my_enqueue($hook) {
    wp_enqueue_style(
        'bootstrap_css', 
        plugin_dir_url(__FILE__) . 'assets/css/bootstrap.min.css'
    );
    wp_enqueue_style(
        'custom_css', 
        plugin_dir_url(__FILE__) . 'assets/css/custom.css', 
        array('bootstrap_css'), 
        '', 
        true
    );
    wp_enqueue_script(
        'bootstrap_js', 
        plugin_dir_url(__FILE__) . 'assets/scripts/bootstrap.min.js'
    );
    wp_enqueue_script(
        'vue_main', 
        plugin_dir_url(__FILE__) . 'assets/scripts/vue.min.js', 
        array('bootstrap_js'), 
        '', 
        true
    );
    wp_enqueue_script(
        'axios_main', 
        plugin_dir_url(__FILE__) . 'assets/scripts/axios.min.js', 
        array('vue_main'), 
        '', 
        true
    );
    wp_enqueue_script(
        'my_custom_script_main', 
        plugin_dir_url(__FILE__) . 'assets/scripts/main.js', 
        array('axios_main', 'axios_main'), 
        'v-1.0', 
        true
    );
}

function codebook_init(){
    echo '<div id="app"></div>';
}

add_action(
    'admin_enqueue_scripts', 
    'my_enqueue'
);
add_action(
    'admin_menu', 
    'codebook_docs_setup_menu'
);
