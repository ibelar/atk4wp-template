<?php
/**
 * Enqueue Configuration
 *
 * Will add js or css file to Wordpress.
 *
 * $config['enqueue']['admin']['js']   => [ $files ]  (array)(Required) An array of js files to load at the admin section of WordPress.
 * $config['enqueue']['admin']['css']  => [ $files ]  (array)(Required) An array of css files to load at the admin section of WordPress.
 *
 * $config['enqueue']['front']['js']   => [ $files ]  (array)(Required) An array of js files to load at the front end section of WordPress.
 * $config['enqueue']['front']['css']  => [ $files ]  (array)(Required) An array of css files to load at the front end section of WordPress.
 *
 * $files is An array of javascript or css file path (without the extension) to load within WordPress.
 * File path value is relative to your plugin public/js or public/css directory.
 * Ex: test.js file is located under public/js/vendor/test.js then the path value should be 'vendor/test'
 * Ex: test.css file is located under public/css/test.css then the path value should be 'test'
 */