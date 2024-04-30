<?php

class View
{
    public static function load($viewName,$veiwData=[])
    {
//        echo 'test';
        $file= VIEWS.$viewName.'.php';
        echo $file;
        if (file_exists($file)) {
            extract($veiwData);
            ob_start();
            require($file);
            ob_end_flush();
        }else{
            echo 'This view '.$viewName. ' not found';
        }

    }


}