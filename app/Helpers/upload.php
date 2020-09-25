<?php
declare(strict_types=1);

/**
 *Function to upload file
 *@param Request
 *
 *@param Folder
 *
 *@return path of file
 *
 */

if(!function_exists("upload_image")){

    function  upload_image($request,  string $folder):string {

        $path = $request->file('image')->store('images/'.$folder, 'public');

        return $path;
    }
}
