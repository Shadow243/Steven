<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Comments;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\Factory as ViewFac;
use Illuminate\Support\Facades\Response;

class PostController extends BaseController
{
    
    private $views;
    public function __construct(ViewFac $views)
    {
        parent::__construct();
        $this->views = $views;
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $onlineFriends = $this->OnlineFriends();
        $publications  = Post::with('user','comments','likes')->latest()->paginate(5);

        return $this->views->make('home', compact('publications','onlineFriends'));
    }


//    public function MorePosts()
//    {
//        $posts = Post::with('user','comments','likes')->latest()->limit(10)->get();
//        return $posts;
//    }

    /**
     * @param PostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostRequest $request)
    {
//        dd($request->all());
        $post = new Post();
        $post->content = $request->input('content');
        if ($request->hasFile('photo'))
        {
            $file = $request->file('photo') ;

            $filepath = 'uploads/Post/';

            if(!file_exists($filepath))
            {
                mkdir($filepath, 0777, true);
            }

            $filename = date('YmdHis') . str_random(15) . '.' . $file->guessClientExtension();

            $file->move($filepath, $filename);

            $post->photo =  $filename;
        }
        Auth::user()->posts()->save($post);

        return redirect()->back()->with('success','Publication enregistrer avec succes');
    }

    /**
     * @param Request $request
     * @return mixed   to post a comment
     */
    public function storeComment(Request $request)
    {
             $this->validate($request,[
                 'content'=>'required'
             ],[
                 'content.required'=> 'Vous devez saisir un commantaire'
             ]);

          $post = Post::where('id', $request->input('id_post'))->first();
          if ($post)
          {
             $comment = new Comments();
             $comment->content = $request->input('content');
             $comment->user_id = Auth::user()->id;
             $comment = $post->comments()->save($comment);
             $newComment = Comments::with('user')->whereId($comment->id)->first();
             
              return Response::json([
                 'msg' => 'Coomentaire Enregistrer',
                 'comment' => $newComment
             ], 200);
          }else
          {
              return Response::json([
                  'msg' => 'Votre commentaire n\'a pas ete poster',
                  'like' =>  $newComment
              ], 200);
          }
    }

    /**
     * @param Comments $comment
     * @param Request $request
     * @return mixed
     */
    public function destroyComment(Comments $comment, Request $request)
    {
        $comment = Comments::where('id', $comment->id)->first();
        if ($comment){

            $this->authorize('delete', $comment);

            $comment->delete();
            
            return Response::json([
                'msg' => 'Commentaire supprimé',
            ], 200);
        }else
        {
             abort(404, "Ce commentaire n'existe pas");
        }
    }

    /**
     * @param $post_id
     * @return mixed you like if you have not liked
     */
    public function storeLikes($post_id)
    {
         $post = Post::with('likes')->where('id', $post_id)->first();
         if ($post)
         {
             if(!Auth::user()->haslikePost($post))
             {
                $post->likes()->create(['user_id' => Auth::user()->id]);

                return Response::json([
                    'msg' => 'Like soumis',
                    'post' => $post,
                    'type' => 'like'
                ], 200);
             }else
             {
                 return Response::json([
                     'msg' => 'Vous avez deja aimer',
                     'post' =>  $post,
                     'type' => 'unlike'
                 ], 200);
             }
         }
    }
    
}
