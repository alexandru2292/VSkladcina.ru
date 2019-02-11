<?php
/**
 * Created by PhpStorm.
 * User: alexandru2292
 * Date: 2/4/19
 * Time: 11:41 PM
 */

namespace App\Repositories;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\Repositories\Tool;
use Carbon\Carbon;
class MessageRepository
{
    protected $userRole;
    protected $senderName;
    protected $loggedUser;
    protected $messageId;
    protected $senderId;
    public function getMessages(){
        /**
         * get all the messages to the logged user
         */
        $AuthUserId = Auth::user()->id;
        $messages = Message::groupBy('sender_user_id')->where('user_id',$AuthUserId)->orderBy('id', 'DESC')->get();
        $messages->load("hasSender");
        /**
         * Get user role of  the sender user
         */
        foreach ($messages as $key => $message){
            $this->userRole = $message->hasSender->load("role_user")->role_user->load("role")->role->alias;
            $this->senderName = $message->hasSender->name;
            $messages[$key]->sender = $this->senderName;
            if($this->userRole == "Moderator"){$messages[$key]->sender = "Модератор";}
            if($this->userRole == "Admin"){$messages[$key]->sender = "Администратор";}
            $dateEvent = \Carbon\Carbon::parse($message->created_at);
            $created_at = $dateEvent->format('d.m.y');
            $messages[$key]->sended_date = $created_at;

            /**
             * Show image if user is logged with social network
             * :// - if avatar contains a link
             */
            if(strpos($message->hasSender->avatar, '://') > 3 && strpos($message->hasSender->avatar, '://') < 6){
                 $messages[$key]->avatarHasLink = 1;
            }
        }
        return $messages->load("hasUser", "hasSender");
    }

    /**Get the users dialog
     * @param $request - the message id and sender id
     */
    public function getDialog($request){
        $this->loggedUser = Auth::user()->id;
        $this->senderId = $request->sender_user_id;

        $dialog = Message::where('user_id', $this->loggedUser)->where('sender_user_id', $this->senderId)
                         ->orWhere('user_id', $this->senderId)->orWhere('sender_user_id', $this->loggedUser)
                         ->get();

        $dialog->load("hasUser", "hasSender");
        /**
         * Set view content of the dialog
         */
        $content = "";
        foreach ($dialog as $key => $item){
            //get ToDay (Azi)
            $today = Carbon::today('Europe/Moscow');
            $today = $today->format('d.m.y');
            // get hour  and minutes
            $time = Carbon::parse($item->created_at);
            $time = $time->format('H:i');
            // get month day and year
            $created_at = Carbon::parse($item->created_at);
            $created_at = $created_at->format('d.m.y');

            if($created_at < $today){
                $dialog[$key]->dateFormat = $created_at.', '.$time;
            }else{
                $dialog[$key]->dateFormat = $time;
            }

            /**
             * Set role
             */
            $userRole = $item->hasSender->load('role_user')->role_user->load("role")->role->alias;
            $userRoleName = $item->hasSender->load('role_user')->role_user->load("role")->role->name;

            if($userRole == "Moderator" || $userRole == "Admin"){
                $dialog[$key]->hasSender->name = $userRoleName;
            };

            if ($item->sender_user_id == $this->loggedUser){
                $dialog[$key]->iAreSender = 1;
            }
            $avatarLink =  strpos($item->hasSender->avatar, '://');
            $content .= '<div class="comment-item">
                            <div class="comment-item__main">
                                <div class="comment-item__img">';
                                if($avatarLink > 4 && $avatarLink < 6){
                                    $content .= '<svg class="icon icon-avatar"><use xlink:href="{{ url(" '.$item->hasSender->avatar.' ") }}"/></svg> </div>';
                                }else{
                                    $content .= '<svg class="icon icon-avatar"><use xlink:href="{{ url("img/content/'.$item->hasSender->avatar.'") }}"/></svg> </div>';
                                }

                    $content .='<div class="comment-item__title">
                                    '.$item->hasSender->name.'
                                </div>
                                <div class="comment-item__message">
                                    <div class="comment-item__date">
                                       '.$item->dateFormat.'
                                    </div>
                                </div>
                                <div class="comment-item__text">
                                '.$item->message.'
                                </div>
                            </div>';
            if($item->iAreSender){
                $content .='   <div class="comment-item__links">
                                 <a href="javascript:void(0);" data-src="#popup-complain" class="comment-item__link-complain" data-fancybox>Пожаловаться</a>
                                </div>
                            </div>
                        </div>';
            }else{
        $content .= "</div>";
            }

        }
       return $content;
    }
}