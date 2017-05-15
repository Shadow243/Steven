<?php
/**
 * Created by PhpStorm.
 * User: STEVEN
 * Date: 18/04/2017
 * Time: 10:27
 */

namespace App\Treits;


use App\Models\Freindship;
use Illuminate\Support\Facades\Response;

trait freindable
{
    public function Addfreinds($user_id)
    {
        $user_requested_id = Post::where('id', $user_id)->first();
        if ($user_requested_id)
        {
            $freindship = Freindship::created([
                'requester' => $this->id,
                'user_requested' => $user_requested_id,
        ]);
            return Response::json([
                'msg' => 'Invitation envoyer',
                'content' => $freindship,
            ], 200);

        }else
        {
            return Response::json([
                'msg' => 'Utilisateur introuvable',
            ], 404);

        }

    }

}