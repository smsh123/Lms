<?php


namespace App\Helpers;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SiteHelper
{

    

    public static function getAllPickList()
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
            "userRoles"=> !empty($userRoles) ? $userRoles : [],
            "testimonialType" => !empty($testimonialType) ? $testimonialType : [],
            "faqType" => !empty($faqType) ? $faqType : [],
            "status" => !empty( $status) ?  $status : [],
            "storyStatus" => !empty($storyStatus) ? $storyStatus : [],
            "orderStatus" => !empty($orderStatus) ? $orderStatus : [],
            "transactionStatus" => !empty($transactionStatus) ? $transactionStatus : [],
            "subscriptionStatus" => !empty($subscriptionStatus) ? $subscriptionStatus : []
        ];

        return isset($data) && !empty($data) ? $data : []; 
    }

    public static function getMenuBySlug($slug = null)
    {
        $menus = Menu::getMenuBySlug($slug);
        return isset($menus) && !empty($menus) ? $menus : []; 
    }

    public static function generateRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
    
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
    
        return $randomString;
    }

    public static function checkUserLogingStatus()
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

    public static function getUserDetailsById($id = null)
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



}
