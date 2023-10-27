<?php
namespace App\Helpers;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Illuminate\Support\Facades\Log;

class MainHelper {

    protected $default_sel = array('0' => 'Select');
    public static $per_page_limit = [10, 25, 50, 100];

    public static function prettyJson($inputArray, $statusCode) {
        return response()->json($inputArray, $statusCode, array('Content-Type' => 'application/json'), JSON_PRETTY_PRINT);
    }

    public static function validateResult($data) {
        //return count($data);
        // 20220321 Mayank Gupta handled php8.0 typeError when passing invalid countable types
        // https://www.php.net/manual/en/function.count.php
        return is_countable($data) ? $data : null;
    }

    public static function imageFilePath() {
        $img_path = public_path('assets/images/') . date('Y') . '/' . date('m') . '/' . date('d') . '/';
        if (!is_dir($img_path)) {
            mkdir($img_path, 0777, true);
        }
        return $img_path;
    }


  

    public static function getImageFilePath($data, $small = true) {
        $img_path = public_path('assets/images/') . $data->src;
        if ($small === true && is_array($data->image_size)) {
            sort($data->image_size);
            $url = explode('.', $img_path);
            $img_path = $url[0] . '_' . $data->image_size[0] . '.' . $url[1];
        }

        return $img_path;
    }



    public static function uploadFileToCentralStorage( $file_path, $dir = null ,$hostname = null,$form_name = '')
    {
        if( empty( config('env.CENTRAL_UPLOAD_API') ) ) {
            Log::info( PHP_EOL.'CENTRAL_UPLOAD_API not set in env '.PHP_EOL );
            return;
        }

        if( !file_exists( $file_path ) ) {
            Log::info( PHP_EOL.'File does not Exists => '.$file_path.PHP_EOL );
            return;
        }

        Log::info( PHP_EOL.'File upload called Central => '.$file_path.PHP_EOL );

        $file       = fopen($file_path, "rb");  
        $url        = config('env.CENTRAL_UPLOAD_API').'/upload';
        $name_array = explode( "/", $file_path );
        $name       = end( $name_array ) ;
        $headers = [
            'name:'     . $name,
            'hostname:' . $hostname,
            'secret:'   . config('env.SECRET_FOR_UPLOAD_API')
        ];

        if( !empty($dir) ) {
            $headers[] = 'directory:'. $dir ;
        }

        if( !empty($form_name) ) {
            $headers[] = 'base-directory:'. $form_name ;
        }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 2);
        //curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_URL, $url);

        curl_setopt($curl, CURLOPT_PUT, 1);
        curl_setopt($curl, CURLOPT_INFILE, $file);
        curl_setopt($curl, CURLOPT_INFILESIZE, filesize($file_path));

        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }

}
