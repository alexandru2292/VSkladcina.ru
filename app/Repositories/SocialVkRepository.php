<?php
/**
 * Created by PhpStorm.
 * User: alexandru2292
 * Date: 1/3/19
 * Time: 11:15 PM
 */

namespace App\Repositories;
use DB;
use App\User;
use Request;
use App\Role_user;
use Auth;

class SocialVkRepository
{
    /**
     * @param $auth - The object of \ATehnix\VkClient\Auth Class
     * @return New registered User OR login in system
     */
    public function registerNewUserIFNotExistAndLoginIn($auth){
        if (Request::exists('code')) {

            $userData = $auth->getUserData(Request::get('code'));
            $token = $userData['access_token'];
            $userId = $userData['user_id'];
            $userEmail = isset($userData['email']) ? $userData['email'] : '';
            /**
             * In "fields" we indicate the properties of the user that we need to obtain
             */
            $dataUser = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_id=".$userId."&access_token=".$token."&fields=uid,email,photo_id,photo_max,verified,sex,bdate,city,country,home_town,has_photo&v=5.52"),true);
            $dataUser = $dataUser['response'][0];
            $dataUser['email'] = $userEmail;

            /**
             * Register new user if not exist
             */
            if(!User::find($dataUser['id'])){

                $newPass = $dataUser['first_name'].'.'.$dataUser['last_name'].'.ruso';
                User::create([
                    'id' => $dataUser['id'],
                    'name' => isset($dataUser['first_name']) || isset($dataUser['last_name']) ? $dataUser['first_name'].' '.$dataUser['last_name'] : '',
                    'email' => isset($dataUser['email']) ? $dataUser['email'] : '',
                    'avatar' => isset($dataUser['photo_max']) ? $dataUser['photo_max']."&link=1" : '',
                    'bdate' => isset($dataUser['bdate']) ? $dataUser['bdate'] : '',
                    'city' => isset($dataUser['city']['title']) ? $dataUser['city']['title'] : '',
                    'country' => isset($dataUser['country']['title']) ? $dataUser['country']['title'] : '',
                    'password' => bcrypt($newPass)
                ]);
                $role_user = new Role_user();
                $role_user->user_id = $dataUser['id'];
                $role_user->role_id = 3;
                $role_user->save();
                /**
                 * after registration follows(urmeaza) logging in system
                 */
                if (Auth::attempt(['id' => $dataUser['id'], 'password' => $newPass])) {
                    return redirect('/profile');
                }
            }else{
                /**
                 * If User exist - login in
                 */
                $newPass = $dataUser['first_name'].'.'.$dataUser['last_name'].'.ruso';

                if (Auth::attempt(['id' => $dataUser['id'], 'password' => $newPass])) {
                    return redirect('/profile');
                }else{
                    return redirect('/');
                }
            }
        }
    }
    /**
     *  get client ID from API URL
     */
    public function getClientIdFromVkApi($auth){
        $parts = parse_url($auth->getUrl());
        parse_str($parts['query'], $parts);
        $client_id = $parts['client_id'];
        return $client_id;
    }

}

