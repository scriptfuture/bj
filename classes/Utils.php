<?php 

namespace classes;

class Utils {
    public static function error($text) {
        exit(
            json_encode(
                array("result" => "error", "error_text" => $text)
            )
        );
    }
    
    public static function ok() {
        return(
            json_encode(
                array("result" => "ok")
            )
        );
    }
    
    public static function text_to_html($text) {
        return str_replace(array("\r\n", "\r", "\n"), '<br>', $text);
    }
}