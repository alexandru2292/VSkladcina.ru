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

//        $firstMessageFromLoggedUser = "SELECT m.*, u.name as sender_user_name, u.id as sender_user_id, r_u.role_id as role_id, u.avatar as avatar
//                    FROM messages as m
//                    inner join users as u on m.user_id = u.id
//                    inner join role_users as r_u on m.user_id = r_u.user_id
//                    WHERE m.id IN (
//                        SELECT  max(id)
//                        FROM messages
//                         where sender_user_id = $AuthUserId and is_read = 0
//                        GROUP BY sender_user_id
//                    ) order by m.created_at desc;";
//
//        $firstMess = DB::select($firstMessageFromLoggedUser);



//        foreach ($firstMess as $key => $item){
//            $firstMess[$key]->sender_user_id = $item->user_id;
//            $firstMess[$key]->user_id = $AuthUserId;
//        }
//




        /**
         * we mark the user to choose the second correspondent (senderId)
         */
//        foreach ($messages as $key => $message){
//            $messages[$key]->iSentFirst = 1;
//        }

        $messages =  DB::select($sql); //messages sent first by the sender user

//        foreach ($messages as $key => $item){
//            $firstMess[] = $item;
//        }
//        dd($firstMess);

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
        /**
         * messages sent first by the logged-in user
         */

//        $senderIsLoggedUser = [
//            ['sender_user_id', '=', $this->loggedUser],
//            ['is_read', '=', 0]
//        ];

        $dialog = Message::where($toUserFormSender)
            ->orWhere($toSenderFromUser)
            ->get();

        foreach($dialog as $key =>  $item){
            if($item->sender_user_id == $this->loggedUser){
                $dialog[$key]->iSentFirst = 1;
            }
        }

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

            $content .= $this->viewDialog($avatarLink, $item->hasSender->avatar, $item->hasSender->name, $item->hasSender->id, $item->dateFormat, $item->message, $item->iAreSender);
        }

       return $content;
    }
    /**
     * Select the messages where column is_read is 0 for  mark the dialog with red point
     */
    public function selectNewMessages(){
        $this->loggedUser = Auth::user()->id;
        $newMessages = Message::select('sender_user_id')->where([['user_id', '=' , $this->loggedUser],['is_read', '=', 0]])->orderBy('id', "DESC")->groupBy('sender_user_id')->get();
        $senders = [];
        foreach ($newMessages as $message){
            $senders[] = $message->sender_user_id;
        }

        if(count($newMessages) > 0){
            return response()->json(['success'=>1, 'senders' => $senders]);
        }else{
            return response()->json(['success'=>0]);
        }
    }

    /** Update the column is_read to(pentru) delete the red point and to mark the dialogue as read(citit)
     * @param $senderId - UPDATE messages SET is_read = '$senderId'
     */
    public function readThisMessage($senderId){
        /**
         * Check if exist value 0 in the column is_read
         * if value == 0 we do update the column in 1
         */

        $loggedUser = Auth::user()->id;
        $messages = Message::where('sender_user_id', $senderId)->where('user_id',$loggedUser)->where('is_read', 0)->get();
        $countMess = count($messages);

        if($countMess > 0)
        {
            $success = 0;
            foreach ($messages as $message){
                $message->is_read = 1;
                if($message->save()){
                    $success = 1;
                }
            }
            return $success;
        }

    }

    /**
     * Insert new message
     */
    public function insertNewMessage($request){

        if(count($request->message) > 0){

            $message = new Message();
            $message->user_id = intval($request->sender_user_id);
            $message->message = $request->message;
            $message->sender_user_id = Auth::user()->id;
            if($message->save()){
                $message->load("hasUser", "hasSender");
                $avatarLink = strpos($message->hasSender->avatar, '://');
                $message->hasSender->name = "Вы";
                /**
                 * Set date format
                 */
                //get ToDay (Azi)
                $today = Carbon::today('Europe/Moscow');
                $today = $today->format('d.m.y');
                // get hour  and minutes
                $time = Carbon::parse($message->created_at);
                $time = $time->format('H:i');
                // get month day and year
                $created_at = Carbon::parse($message->created_at);
                $created_at = $created_at->format('d.m.y');

                if($created_at < $today){
                    $message->dateFormat = $created_at.', '.$time;
                }else{
                    $message->dateFormat = $time;
                }
                $dialog = $this->viewDialog($avatarLink, $message->hasSender->avatar, $message->hasSender->name, $message->hasSender->id, $message->dateFormat, $message->message, 1);
                return response()->json(['success'=> 1, 'dialog'=>$dialog]);
            }
        }else{
            return response()->json(['success'=> 0]);
        }
    }



    public function viewDialog($avatarLink, $itemHasSenderAvatar, $itemHasSenderName, $itemHasSenderId, $itemDateFormat, $itemMessage, $itemIAreSender){

       $content = '<div class="comment-item">
                            <div class="comment-item__main">
                                <div class="comment-item__img">';
        if($avatarLink > 4 && $avatarLink < 6){
            $content .= '<img src="'. url($itemHasSenderAvatar) .'" width="40" height="40" style="border-radius: 50%"/></div>';
        }else{
            if(!$itemHasSenderAvatar){
                $content .= '<img src="'. url("/img/content/avatar.png").'" width="40" height="40" style="border-radius: 50%"/></div>';
            }
            $content .= '<img src="'. url("/img/content/".$itemHasSenderAvatar).'" width="40" height="40" style="border-radius: 50%"/></div>';
        }
        $content .='<div class="comment-item__title">
                                    '.$itemHasSenderName.'
                                </div>
                                <input type="hidden" id="userId" value="'.$itemHasSenderId.'">
                                <div class="comment-item__message">
                                    <div class="comment-item__date">
                                       '.$itemDateFormat.'
                                    </div>
                                    <div class="comment-item__text" >
                                    '.$itemMessage.'
                                    </div>
                                </div>';
        if(!$itemIAreSender){
            $content .='    <div class="comment-item__links">
                                  <a href="javascript:void(0);" data-src="#popup-complain" class="comment-item__link-complain" data-fancybox>Пожаловаться</a>
                                </div>
                             </div>
                         </div>';
        }else{
            $content .=   "</div>
                        </div>";
        }
        return $content;
    }

    /**
     * @param $senderId - the column which we will to delete , where user_id = $senderId and sender_user_id = $senderId
     */
    public function removeTheDialog($senderId){

        $whereArray = array('user_id' => $senderId,'sender_user_id' => $senderId);

      $whereUserId =  Message::where('user_id',$senderId)->delete();
      $whereSenderid =  Message::where('sender_user_id',$senderId)->delete();
       if ($whereUserId || $whereSenderid){
           return response()->json(['success'=> 1]);
       }else{
           return response()->json(['success'=> 0]);
        }
    }

    /** Chec if exist new message then return it
     * @param $senderId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNewMessageIfExist($request){

        $loggedUser = Auth::user()->id;
        $message = Message::where([['user_id','=',$loggedUser],['sender_user_id','=',$request->sender_user_id], ['is_read','=',0]])->get();

        $message->load("hasUser", "hasSender");

        if($message->count() < 1){
           return response()->json(['success'=> 0]);
        }else{
            /**
             * Set view content of the dialog
             */
            $content = "";
            $messageIds = [];

            foreach ($message as $key => $item){
                /**
                 * If message is repeat unset it
                 */
                if($item->message == $request->lastMessage){
                    unset($message[$key]);
                }
                /**
                 * If message == last Message from form the unset it
                 */

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
                    $message[$key]->dateFormat = $created_at.', '.$time;
                }else{
                    $message[$key]->dateFormat = $time;
                }

                /**
                 * Set role
                 */
                $userRole = $item->hasSender->load('role_user')->role_user->load("role")->role->alias;
                $userRoleName = $item->hasSender->load('role_user')->role_user->load("role")->role->name;

                if($userRole == "Moderator" || $userRole == "Admin"){
                    $message[$key]->hasSender->name = $userRoleName;
                };
                if($this->loggedUser == $item->hasSender->id){
                    $message[$key]->hasSender->name = "Вы";
                }

                if ($item->sender_user_id == $this->loggedUser){
                    $message[$key]->iAreSender = 1;
                }
                $avatarLink =  strpos($item->hasSender->avatar, '://');


                $content .= $this->viewDialog($avatarLink, $item->hasSender->avatar, $item->hasSender->name, $item->hasSender->id, $item->dateFormat, $item->message, $item->iAreSender);
                $messageIds[] = $item->id;

            }
            /**
             *will the marked that  read
             */
            $updated  =   DB::table('messages')->whereIn('id', $messageIds)->update(['is_read'=>1]);

            return response()->json(['success'=> 1, 'message'=>$content, 'updated_read' => $updated, 'senderId'=>$request->sender_user_id]);
        }
    }
    public function markMessageThatRead($messagesId){
        $updated  =   DB::table('messages')->whereIn('id', $messagesId)->update(['is_read'=>1]);
        if($updated){
           return response()->json(['updated_read'=> 1]);
        }
    }

}
