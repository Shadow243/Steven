<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Support\Facades\Auth;
use Musonza\Chat\Chat;

class MessageController extends BaseController
{
    private $views;
  public function __construct(ViewFactory $views)
  {
      parent::__construct();
      $this->views = $views;
  }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function DisplayMessagePage()
  {
      $onlineFriends = $this->OnlineFriends();
     // $message = $this->getRecentMessages()->latest()->paginate(1);
      return $this->views->make('pages.message.index', compact('onlineFriends'));
  }

    /**
     * @param User $user
     * @param Request $request
     * @return mixed
     */
    public function Create_if_Conv_Send_Message(User $user, Request $request)
  {
      $this->validate($request,[
          'content'=>'required'
      ],[
          'content.required'=> 'Vous devez saisir un Message'
      ]);
      $userId = Auth::user()->id;
      $userId2 = User::where('id', $user->id)->first();
      $conversation = Chat::getConversationBetweenUsers($userId, $userId2);
      if ($conversation)
      {
//          $message = Chat::send($conversation->id, $request->input('content'), $userId);
          $message = $this->SendTexMessage($conversation->id, $request->input('content'), $userId);
      }else{
          $conversation = Chat::createConversation([$userId, $userId2]);
          $message = $this->SendTexMessage($conversation->id, $request->input('content'), $userId);
      }

      return Response::json([
          'message' => $message,
      ]);
  }

    /**
     * @param $convresatioId
     * @param $mess
     * @param $userId
     */
    public function SendTexMessage($convresatioId, $mess, $userId)
  {
     return Chat::send($convresatioId->id, $mess, $userId);
  }

  public function getRecentMessages()
  {
      $userId = Auth::user()->id;
      $mesages = Chat::conversations($userId);
      return $mesages;
  }
}
