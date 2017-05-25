<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory as ViewFac;
use Illuminate\Support\Facades\Auth;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends BaseController
{

    public function __construct(ViewFac $views)
    {
        parent::__construct($views);
        $this->views = $views;
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        return view('adminlte::home');
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function DisplayHome()
    {
        $publications = Post::with('user','comments','likes')->latest()->paginate(5);
        $freinds = User::where('id', '<>', Auth::user()->id)->latest()->paginate(10);
        $onlineFriends = $this->OnlineFriends();
//        $frienRequests =
        return $this->views->make('pages.home.index', compact(
            'publications',
            'onlineFriends',
            'freinds'
        ));
    }
}