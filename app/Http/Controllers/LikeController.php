<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;

class LikeController extends Controller
{
    public function addLike(Request $request)
    {
        $memberId = session('memberId');
        $responseId = $request->responseId;
        $alreadyExists = Like::where(['member_id'=> $memberId, 'response_id' => $responseId ])->first();

        if(is_null($alreadyExists)) return $this->insertLikeIntoDB($memberId, $responseId);

        return response()->json([
        'error' => 'Voice already used for this response',

    ]);


    }


    public function addDislike(Request $request)
    {
        $memberId = session('memberId');
        $responseId = $request->responseId;
        $alreadyExists = Like::where(['member_id'=> $memberId, 'response_id' => $responseId ])->first();

        if(is_null($alreadyExists)) return $this->insertDislikeIntoDB($memberId, $responseId);

        return response()->json([
            'error' => 'Voice already used for this response'
            ]);
    }

    private function insertLikeIntoDB($memberId, $responseId)
    {
        $like = new Like();
        $like->member_id = $memberId;
        $like->response_id = $responseId;
        $like->like = '1';
        $like->save();

        $countedLikes = Like::where(['like'=> '1', 'response_id' => $responseId])->count();

        return response()->json([
           'likesNumber'=>$countedLikes
        ]);

    }
    private function insertDislikeIntoDB($memberId, $responseId)
    {
        $like = new Like();
        $like->member_id = $memberId;
        $like->response_id = $responseId;
        $like->dislike = '1';
        $like->save();

        $countedDislikes = Like::where(['dislike'=> '1', 'response_id' => $responseId])->count();

        return response()->json([
            'dislikesNumber'=>$countedDislikes
        ]);

    }



}
