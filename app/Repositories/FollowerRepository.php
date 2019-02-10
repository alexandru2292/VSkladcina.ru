<?php
/**
 * Created by PhpStorm.
 * User: alexandru2292
 * Date: 2/4/19
 * Time: 11:41 PM
 */

namespace App\Repositories;
use App\Follower;
use Auth;
class FollowerRepository
{
    public function followsUser($follower, $stock_id){
        /**
         * if you are not following , then(atunci) it subscribe
         */
        $hasFollowing = Follower::where([['user_id', Auth::user()->id], ['stock_id', $stock_id]])->first();

        if(!$hasFollowing){
            $follower->user_id = Auth::user()->id;
            $follower->stock_id = $stock_id;
            if ($follower->save()){
                return response()->json(['success'=> 1]);
            }
        }else{
            return response()->json(['success'=> 0]);
        }
    }

    public function unFollowsUser($follower, $stock_id){
        /**
         * if you are following , then(atunci) it  Unsubscribe
         */
        $hasFollowing = Follower::where([['stock_id', '=', $stock_id], ['user_id' ,'=', Auth::user()->id]])->first();

        if($hasFollowing){
            if ($hasFollowing->delete()){
                return response()->json(['success'=> 1]);
            }
        }else{
            return response()->json(['success'=> 0]);
        }
    }
}