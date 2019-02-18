<?php

namespace App\Http\Controllers;

use App\Message;
use App\Repositories\MessageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Type;
use App\Events\NewMessageNotification;
class MessageController extends SiteController
{
    protected $msgRepository;
    protected $dialogs;
    protected $newMessages;
    public function __construct(MessageRepository $msgRepository)
    {

        $this->msgRepository = $msgRepository;
        $this->template = config('settings.theme').'.index';
    }

    /**
     * show all messages of the logged user
     */
    public function showMessages(){
        $messages = $this->msgRepository->getMessages();
        $this->content = view(config('settings.theme').'.messages')->with(['messages'=> $messages])->render();
        return $this->renderOutput();
    }


    /**
     * Show the users dialogs and hide RedPoint if is not new message
     */
    public function showDialog(Request $request){
       if($request->hideRedPoint == 1){
           $update = $this->msgRepository->readThisMessage($request->sender_user_id);
       }
       $this->dialogs = $this->msgRepository->getDialog($request);
       return response()->json(['dialogs' => $this->dialogs, 'updateIsRead'=> isset($update) ? $update : 0]);
    }

    /**
     * Get last Message
     */
    public function ifNewMessage(){
        $this->newMessages = $this->msgRepository->selectNewMessages();
        return $this->newMessages;
    }

    /** Update column is_read after the timeOut function expires
     * @param Request $request
     * @return Type(json)
     */

    public function updateIsReadColumn(Request $request){
        if($request->intervalUpdate == 1){
            if($this->msgRepository->readThisMessage($request->sender_user_id)){
                return response()->json(['success' => 1]);
            }
        }
    }

    /**
     * Send new message to sender user
     */
    public function sendNewMessage(Request $request){
       return  $this->msgRepository->insertNewMessage($request);
    }
    /**
     * Remove the dialog
     */
    public function removeDialog(Request $request){
        return $this->msgRepository->removeTheDialog($request->sender_user_id);
    }


    /**
     * Check if exist new message then return it, else not exist return false
     */
    public function checkIfExistNewMessage(Request $request){
        $result =  $this->msgRepository->getNewMessageIfExist($request->sender_user_id);
        return $result;
    }

}
