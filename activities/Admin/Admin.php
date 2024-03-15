<?php

namespace Admin;

class Admin{

    protected $currentDomain;
    protected $basePath;

    function __construct()
    {
        $this->currentDomain = CURRENT_DOMAIN;
        $this->basePath = BASE_PATH;

    }

    // redirect by url
    protected function redirect($url){
        header('location:' . trim($this->currentDomain, '/ ') . '/' . trim($url, '/ '));
        exit();
    }

    // redirect back
    protected function redirectBack(){
        header('location:' . $_SERVER['HTTP_REFERER']);
        exit();
    }

    // Save image
    protected function saveImage($image, $imagePath, $imageName = null){
        if($imageName){
            $extension = explode('/', $image['type'][1]);
            $imageName = $imageName . '.' . $extension;
        }
        else{
            $extension = explode('/', $image['type'][1]);
            $imageName = date("Y-m-d-H-i-s"). '.' . $extension;
        }

        $imageTemp = $image['tmp_name'];
        $imagePath = '/public' . $imagePath . '/';

        if(is_uploaded_file($imageTemp)){
            if(move_uploaded_file($imageTemp, $imagePath . $imageName)){
                return $imagePath . $imageName;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }

    // Remove image
    protected function removeImage($path){
        $path = trim($this->basePath, '/ ') . '/' . trim($path, '/ ');
        if(file_exists($path)){
            unlik($path);
        }
    }


}
