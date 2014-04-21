<?php

/**
 * @package Adem
 * @since v0.2
 * @version 1
 * @author Fares AlBelady
 */
class AD_Upload {
    
    private $file;
    
    public $details = array();
    
    public $Folder;
    
    public $FilePath;
    
    public $maxSize;

    public $mineSize;
    
    public $mimType = array();

    public $currectError = 0;
    
    private $Errors = array(
        0 => "There is no error.",
        1 => "The uploaded file exceeds the upload_max_filesize directive in php.ini",
        2 => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
        3 => "The uploaded file was only partially uploaded",
        4 => "No file was uploaded",
        6 => "Missing a temporary folder",
        7 => "Failed to write file to disk",
        8 => "A PHP extension stopped the file upload.",
        // Object error
        100 => 'أرجو اختيار ملف .',
        101 => 'Filename Characters bigger than 225.',
        102 => 'File size is too big and is not allowed.',
        103 => 'File extension not allowed to upload.',
        104 => 'File Mime type not allowed to upload.',
        105 => 'The Server canceled this action for security reasons.'
    );
    
    
}