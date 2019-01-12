<?php

namespace App\Http\Controllers;

use ATehnix\LaravelVkRequester\Contracts\Subscriber;
use ATehnix\LaravelVkRequester\Models\VkRequest;

use Request;
use ATehnix\VkClient\Client;
class SocialAuthVkController extends Controller
{
    public function login(\ATehnix\VkClient\Auth $auth)
    {
        return redirect($auth->getUrl());
    }
    public function redirect(\ATehnix\VkClient\Auth $auth){

        if (Request::exists('code')) {

            $userData = $auth->getUserData(Request::get('code'));
            $token = $userData['access_token'];
            $userId = $userData['user_id'];

            $dataUser = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_id=".$userId."&access_token=".$token."&fields=uid,photo_id,photo_max,verified,sex,bdate,city,country,home_town,has_photo,photo_50,photo_100,music&v=5.52"),true);
            dd($dataUser);

        }
    }

}
