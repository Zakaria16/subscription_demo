<?php

namespace App\Http\Controllers\API;

use App\Event\PostPublishEvent;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Website;
use App\Notifications\PostPublished;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Notification;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        //todo check if user is allowed to retrieve all post
        return response()->json(['status'=>true,'data'=>Post::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        //userid here is not suppose to be filled it suppose to be retrieve from login user
        $request->validate([
            'web_id' => 'required|integer',
            'title' => 'required',
            'body' => 'required'
        ]);

        //this validate user id

        $website = Website::find((int)$request->get('web_id'));


        if($website===null || !$website->exists()){
            return response()->json(['status'=>false]);
        }

        //todo remove email and retrieve from user table
        $post = new Post([
            'web_id'=>$website->id,
            'title' => $request->get('title'),
            'body' => $request->get('body'),
        ]);

        $isSaved  = $post->save();
        if($isSaved){

            $subscriptions = $post->website->subscriptions;
            if($subscriptions) {
                $users = $subscriptions->map(function ($subscription) {
                    return $subscription->user;
                });
            }
            if($users!==null && $users->count()>0) {
               event(new PostPublishEvent($users,$post));
            }

        }
        return response()->json(['status'=>$isSaved]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $post = Post::find($id);
        if($post==null || !$post->exists()) {
        return  response()->json(['status'=>false,'data'=>null]);
        }
        return response()->json(['status'=>false,'data'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $request->validate([
            'web_id' => 'required|integer',
            'title' => 'required|text|max:400',
            'body' => 'required'
        ]);

        $post->web_id = $request->get('name');
        $post->title = $request->get('title');
        $post->body = $request->get('body');
        $post->save();

        return response()->json(['status'=>false]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        return response()->json(['status'=>$post->delete()]);
    }
}
