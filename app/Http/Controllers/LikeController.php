<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Biodata;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Like $likes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Like $likes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Like $likes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Like $likes)
    {
        //
    }

    public function singleLike(Request $request){
        $request->validate([
            'sender_user_id' => 'required|integer|min:1|max_digits:10',
            'receiver_user_id' => 'required|integer|min:1|max_digits:10',
            'sender_biodata_code' => 'required|string|min:3|max:20',
            'receiver_biodata_code' => 'required|string|min:3|max:20',
        ]);

        // self like
        if( $request->sender_user_id == $request->receiver_user_id ){
            return __('frontend.modal_messages.self_like_error');
        }

        // sender approval
        $like_sender_biodata = Biodata::where('user_id', $request->sender_user_id)->get();
        if( $like_sender_biodata ){
            if( count( $like_sender_biodata ) == 1 ){
                if( !$like_sender_biodata[0]->is_approved ){
                    return  __('frontend.modal_messages.like_unapproved');
                }
            }
        }

        // receiver approval
        $like_receiver_biodata = Biodata::where('user_id', $request->receiver_user_id)->get();
        if( $like_receiver_biodata ){
            if( count( $like_receiver_biodata ) == 1 ){
                if( !$like_receiver_biodata[0]->is_approved ){
                    return  __('frontend.modal_messages.receiver_like_unapproved');
                }
            }
        }

        // both male
        if( $like_sender_biodata[0]->gender == 'male' && $like_receiver_biodata[0]->gender == 'male' ){
            return  __('frontend.modal_messages.same_gender_like_male');
        }

        // both female
        if( $like_sender_biodata[0]->gender == 'female' && $like_receiver_biodata[0]->gender == 'female' ){
            return  __('frontend.modal_messages.same_gender_like_female');
        }


        $single_like = Like::where('sender_user_id', $request->sender_user_id)
        ->where('receiver_user_id', $request->receiver_user_id)
        ->get();

        if( $single_like ){
            if( count($single_like) == 1 ){
                $single_like = Like::where('sender_user_id', $request->sender_user_id)
                ->where('receiver_user_id', $request->receiver_user_id)->update([
                    'like_deleted' => false,
                ]);
                return true;
            }
        }

        $single_like = new Like();
        $single_like->sender_user_id = $request->sender_user_id;
        $single_like->receiver_user_id = $request->receiver_user_id;
        $single_like->sender_biodata_code = $request->sender_biodata_code;
        $single_like->receiver_biodata_code = $request->receiver_biodata_code;
        $single_like->save();
        return true;

    }


    public function singleDisLike(Request $request){
        $request->validate([
            'sender_user_id' => 'required|integer|min:1|max_digits:10',
            'receiver_user_id' => 'required|integer|min:1|max_digits:10',
            'sender_biodata_code' => 'required|string|min:3|max:20',
            'receiver_biodata_code' => 'required|string|min:3|max:20',
        ]);

        $single_dislike = Like::where('sender_user_id', $request->sender_user_id)
        ->where('receiver_user_id', $request->receiver_user_id)
        ->delete();

        return $single_dislike;

    }



}
