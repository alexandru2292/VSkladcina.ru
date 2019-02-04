<?php

namespace App\Http\Controllers;

use App\Follower;
use App\Repositories\FollowerRepository;
use App\Stock;
use Illuminate\Http\Request;
use Auth;
use DB;
class FollowerController extends Controller
{
    protected $followerRepository;
    public function __construct(FollowerRepository $followerRepository)
    {
        $this->followerRepository = $followerRepository;
    }
    /**
     *
     * @param Follower $follower - The one who follows - (cel care se va abona)
     * @param $stock_id  -   the stock we follows to (stocul la care se va abona)
     *
     */
   public function follows(Follower $follower,$stock_id){
       /**
        * the logged-in user will subscribe to this stock
        */
       return $this->followerRepository->followsUser($follower, $stock_id);
   }

    /**
     * @param Follower $follower
     * @param $stock_id
     * the logged-in user will subscribe to this stock
     */
   public function unFollows(Follower $follower, $stock_id){


       return $this->followerRepository->unFollowsUser($follower, $stock_id);
   }
}
