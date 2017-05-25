<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\User;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Kim\Activity\Activity;
use Musonza\Chat\Chat;
use Musonza\Chat\Conversations\Conversation;
use Illuminate\Contracts\View\Factory as ViewFactory;

class BaseController extends Controller
{
    protected $views;
    /**
     * BaseController constructor.
     */
    public function __construct(ViewFactory $views)
    {
        $this->middleware('auth');
        $this->views = $views;
    }

    /** sugestion list users randed
     * @return mixed
     */
    public function PeapleYoumayKnow()
    {
        //recupere aleatoirement les users et fiat la pagination par 2
        $users = User::orderByRaw("RAND()")->paginate(2);

        return Response::json([
            'content' => $users,
        ]);
    }

    /** From Kim Activity
     * @return \Illuminate\Support\Collection
     */
    function most_recent_activity()
    {
        $activities = [];
        $activities = Activity::users()->mostRecent()->get();
        foreach ($activities as $activity) {
            return collect($activity->user);
        }
    }

    public function loadMessage($userId)
    {
//        $conversation = [];
        $currentUserId = Auth::user()->id;
        $threads = Thread::Between([$currentUserId, $userId])->latest('created_at')->get();
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
//       dd($threads);
        //return $threads = collect($conversation);
        return $this->views->make('pages.message.chat', compact('threads'))->render();
    }

    /** from Highdeas And kim
     * @return \Illuminate\Support\Collection
     */
    public function OnlineFriends()
    {
        $users = [];
        $user = Auth::user();

//        $activities = $this->most_recent_activity();
          foreach($user->mostRecentOnline() as $online_user)
        {
            if($user->isFriendWith($online_user))
                {
//                    if($online_user->isOnline())
//                    {
                        $users[] = $online_user;
//                    }
                }
                
            }

        $onlineFriends = collect($users);

        return $this->views->make('pages.partials.online_user', compact('onlineFriends'))->render();
    }

//    public function getPosts()
//    {
//        $publi  = Post::with('user','comments','likes')->latest()->paginate(5);
//        return collect($publi);
//    }

//    public function getAllfreind()
//    {
//        $fr = User::where('id', '<>', Auth::user()->id)->latest()->paginate(10);
//        return collect($fr);
//    }
    /** List Of Freind returned in Ajax(json)
     * @return mixed
     */
    public function Onle_ajax_alist_freind()
    {
        $list_user = $this->OnlineFriends();
        return Response::json([
            'users' => $list_user,
        ]);
    }

    /**Getiing chat between 2 users
     * @param $userId
     * @param $userId2
     * @return null
     */
    public function GetChatBetween_2_Users($userId, $userId2)
    {
       $conversation = Chat::getConversationBetweenUsers($userId, $userId2);

       return $conversation;

    }

    /**
     * return a conversation by Id
     */
    public function it_returns_a_conversation_given_the_id()
    {
        $conversation = Chat::createConversation();

        $c = Chat::conversation($conversation->id);

        $this->assertEquals($conversation->id, $c->id);
    }

    /** to Send a text message
     * @param $message
     * @param $recipient_id
     * @return mixed
     */
    public function SendMessage($message, $recipient_id)
    {

        $Current_User_Id = Auth::user()->id;

//        $conversation = Chat::createConversation([$users[0]->id, $users[1]->id]);
        $conversation = Chat::createConversation($Current_User_Id, $recipient_id);

        $message = Chat::send($conversation->id, $message, $Current_User_Id);

        $this->assertEquals($conversation->messages->count(), 1);

        return Response::json([
            'content' => $message,
        ]);

    }

    /** to delete a message
     *
     */
    public function it_can_delete_a_message()
    {
        $user_id = Auth::user()->id;
        $recipient_id = '';
        $conversation = $this->GetChatBetween_2_Users($user_id, $recipient_id);

        $messageId = 1;
        $perPage = 5;
        $page = 1;

        Chat::trash($messageId, $user_id);

        $this->dontSeeInDatabase('message_notification', ['message_id' => $messageId, 'user_id' => $user_id, 'deleted_at' => null]);

        $this->assertEquals(Chat::messages($user_id, $conversation->id, $perPage, $page)->count(), 0);
    }

    /** To upload file
     * @param $filepath
     * @param $file
     */
    public function uploadFile($filepath, $file)
    {
            //$file = $request->file('photo') ;

            //$filepath = 'uploads/Post/';

            if(!file_exists($filepath))
            {
                mkdir($filepath, 0777, true);
            }

            $filename = date('YmdHis') . str_random(15) . '.' . $file->guessClientExtension();

            $file->move($filepath, $filename);

            //$post->photo =  $filename;

    }
}
