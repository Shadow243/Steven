<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Profil;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\View\Factory as ViewFactory;

class ProfileController extends BaseController
{
    /**
     * @var ViewFactory
     */
    private $views;

    /**
     * ProfileController constructor.
     * @param ViewFactory $views
     */
    public function __construct(ViewFactory $views)
    {
        parent::__construct();
        $this->views = $views;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
   {

       $onlineFriends = $this->OnlineFriends();
       return $this->views->make('pages.profil.index', compact('onlineFriends'));
   }


    /**
     * @param ProfileRequest $request
     * @return mixed
     */
    public function store(ProfileRequest $request)
    {
//        dd($request->all());
        $user = Auth::user();

        $user->name = $request->input('name');
        $user->post = $request->input('postname');
        $user->prename = $request->input('prename');
        $user->sexe = $request->input('sexe');
        $user->Nationality = $request->input('country');
        $user->city = $request->input('city');
//        $data->slug = $request->input('');
        $user->save();
       //return redirect()->back()->with('success', 'Profil mis en jour');
        
        return Response::json([
            'msg' => 'Profil mis en jour',
            'user' => $user,
        ], 200);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function ChangeAvatar(Request $request)
    {
        $this->validate($request,[
            'photo_profil_user' => 'required|image',
        ],
        [
            'photo_profil_user.image' => 'La photo du profil doit être une image',
        ]);

        $user = Auth::user();

// dd($user->photo);
        if ($request->hasFile('photo_profil_user')){
            $file = $request->file('photo_profil_user') ;

            $filepath = 'uploads/Profiles/';

            if(!file_exists($filepath))
            {
                mkdir($filepath, 0777, true);
            }
            if($user->photo)
            {
                if(file_exists($filepath . $user->photo))
                {
                    unlink($filepath . $user->photo);
                }                
            }

            $filename = date('YmdHis') . str_random(15) . '.' . $file->guessClientExtension();

            $file->move($filepath, $filename);

            $user->photo =  $filename;
        }

        $user->save();
        //return redirect()->back()->with('success', 'Profil mis en jour');

        return Response::json([
            'msg' => 'Image Profil mis en jour',
            'user' => $user,
            'photo' => $user->GetPhoto(),
        ], 200);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function ChangeCover(Request $request)
    {
        $this->validate($request,[
            'photo_cover_user' => 'required|image',
        ],
        [
            'photo_cover_user.image' => 'La photo de couverture doit être une image',
        ]);

        $user = Auth::user();

        if ($request->hasFile('photo_cover_user')){
            $file = $request->file('photo_cover_user') ;

            $filepath = 'uploads/Profiles/Mur/';

            if(!file_exists($filepath))
            {
                mkdir($filepath, 0777, true);
            }
            if(file_exists($filepath . $user->MurPhoto))
            {
                unlink($filepath . $user->MurPhoto);
            }
            $filename = date('YmdHis') . str_random(15) . '.' . $file->guessClientExtension();

            $file->move($filepath, $filename);

            $user->MurPhoto =  $filename;
        }


        $user->save();
        //return redirect()->back()->with('success', 'Profil mis en jour');

        return Response::json([
            'msg' => 'Image couverture mis en jour',
            'user' => $user,
            'photo' => $user->MurPhoto,
        ], 200);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function DisplayAboutPage()
    {
        $onlineFriends = $this->OnlineFriends();
        $Users = User::where('id', '<>', Auth::user()->id)->latest()->paginate(6);
        return $this->views->make('pages.About.index', compact('onlineFriends','Users'));
    }
}
