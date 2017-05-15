<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class FriendController extends BaseController
{
    /**
     * @var ViewFactory
     */
    private $views;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ViewFactory $views)
    {
//        $this->middleware('auth');
        $this->views = $views;
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $freinds = User::where('id', '<>', Auth::user()->id)->latest()->paginate(6);
        $onlineFriends = $this->OnlineFriends();
        return $this->views->make('pages.Freinds.index',compact('freinds','onlineFriends'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function SendFriendRequest(Request $request)
    {
        $this->validate($request, [
            'userId' => 'required|integer'
        ]);

        $message = '';
        $type = 'success';
        $reciever = User::where('id', $request->userId)->first();

        if($reciever)
        {
            $user = Auth::user();

            if(!$user->isFriendWith($reciever))
            {
                if(!$user->hasSentFriendRequestTo($reciever))
                {
                    if(!$user->hasFriendRequestFrom($reciever))
                    {
                        $user->befriend($reciever);
                        $message = 'Demande envoyé';
                        $type = 'success';
                    }else{
                        $message = $reciever->name.' vous a déjà envoyé une demande';
                        $type = 'error';
                    }
                }else{
                    $message = 'Vous avez déjà envoyé a '.$reciever->name;
                    $type = 'error';
                }
            }else{
                $message = 'Vous êtes deja amis avec '.$reciever->name;
                $type = 'error';
            }

        }else{
            $message = 'Cet utilisateur n\'existe pas';
            $type = 'error';
        }
        return Response::json([
            'msg' => $message,
            'type' => $type,
        ], 200);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function BlockFreind(Request $request)
    {
        $message = '';
        $type = 'success';
        $user = Auth::user();

        $this->validate($request, [
            'userId' => 'required|integer'
        ]);

        $friend = User::where('id', $request->userId)->first();

        if ($friend)
        {
            if ($user->isFriendWith($friend))
            {
                $user->blockFriend($friend);
            }else{
                $message = 'Vous n\'ete pas amis avec'.$friend->name;
                $type = 'error';
            }
        }else{
            $message = 'Cet utilisateur n\'existe pas';
            $type = 'error';
        }

        return Response::json([
            'msg' => $message,
            'type' => $type,
        ], 200);

    }

    /**
     * @return mixed
     */
    public function allUserFreinds()
    {
        $user  = Auth::user();

        $users = $user->getAllFriendships();

        return Response::json([
            'content' => $users,
    ], 200);
    }

    /**
     * @param Request $request
     */
    public function SingleFreindship(Request $request)
    {
        $this->validate($request, [
            'userId' => 'required|integer'
        ]);

        $user = Auth::user();
        $friend = User::where('id', $request->userId)->first();
        if ($friend)
        {
            if ($user->isFriendWith($friend))
            {
                $user->getFriendship($friend);

            }else{
                $message = 'Vous n\ete pas ami avec cet Utilisateur';
                $type = 'error';
            }
        }else{
            $message = 'Cet utilisateur n\'existe pas';
            $type = 'error';
        }
    }

    /**
     * @param Request $request
     * accept request if he has sented it to me
     */
    public function AcceptFreindRequest(Request $request)
    {
        $this->validate($request, [
            'userId' => 'required|integer'
        ],[
            'userId.required' => 'Cet utilisateur existe pas',
            'userId.integer' => 'Identifiant incorrect pour cet utilisateur'
        ]);
        $message = '';
        $type = 'success';

        $user = Auth::user();
        $sender = User::where('id', $request->userId)->first();

        if($sender)
        {
            if (!$user->isFriendWith($sender))
            {
                if($user->hasFriendRequestFrom($sender))
                {
                    $user->acceptFriendRequest($sender);
                    $message = 'Invitation accepter';
                    $type = 'success';
                }else{
                    $message = 'Cet utilisateur ne vous a jamais envoyer une demande';
                    $type = 'error';
                }
            }else{
                $message = 'Vous ete deja ami avec'.$sender->name;
                $type = 'error';
            }
        }else{
            $message = 'Cet utilisateur n\'existe pas';
            $type = 'error';
        }
        return Response::json([
            'msg' => $message,
            'type' => $type,
        ], 200);

    }

    /**
     * @param Request $request
     */
    public function UserIsBlockedBy(Request $request)
    {
        $this->validate($request, [
            'userId' => 'required|integer'
        ]);

        $user = Auth::user();
        $friend = User::where('id', $request->userId)->first();
        if ($friend)
        {
            $user->isBlockedBy($friend);
            $message = 'Vous avez ete blocker par :'.$friend->name;
            $type = 'warnning';
        }else{
            $message = 'Cet utilisateur n\'existe pas';
            $type = 'error';
        }

        return Response::json([
            'msg' => $message,
            'type' => $type,
        ], 200);
    }

    /**
     * @param Request $request
     */
    public function DenignedFriendRequest(Request $request)
    {
        $this->validate($request, [
            'userId' => 'required|integer'
        ],[
            'userId.required' => 'Cet utilisateur existe pas',
            'userId.integer' => 'Identifiant incorrect pour cet utilisateur'
        ]);
        $message = '';
        $type = '';

        $user = Auth::user();
        $sender = User::where('id', $request->userId)->first();
        if($sender)
        {
            $user->denyFriendRequest($sender);
            $message = 'demande annuler';
            $type = 'info';
        }
        else{
                $message = 'Cet utilisateur n\'existe pas';
                $type = 'error';
        }

        return Response::json([
            'msg' => $message,
            'type' => $type,
        ]);

    }


}
