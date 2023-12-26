<?php

use App\Models\Menu;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

function getAllPickList()
{
    $userType = [
        [
            "label" => 'INTERNAL',
            "code" => 'INT'
        ],
        [
            "label" => 'EXTERNAL',
            "code" => 'EXT'
        ]
    ];
    $userRoles = [
        [
            "label" => 'OWNER',
            "code" => 'SUPERADMIN'
        ],
        [
            "label" => 'ADMINISTRATOR',
            "code" => 'ADMIN'
        ],
        [
            "label" => 'CRM USER',
            "code" => 'CUSER'
        ],
        [
            "label" => 'VISITOR',
            "code" => 'USER'
        ],
        [
            "label" => 'SUBSCRIBER',
            "code" => 'SUBS'
        ]
    ];
    $status = [
        [
            "label" => 'ACTIVE',
            "value" => true
        ],
        [
            "label" => 'DEACTIVE',
            "value" => false
        ]
    ];
    $storyStatus = [
        [
            "label" => 'PUBLISHED',
            "value" => "P"
        ],
        [
            "label" => 'DRAFT',
            "value" => "D"
        ],
        [
            "label" => 'UNPUBLISHED',
            "value" => "U"
        ]
    ];
    $orderStatus = [
        [
            "label" => 'CREATED',
            "value" => "C"
        ],
        [
            "label" => 'FAILED',
            "value" => "F"
        ],
        [
            "label" => 'SUCCESS',
            "value" => "S"
        ]
    ];
    $transactionStatus = [
        [
            "label" => 'FAILED',
            "value" => "F"
        ],
        [
            "label" => 'PAID',
            "value" => "P"
        ],
        [
            "label" => 'PARTIAL PAID',
            "value" => "PP"
        ]
    ];
    $subscriptionStatus = [
        [
            "label" => 'ACTIVE',
            "value" => "A"
        ],
        [
            "label" => 'EXPIRED',
            "value" => "E"
        ],
        [
            "label" => 'FLAGGED',
            "value" => "F"
        ]
    ];
    $faqType = [
        [
            "label" => "COURSE FAQ",
            "code" => "C"
        ],
        [
            "label" => "BLOG FAQ",
            "code" => "B"
        ],
        [
            "label" => "OFFER FAQ",
            "code" => "O"
        ],
        [
            "label" => "PAGE FAQ",
            "code" => "P"
        ]
    ];

    $testimonialType = [
        [
            "label" => "TEXT",
            "code" => "T"
        ],
        [
            "label" => "VIDEO",
            "code" => "V"
        ],
        [
            "label" => "TEXT & VIDEO",
            "code" => "TV"
        ],
        [
            "label" => "SUCCESS STORY TEXT",
            "code" => "ST"
        ],
        [
            "label" => "SUCCESS STORY VIDEO",
            "code" => "SV"
        ],
        [
            "label" => "SUCCESS STORY TEXT & VIDEO",
            "code" => "STV"
        ]
    ];

    $data = [
        "userType" => !empty($userType) ? $userType : [],
        "userRoles" => !empty($userRoles) ? $userRoles : [],
        "testimonialType" => !empty($testimonialType) ? $testimonialType : [],
        "faqType" => !empty($faqType) ? $faqType : [],
        "status" => !empty($status) ?  $status : [],
        "storyStatus" => !empty($storyStatus) ? $storyStatus : [],
        "orderStatus" => !empty($orderStatus) ? $orderStatus : [],
        "transactionStatus" => !empty($transactionStatus) ? $transactionStatus : [],
        "subscriptionStatus" => !empty($subscriptionStatus) ? $subscriptionStatus : []
    ];

    return isset($data) && !empty($data) ? $data : [];
}

function getMenuBySlug($slug = null)
{
    $menus = Menu::getMenuBySlug($slug);
    return isset($menus) && !empty($menus) ? $menus[0] : [];
}

function generateRandomString($length = 6)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}

// protected $default_sel = array('0' => 'Select');
// $per_page_limit = [10, 25, 50, 100];

function prettyJson($inputArray, $statusCode)
{
    return response()->json($inputArray, $statusCode, array('Content-Type' => 'application/json'), JSON_PRETTY_PRINT);
}

function validateResult($data)
{
    //return count($data);
    // 20220321 Mayank Gupta handled php8.0 typeError when passing invalid countable types
    // https://www.php.net/manual/en/function.count.php
    return is_countable($data) ? $data : null;
}

function imageFilePath()
{
    $img_path = public_path('assets/images/') . date('Y') . '/' . date('m') . '/' . date('d') . '/';
    if (!is_dir($img_path)) {
        mkdir($img_path, 0777, true);
    }
    return $img_path;
}




function getImageFilePath($data, $small = true)
{
    $img_path = public_path('assets/images/') . $data->src;
    if ($small === true && is_array($data->image_size)) {
        sort($data->image_size);
        $url = explode('.', $img_path);
        $img_path = $url[0] . '_' . $data->image_size[0] . '.' . $url[1];
    }

    return $img_path;
}



function uploadFileToCentralStorage($file_path, $dir = null, $hostname = null, $form_name = '')
{
    if (empty(config('env.CENTRAL_UPLOAD_API'))) {
        Log::info(PHP_EOL . 'CENTRAL_UPLOAD_API not set in env ' . PHP_EOL);
        return;
    }

    if (!file_exists($file_path)) {
        Log::info(PHP_EOL . 'File does not Exists => ' . $file_path . PHP_EOL);
        return;
    }

    Log::info(PHP_EOL . 'File upload called Central => ' . $file_path . PHP_EOL);

    $file       = fopen($file_path, "rb");
    $url        = config('env.CENTRAL_UPLOAD_API') . '/upload';
    $name_array = explode("/", $file_path);
    $name       = end($name_array);
    $headers = [
        'name:'     . $name,
        'hostname:' . $hostname,
        'secret:'   . config('env.SECRET_FOR_UPLOAD_API')
    ];

    if (!empty($dir)) {
        $headers[] = 'directory:' . $dir;
    }

    if (!empty($form_name)) {
        $headers[] = 'base-directory:' . $form_name;
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

function checkUserLogingStatus()
{
    $isUserLoggedin = false;
    $isUserLoggedin = \Auth::user(); 
    if($isUserLoggedin){
        $user_id = \Auth::user()->id;
    }

    $data = [
        'login_status' => $isUserLoggedin,
        'user_id' => !empty($user_id) ? $user_id : '' 
    ];

    return $data;
}

function getUserDetailsById($id = null)
{
    $isUserLoggedin = false;
    $isUserLoggedin = \Auth::user(); 
    if($isUserLoggedin && !empty($id) && $id != null){
        $usersDetails = User::find($id);
        if(!empty($usersDetails)){
            $usersDetails = is_object($usersDetails) ? $usersDetails->toArray() : $usersDetails; 
        }
    }

    return $usersDetails;
}
