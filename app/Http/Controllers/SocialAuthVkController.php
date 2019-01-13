<?php

namespace App\Http\Controllers;
use App\Repositories\SocialVkRepository;

class SocialAuthVkController extends Controller
{
    protected $vkRepository;
    public function __construct(SocialVkRepository $vkRepository)
    {
        $this->vkRepository = $vkRepository;
    }

    public function login(\ATehnix\VkClient\Auth $auth)
    {
        /**
         * this $URL makes connecting to the vkontakte API
         *
         * scope=offline,email  -  allows to receive the email address from the API
         */

        $client_id =  $this->vkRepository->getClientIdFromVkApi($auth);

        $URL = "https://oauth.vk.com/authorize?client_id=".$client_id."&scope=offline,email&redirect_uri=http://vskladcine.ru/vkredirect&response_type=code&display=page";
        return redirect($URL);
    }
    /**
     * @param \ATehnix\VkClient\Auth $auth
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirect(\ATehnix\VkClient\Auth $auth){
        /**
         * If there is no user vk then we register it
         * ELSE Login in system
         *
         * Note: If redirected URL of the above method login then we getting the ability to receive user data of the method below
         */
      return $this->vkRepository->registerNewUserIFNotExistAndLoginIn($auth);
    }
}
