<?php
/**
 * Created by PhpStorm.
 * User: alexandru2292
 * Date: 2/4/19
 * Time: 11:41 PM
 */

namespace App\Repositories;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\Repositories\Tool;
use Carbon\Carbon;
use DB;
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
        $sql = "SELECT m.*, u.name as sender_user_name, u.id as sender_user_id, r_u.role_id as role_id, u.avatar as avatar
                    FROM messages as m
                    inner join users as u on m.sender_user_id = u.id
                    inner join role_users as r_u on m.sender_user_id = r_u.user_id 
                    WHERE m.id IN (
                        SELECT  max(id)
                        FROM messages
                         where user_id = $AuthUserId
                        GROUP BY sender_user_id
                    ) order by m.created_at desc;";
        $messages =  DB::select($sql);
        $messages = collect($messages);
        /**
         * Get user role of  the sender user and Set date_format
         */
        foreach ($messages as $key => $message){

            $this->userRole = Role::find($message->role_id)->alias;

            $this->senderName = User::find($message->sender_user_id)->name;

            /**
             * set sender
             */
            $messages[$key]->sender = $this->senderName;

            /**
             * set name sender if user role == Moderator or Admin
             */
            if($this->userRole == "Moderator"){$messages[$key]->sender = "Модератор";}
            if($this->userRole == "Admin"){$messages[$key]->sender = "Администратор";}
            /**
             * Set date format
             */

            $dateEvent = \Carbon\Carbon::parse($message->created_at);
            $created_at = $dateEvent->format('d.m.y');
            $messages[$key]->sended_date = $created_at;

            /**
             * Mark the image link if user is logged with social network
             * :// - if avatar contains a link
             */
            if(strpos($message->avatar, '://') > 3 && strpos($message->avatar, '://') < 6){
                 $messages[$key]->avatarHasLink = 1;
            }
        }

        return $messages;
    }

    /**Get the users dialog
     * @param $request - the message id and sender id
     */
    public function getDialog($request){
        $this->loggedUser = Auth::user()->id;
        $this->senderId = $request->sender_user_id;


        $toUserFormSender = [
            ['user_id', '=',$this->loggedUser],
            ['sender_user_id', '=', $this->senderId]
        ];
        $toSenderFromUser = [
            ['user_id', '=', $this->senderId],
            ['sender_user_id', '=', $this->loggedUser]
        ];
        $dialog = Message::where($toUserFormSender)
            ->orWhere($toSenderFromUser)
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
            if($this->loggedUser == $item->hasSender->id){
                $dialog[$key]->hasSender->name = "Вы";
            }

            if ($item->sender_user_id == $this->loggedUser){
                $dialog[$key]->iAreSender = 1;
            }
            $avatarLink =  strpos($item->hasSender->avatar, '://');
            $content .= '<div class="comment-item">
                            <div class="comment-item__main">
                                <div class="comment-item__img">';
                                if($avatarLink > 4 && $avatarLink < 6){
                                    $content .= '<img src="'. url($item->hasSender->avatar) .'" width="40" height="40" style="border-radius: 50%"/></div>';
                                }else{
                                    if(!$item->hasSender->avatar){
                                        $content .= '<img src="'. url("/img/content/avatar.png").'" width="40" height="40" style="border-radius: 50%"/></div>';
                                    }
                                    $content .= '<img src="'. url("/img/content/".$item->hasSender->avatar).'" width="40" height="40" style="border-radius: 50%"/></div>';
                                }
                    $content .='<div class="comment-item__title">
                                    '.$item->hasSender->name.'
                                </div>
                                <input type="hidden" id="userId" value="'.$item->hasSender->id.'">
                                <div class="comment-item__message">
                                    <div class="comment-item__date">
                                       '.$item->dateFormat.'
                                    </div>
                                    <div class="comment-item__text">
                                    '.$item->message.'
                                    </div>
                                </div>';
            if(!$item->iAreSender){
                $content .='    <div class="comment-item__links">
                                  <a href="javascript:void(0);" data-src="#popup-complain" class="comment-item__link-complain" data-fancybox>Пожаловаться</a>
                                </div>
                             </div>
                         </div>';
            }else{
            $content .=   "</div>
                        </div>";
                }
        }
       return $content;
    }
    /**
     * Select the messages where column is_read is 0
     */
    public function selectNewMessages(){
        $this->loggedUser = Auth::user()->id;
        $newMessages = Message::select('sender_user_id')->where([['user_id', '=' , $this->loggedUser],['is_read', '=', 0]])->orderBy('id', "DESC")->get();
        if(count($newMessages) > 0){
            return response()->json(['success'=>1]);
        }else{
            return response()->json(['success'=>0]);
        }
    }
}