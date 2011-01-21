<?php
// Uses values set in media.php config file
function audio()
{
    $CI =& get_instance();    
    return base_url().'media/'.$CI->config->item('audio_path');
}

function images()
{
    $CI =& get_instance();    
    return base_url().'media/'.$CI->config->item('images_path');
}

function files()
{
    $CI =& get_instance();    
    return base_url().'media/'.$CI->config->item('files_path');
}