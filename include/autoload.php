<?php
function __autoload($class_name){
    $file='include/classes/'.$class_name.'.php';
    if(file_exists($file))
        require_once($file);
    else
        die ('File Not Found');
}

