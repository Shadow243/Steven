<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Musonza\Chat\Chat;

class MessageController extends BaseController
{

  public function __construct(ViewFactory $views)
  {
      parent::__construct($views);
      $this->views = $views;
  }


    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function DisplayMessagePage()
  {
      $onlineFriends = $this->OnlineFriends();
     // $message = $this->getRecentMessages()->latest()->paginate(1);

      // All threads that user is participating in
//       $threadsAll = Thread::forUser(Auth::id())->latest('updated_at')->get();
      // All threads that user is participating in, with new messages
        $threads = Thread::forUserWithNewMessages(Auth::id())->latest('updated_at')->get();
      // All threads, ignore deleted/archived participants
//      $threads = Thread::getAllLatest()->get();
        //$messages = Thread::getLastconversationMessage();


      return $this->views->make('pages.message.index', compact(
          'onlineFriends',
          'threads',
          'messages'
      ));
  }

  public function showchatbox($userId)
  {
      $currentUserId = Auth::user()->id;
      $messages = [];
      $user_clicked = User::where('id', $userId)->first();
      $threads = Thread::Between([$currentUserId, $userId])->latest('created_at')->paginate(10);
//      dd($threads);
      if ($threads)
      {
          foreach ($threads as $key => $thread) {
              $thread->unread = $thread->isUnread($currentUserId);

              $thread->lastMessage = $thread->latestMessage;

              $participants = $thread->participants()->get();

              foreach ($participants as $key => $participant) {
                  if ($participant->user->id != Auth::user()->id) {
                      $thread->user = $participant->user;
                      break;
                  }
              }
              $thread->conversationMessages = $thread->messages()->orderBy('created_at', 'ASC')->latest()->with('user')->paginate(10);

              foreach ($threads as $cov)
              {
                  $threads->messages = $cov->messages;
              }
          }
      }

      return $this->views->make('pages.message.chatbax', compact('threads','user_clicked'))->render();
  }

    public function getMessages()
    {
        $currentUserId = Auth::user()->id;

        // All threads that user is participating in
        $threads = Thread::forUser($currentUserId)->latest('updated_at')->paginate(30);
        // the last thread that user participated in
//        $lastconversation = Thread::forUser($currentUserId)->latest('created_at')->orderBy('id','DESC')->paginate(1);
        $lastconversations = Thread::forUser($currentUserId)->with('messages')->latest('created_at')->paginate(1);
        foreach ($lastconversations as $key => $lastconversation) {
            $lastconversation->unread = $lastconversation->isUnread($currentUserId);

            $lastconversation->lastMessage = $lastconversation->latestMessage;
            $participants_conv = $lastconversation->participants()->get();

            foreach ($participants_conv as $key => $participant_conv) {
                if ($participant_conv->user->id != Auth::user()->id) {
                    $lastconversation->user = $participant_conv->user;
                    break;
                }
            }
        }
//        dd($lastconversations);
        foreach ($threads as $key => $thread) {
            $thread->unread = $thread->isUnread($currentUserId);

            $thread->lastMessage = $thread->latestMessage;

            $participants = $thread->participants()->get();

            foreach ($participants as $key => $participant) {
                if ($participant->user->id != Auth::user()->id) {
                    $thread->user = $participant->user;
                    break;
                }
            }
        }
        //dd($threads);
        return $this->views->make('pages.message.index', compact(
            'threads',
            'lastconversations'
        ));
    }

    /**
     * Shows a message thread.
     *
     * @param $id
     *
     * @return mixed
     */
    public function show($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: '.$id.' was not found.');

            return redirect('messages');
        }

        // don't show the current user in list
        $userId = Auth::user()->id;
        $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();

        $thread->markAsRead($userId);

        $messages = [];

        $thread->conversationMessages = $thread->messages()->orderBy('created_at', 'ASC')->latest()->with('user')->paginate(10);

        //return response()->json(['status' => '200', 'data' => $thread]);

        return $this->views->make('pages.message.show', compact('thread', 'users'))->render();
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

  //MESSANGER PACKAGE STARTING

    /**
     * Shows a message thread.
     *
     * @param $id
     * @return mixed
     */
//    public function show($id)
//    {
//        try {
//            $thread = Thread::findOrFail($id);
//        } catch (ModelNotFoundException $e) {
//            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');
//            return redirect('messages');
//        }
//        // show current user in list if not a current participant
//        // $users = User::whereNotIn('id', $thread->participantsUserIds())->get();
//        // don't show the current user in list
//        $userId = Auth::user()->id;
//        $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();
//        $thread->markAsRead($userId);
//        return $this->views->make('pages.message.index', compact('thread', 'users'));
//    }
    /**
     * Creates a new message thread.
     *
     * @return mixed
     */
    public function create()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return $this->views->make('pages.message.index', compact('users'));
    }

    /**
     * Stores a new message thread.
     *
     * @return mixed
     */
    public function store()
    {
        $input = Input::all();
        $thread = Thread::create(
            [
                'subject' => $input['subject'],
            ]
        );
        // Message
        Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'body'      => $input['message'],
            ]
        );
        // Sender
        Participant::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'last_read' => new Carbon,
            ]
        );
        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipant($input['recipients']);
        }
        return redirect('messages');
    }

    public function CountNewMessage()
    {
        $count = Auth::user()->newThreadsCount();
        if($count > 0)
        {
            return Response::json([
                'number' => $count,
            ]);
        }
    }

    /**
     * Adds a new message to a current thread.
     *
     * @param $id
     *
     * @param Request $request
     * @return mixed
     */
    public function update($id, Request $request)
    {
        $this->validate($request,[
            'body'=>'required',
        ],[
            'body.required'=> 'Vous devez saisir d\'abord votre message'
        ]);

        $thread = Thread::findOrFail($id);
        if ($thread) {
            // Message
            $message = Message::create(
                [
                    'thread_id' => $thread->id,
                    'user_id' => Auth::id(),
                    'body' => $request->input('body'),
                ]
            );

            if ($request->hasFile('post_images_upload')) {
//            $this->UploadAttachment($request, $message);
//        }
                $message->user = $message->user;

                $thread->activateAllParticipants();
                // activate all participants
                $participants = $thread->participants()->withTrashed()->get();
                foreach ($participants as $participant) {
                    $participant->restore();
                    if (Auth::id() != $participant->user->id) {
                        // echo $participant->user->id;
                        //Event::fire(new MessagePublished($message, $participant->user));
                    }
                }
                // Add replier as a participant
                $participant = Participant::firstOrCreate(
                    [
                        'thread_id' => $thread->id,
                        'user_id' => Auth::user()->id,
                    ]
                );
                $participant->last_read = new Carbon();
                $participant->save();

                // Recipients
                if (Input::has('recipients')) {
                    $thread->addParticipant(Input::get('recipients'));
                }
            }

        }

        return $this->views->make('pages.message.msg', compact(
            'message'
        ))->render();
        return response()->json(['status' => '200', 'data' => $message]);
    }

//    /**
//     * Adds a new message to a current thread.
//     *
//     * @param $id
//     * @return mixed
//     */
//    public function update($id)
//    {
//        try {
//            $thread = Thread::findOrFail($id);
//        } catch (ModelNotFoundException $e) {
//            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');
//            return redirect('messages');
//        }
//        $thread->activateAllParticipants();
//        // Message
//        Message::create(
//            [
//                'thread_id' => $thread->id,
//                'user_id'   => Auth::id(),
//                'body'      => Input::get('message'),
//            ]
//        );
//        // Add replier as a participant
//        $participant = Participant::firstOrCreate(
//            [
//                'thread_id' => $thread->id,
//                'user_id'   => Auth::user()->id,
//            ]
//        );
//        $participant->last_read = new Carbon;
//        $participant->save();
//        // Recipients
//        if (Input::has('recipients')) {
//            $thread->addParticipant(Input::get('recipients'));
//        }
//        return redirect('messages/' . $id);
//    }

}
