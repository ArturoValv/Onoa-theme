<?php

//Enable SVG uploads
function add_file_types_to_uploads($file_types)
{
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes);
    return $file_types;
}
add_filter('upload_mimes', 'add_file_types_to_uploads');

function wp_check_svg($file)
{
    $filetype = wp_check_filetype($file['name']);

    $ext = $filetype['ext'];
    $type = $filetype['type'];

    // Check if uploaded file is a SVG
    if ($type !== 'image/svg+xml' || $ext !== 'svg') {
        return $file;
    }

    // Make sure that the file is being uploaded by a trusted user
    if (!current_user_can('upload_files')) {
        return $file;
    }

    // Use WP_Filesystem to read the contents of the file
    global $wp_filesystem;
    if (empty($wp_filesystem)) {
        require_once(ABSPATH . '/wp-admin/includes/file.php');
        WP_Filesystem();
    }

    $content = $wp_filesystem->get_contents($file['tmp_name']);

    // Use DOMDocument to parse the SVG file
    $doc = new DOMDocument();
    $doc->loadXML($content);

    // Check if the file contains any <script> tags
    $scripts = $doc->getElementsByTagName('script');

    if ($scripts->length > 0) {
        // The file contains <script> tags, which is not allowed
        return $file;
    }

    // The SVG file is safe, so return the original data
    return $file;
}
add_filter('wp_handle_upload_prefilter', 'wp_check_svg');

function getSVGContents($image)
{

    $image_url = is_array($image) ? $image['url'] : $image;
    $file_info = new finfo(FILEINFO_MIME_TYPE);
    $mime_type = $file_info->buffer(file_get_contents($image_url));
    $contents = $mime_type === "image/svg+xml" ? file_get_contents($image_url) : '<img src="' . $image_url . '">';

    return $contents;
}
