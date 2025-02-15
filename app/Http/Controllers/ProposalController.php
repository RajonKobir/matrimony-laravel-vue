<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Biodata;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProposalController extends Controller
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
    public function show(Proposal $proposal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proposal $proposal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proposal $proposal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proposal $proposal)
    {
        //
    }


    public function singlePropose(Request $request){
        $request->validate([
            'sender_user_id' => 'required|integer|min:1|max_digits:10',
            'receiver_user_id' => 'required|integer|min:1|max_digits:10',
            'sender_biodata_code' => 'required|string|min:3|max:20',
            'receiver_biodata_code' => 'required|string|min:3|max:20',
            'both_free' => 'required|boolean',
        ]);


        if( $request->both_free ){

            // Check if the user has already submitted today
            $single_proposal_today = Proposal::where('sender_user_id', $request->sender_user_id)
            ->whereDate('created_at', Carbon::today())
            ->exists();

            if( $single_proposal_today ){
                return false;
            }

            $single_proposal = Proposal::where('sender_user_id', $request->sender_user_id)
            ->where('receiver_user_id', $request->receiver_user_id)
            ->get();

            if( count($single_proposal) == 1 ){
                $single_proposal = Proposal::where('sender_user_id', $request->sender_user_id)
                ->where('receiver_user_id', $request->receiver_user_id)->update([
                    'proposal_deleted' => false,
                ]);
                return true;
            }else{
                $single_proposal = new Proposal();
                $single_proposal->sender_user_id = $request->sender_user_id;
                $single_proposal->receiver_user_id = $request->receiver_user_id;
                $single_proposal->sender_biodata_code = $request->sender_biodata_code;
                $single_proposal->receiver_biodata_code = $request->receiver_biodata_code;
                $single_proposal->proposal_sent_datetime = Carbon::now()->format('Y-m-d h:m:s');
                $single_proposal->save();
                return true;
            }

        }else{

            $proposal_sender_biodata = Biodata::where( 'user_id', $request->sender_user_id )->get();

            if( $proposal_sender_biodata ){
                if( count($proposal_sender_biodata) == 1 ){
                    if( $proposal_sender_biodata[0]->biodata_package ){
                        if( $proposal_sender_biodata[0]->biodata_package > 0 ){
                            $updated_package = $proposal_sender_biodata[0]->biodata_package;

                            $single_proposal = Proposal::where('sender_user_id', $request->sender_user_id)
                            ->where('receiver_user_id', $request->receiver_user_id)
                            ->get();

                            if( count($single_proposal) == 1 ){
                                $single_proposal = Proposal::where('sender_user_id', $request->sender_user_id)
                                ->where('receiver_user_id', $request->receiver_user_id)->update([
                                    'proposal_deleted' => false,
                                ]);
                            }else{
                                $single_proposal = new Proposal();
                                $single_proposal->sender_user_id = $request->sender_user_id;
                                $single_proposal->receiver_user_id = $request->receiver_user_id;
                                $single_proposal->sender_biodata_code = $request->sender_biodata_code;
                                $single_proposal->receiver_biodata_code = $request->receiver_biodata_code;
                                $single_proposal->proposal_sent_datetime = Carbon::now()->format('Y-m-d h:m:s');
                                $single_proposal->save();

                                if( $single_proposal ){
                                    $updated_package--;
                                    $update_biodata = Biodata::where( 'user_id', $request->sender_user_id )->update([
                                        'biodata_package' => $updated_package,
                                    ]);
                                    if( $update_biodata ){
                                        return true;
                                    }
                                }

                            }

                        }
                    }
                }
            }

        }

        return false;

    }


    public function singleOppose(Request $request){

        $request->validate([
            'sender_user_id' => 'required|integer|min:1|max_digits:10',
            'receiver_user_id' => 'required|integer|min:1|max_digits:10',
            'sender_biodata_code' => 'required|string|min:3|max:20',
            'receiver_biodata_code' => 'required|string|min:3|max:20',
        ]);

        $single_oppose = Proposal::where('sender_user_id', $request->sender_user_id)
        ->where('receiver_user_id', $request->receiver_user_id)
        ->delete();

        return $single_oppose;

    }


}
