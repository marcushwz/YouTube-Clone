<?php

class formSanitizer {

    // with static dont need to create an instance of the class before using it
    public static function sanitizeFormString($inputText) {
        $inputText = strip_tags($inputText);
        $inputText = trim($inputText);
        $inputText = strtolower($inputText);
        $inputText = ucwords($inputText);
        return $inputText;
    }

    public static function sanitizeFormUsername($inputText) {
        $inputText = strip_tags($inputText);
        $inputText = trim($inputText);
        $inputText = str_replace(" ", "", $inputText);
        return $inputText;
    }

    public static function sanitizeFormPassword($inputText) {
        $inputText = strip_tags($inputText);
        return $inputText;
    }

    public static function sanitizeFormEmail($inputText) {
        $inputText = strip_tags($inputText);
        $inputText = trim($inputText);
        $inputText = str_replace(" ", "", $inputText);
        return $inputText;
    }
}

?>
