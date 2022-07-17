<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\User;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        //todo check if user is allowed to retrieve all subscription
        return response()->json(['status'=>true,'data'=>Subscription::all()]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        //userid here is not suppose to be filled it suppose to be retrieve from login user
        $request->validate([
            'userid' => 'required|integer',
            'web_id' => 'required|integer'
        ]);

        //this validate user id
        $user = User::query()->find($request->get('userid'));
        $web_id =(int)$request->get('web_id');


        if($user==null || !$user->exists() || $web_id<=0 ){
            return response()->json(['status'=>false]);
        }

        //todo remove email and retrieve from user table
        $newSubscription = new Subscription([
            'userid' => $user->id,
            'web_id' => $web_id
        ]);

        $newSubscription->save();

        return response()->json(['status'=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $subscription = Subscription::findOrFail($id);
        return response()->json($subscription);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $subscription = Subscription::findOrFail($id);

        return response()->json($subscription->delete());
    }
}
