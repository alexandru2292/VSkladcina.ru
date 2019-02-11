<?php

namespace App\Http\Controllers;

use App\Message;
use App\Repositories\MessageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
     * Show the users dialogs
     */
    public function showDialog(Request $request){
       $this->dialogs = $this->msgRepository->getDialog($request);
       return response()->json($this->dialogs);
    }

    /**
     * Get last Message
     */
    public function ifNewMessage(){
        $this->newMessages = $this->msgRepository->selectNewMessages();
        return $this->newMessages;
    }
}
