<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Biodata;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MailController;


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


    public function singlePropose(Request $request)
    {

        $request->validate([
            'sender_user_id' => 'required|integer|min:1|max_digits:10',
            'receiver_user_id' => 'required|integer|min:1|max_digits:10',
            'sender_biodata_code' => 'required|string|min:3|max:20',
            'receiver_biodata_code' => 'required|string|min:3|max:20',
        ]);

        // self propose
        if( $request->sender_user_id == $request->receiver_user_id ){
            return response()->json(['message' =>  __('frontend.modal_messages.self_propose_error')]);
        }

        // already proposed
        $already_proposed = Proposal::where('sender_user_id', $request->sender_user_id)
        ->where('receiver_user_id', $request->receiver_user_id)
        ->exists();
        if( $already_proposed ){
            return response()->json(['message' =>  __('frontend.modal_messages.already_proposed')]);
        }

        // already recieved propose
        $already_recieved = Proposal::where('sender_user_id', $request->receiver_user_id)
        ->where('receiver_user_id', $request->sender_user_id)
        ->exists();
        if( $already_recieved ){
            return response()->json(['message' =>  __('frontend.modal_messages.already_propose_received')]);
        }

        // sender approval
        $proposal_sender_free_biodata = null;
        $proposal_sender_biodata = Biodata::where('user_id', $request->sender_user_id)->get();
        if( $proposal_sender_biodata ){
            if( count( $proposal_sender_biodata ) == 1 ){
                if( !$proposal_sender_biodata[0]->is_approved ){
                    return response()->json(['message' =>  __('frontend.modal_messages.proposal_unapproved')]);
                }
                $proposal_sender_free_biodata = $proposal_sender_biodata[0]->free_biodata;
            }
        }

        // receiver approval
        $proposal_receiver_free_biodata = null;
        $proposal_receiver_biodata = Biodata::where('user_id', $request->receiver_user_id)->get();
        if( $proposal_receiver_biodata ){
            if( count( $proposal_receiver_biodata ) == 1 ){
                if( !$proposal_receiver_biodata[0]->is_approved ){
                    return response()->json(['message' =>  __('frontend.modal_messages.proposal_receiver_unapproved')]);
                }
                $proposal_receiver_free_biodata = $proposal_receiver_biodata[0]->free_biodata;
            }
        }

        // both male
        if( $proposal_sender_biodata[0]->gender == 'male' && $proposal_receiver_biodata[0]->gender == 'male' ){
            return response()->json(['message' =>  __('frontend.modal_messages.same_gender_propose_male')]);
        }

        // both female
        if( $proposal_sender_biodata[0]->gender == 'female' && $proposal_receiver_biodata[0]->gender == 'female' ){
            return response()->json(['message' =>  __('frontend.modal_messages.same_gender_propose_female')]);
        }

        // free proposal
        if( $proposal_receiver_free_biodata ){

            // Check if the user has already submitted today
            $single_proposal_today = Proposal::where('sender_user_id', $request->sender_user_id)
            ->where('free_proposal', true)
            ->where('in_trash', false)
            ->whereDate('created_at', Carbon::today())
            ->get();

            if( $single_proposal_today ){
                if( count( $single_proposal_today ) > 0 ){
                    $daily_free = $proposal_sender_biodata[0]->daily_free;
                    if( $daily_free == 1 ){
                        return response()->json(['message' =>  __('frontend.modal_messages.proposal_daily_limit')]);
                    }else{
                        if( count( $single_proposal_today ) == $daily_free || count( $single_proposal_today ) > $daily_free ){
                            return response()->json(['message' =>  __('frontend.modal_messages.proposal_daily_limit')]);
                        }
                    }
                }
            }

            $single_proposal = new Proposal();
            $single_proposal->sender_user_id = $request->sender_user_id;
            $single_proposal->receiver_user_id = $request->receiver_user_id;
            $single_proposal->sender_biodata_code = $request->sender_biodata_code;
            $single_proposal->receiver_biodata_code = $request->receiver_biodata_code;
            $single_proposal->proposal_sent_datetime = Carbon::now();
            $single_proposal->save();

            if( $single_proposal ){

                $self_proposals = [];
                $proposals = Proposal::where('sender_user_id', $request->sender_user_id)
                ->orWhere('receiver_user_id', $request->receiver_user_id)
                ->where('in_trash', false)
                ->get();
                if( $proposals ){
                    if( count( $proposals ) > 0 ){
                        $self_proposals = $proposals;
                    }
                }

                // sending email notification
                if( $proposal_receiver_biodata[0]->user_email ){
                    $request = new Request([
                        'name' => $proposal_sender_biodata[0]->biodata_code,
                        'email' => $proposal_receiver_biodata[0]->user_email,
                        'subject' => str_replace(':biodata_code', $proposal_sender_biodata[0]->biodata_code, __('frontend.email_notifications.propose_receiver_subject')),
                        'message' => str_replace(':biodata_code', $proposal_sender_biodata[0]->biodata_code, __('frontend.email_notifications.propose_receiver_body')),
                    ]);
                    $mailController = new MailController();
                    $mailController->proposalNotifications($request);
                }

                return response()->json([
                    'message' => true,
                    'self_proposals' => $self_proposals,
                ]);
            }

        }else{

            if( $proposal_sender_biodata ){
                if( count($proposal_sender_biodata) == 1 ){
                    if( $proposal_sender_biodata[0]->biodata_package <= 0 ){
                        return redirect(route('user.packages'));
                    }

                    if( $proposal_sender_biodata[0]->biodata_package > 0 ){
                        $updated_package = $proposal_sender_biodata[0]->biodata_package;

                        $single_proposal = new Proposal();
                        $single_proposal->sender_user_id = $request->sender_user_id;
                        $single_proposal->receiver_user_id = $request->receiver_user_id;
                        $single_proposal->sender_biodata_code = $request->sender_biodata_code;
                        $single_proposal->receiver_biodata_code = $request->receiver_biodata_code;
                        $single_proposal->free_proposal = false;
                        $single_proposal->proposal_sent_datetime = Carbon::now();
                        $single_proposal->save();

                        if( $single_proposal ){
                            $updated_package--;
                            $update_biodata = Biodata::where( 'user_id', $request->sender_user_id )->update([
                                'biodata_package' => $updated_package,
                            ]);
                            if( $update_biodata ){

                                $self_proposals = [];
                                $proposals = Proposal::where('sender_user_id', $request->sender_user_id)
                                ->orWhere('receiver_user_id', $request->receiver_user_id)
                                ->where('in_trash', false)
                                ->get();
                                if( $proposals ){
                                    if( count( $proposals ) > 0 ){
                                        $self_proposals = $proposals;
                                    }
                                }

                                // sending email notification
                                if( $proposal_receiver_biodata[0]->user_email ){
                                    $request = new Request([
                                        'name' => $proposal_sender_biodata[0]->biodata_code,
                                        'email' => $proposal_receiver_biodata[0]->user_email,
                                        'subject' => str_replace(':biodata_code', $proposal_sender_biodata[0]->biodata_code, __('frontend.email_notifications.propose_receiver_subject')),
                                        'message' => str_replace(':biodata_code', $proposal_sender_biodata[0]->biodata_code, __('frontend.email_notifications.propose_receiver_body')),
                                    ]);
                                    $mailController = new MailController();
                                    $mailController->proposalNotifications($request);
                                }

                                return response()->json([
                                    'message' => true,
                                    'self_proposals' => $self_proposals,
                                ]);

                            }
                        }

                    }
                }
            }

        }

        return response()->json(['message' => __('Something went wrong!')]);

    }


    public function singleOppose(Request $request){

        $request->validate([
            'sender_user_id' => 'required|integer|min:1|max_digits:10',
            'receiver_user_id' => 'required|integer|min:1|max_digits:10',
            'sender_biodata_code' => 'required|string|min:3|max:20',
            'proposal_receiver_biodata_code' => 'required|string|min:3|max:20',
        ]);

        $single_oppose = Proposal::where('sender_user_id', $request->sender_user_id)
        ->where('receiver_user_id', $request->receiver_user_id)
        ->delete();

        return $single_oppose;

    }


    public function singleAccept(Request $request){

        $request->validate([
            'sender_user_id' => 'required|integer|min:1|max_digits:10',
            'receiver_user_id' => 'required|integer|min:1|max_digits:10',
            'proposal_accepted' => 'nullable|boolean',
            'proposal_rejected' => 'nullable|boolean',
            'auto_received' => 'nullable|boolean',
            'rejected_by_sender' => 'nullable|boolean',
            'rejected_by_receiver' => 'nullable|boolean',
            'rejected_by_admin' => 'nullable|boolean',
        ]);

        $single_proposal = Proposal::where('sender_user_id', $request->sender_user_id)
        ->where('receiver_user_id', $request->receiver_user_id)
        ->get();

        if( $single_proposal ){
            if( count( $single_proposal ) > 1 ){
                return false;
            }

            $proposal_status = 'Pending';
            if( $request->proposal_accepted ){
                $proposal_status = 'Accepted';
            }
            if( $request->proposal_rejected ){
                $proposal_status = 'Rejected';
            }
            if( $request->auto_received ){
                $proposal_status = 'Auto Received';
            }

            $single_accept = Proposal::where('sender_user_id', $request->sender_user_id)
            ->where('receiver_user_id', $request->receiver_user_id)
            ->update([
                'proposal_accepted' => isset($request->proposal_accepted) ? $request->proposal_accepted : $single_proposal[0]->proposal_accepted,
                'proposal_accepted_datetime' => $request->proposal_accepted ? Carbon::now() : $single_proposal[0]->proposal_accepted_datetime,
                'proposal_rejected' => isset($request->proposal_rejected) ? $request->proposal_rejected : $single_proposal[0]->proposal_rejected,
                'proposal_rejected_datetime' => $request->proposal_rejected ? Carbon::now() : $single_proposal[0]->proposal_rejected_datetime,
                'auto_received' => isset($request->auto_received) ? $request->auto_received : $single_proposal[0]->auto_received,
                'auto_received_datetime' => $request->auto_received ? Carbon::now() : $single_proposal[0]->auto_received_datetime,
                'rejected_by_sender' => isset($request->rejected_by_sender) ? $request->rejected_by_sender : $single_proposal[0]->rejected_by_sender,
                'rejected_by_receiver' => isset($request->rejected_by_receiver) ? $request->rejected_by_receiver : $single_proposal[0]->rejected_by_receiver,
                'rejected_by_admin' => isset($request->rejected_by_admin) ? $request->rejected_by_admin : $single_proposal[0]->rejected_by_admin,
                'proposal_status' => $proposal_status,
            ]);

        }

        // get their biodatas
        $proposal_receiver_biodata = Biodata::where('user_id', $request->receiver_user_id)->get();
        $proposal_sender_biodata = Biodata::where('user_id', $request->sender_user_id)->get();

        // sending email notification
        if( $proposal_sender_biodata[0]->user_email ){

            if( $request->proposal_accepted ){
                $request = new Request([
                    'name' => $proposal_receiver_biodata[0]->biodata_code,
                    'email' => $proposal_sender_biodata[0]->user_email,
                    'subject' => str_replace(':biodata_code', $proposal_receiver_biodata[0]->biodata_code, __('frontend.email_notifications.propose_accept_sender_subject')),
                    'message' => str_replace(':biodata_code', $proposal_receiver_biodata[0]->biodata_code, __('frontend.email_notifications.propose_accept_sender_body')),
                ]);
            }else{
                $request = new Request([
                    'name' => $proposal_receiver_biodata[0]->biodata_code,
                    'email' => $proposal_sender_biodata[0]->user_email,
                    'subject' => str_replace(':biodata_code', $proposal_receiver_biodata[0]->biodata_code, __('frontend.email_notifications.propose_reject_sender_subject')),
                    'message' => str_replace(':biodata_code', $proposal_receiver_biodata[0]->biodata_code, __('frontend.email_notifications.propose_reject_sender_body')),
                ]);
            }

            $mailController = new MailController();
            $mailController->proposalNotifications($request);
        }

        if( $request->user_page ){
            if (Auth::guard('web')->user()) {
                $user_id = Auth::guard('web')->user()->id;
                return Proposal::where('receiver_user_id', $user_id)
                ->where('in_trash', false)
                ->get();
            }
        }

        return Proposal::all();

    }


    public function singleCancel(Request $request){

        $request->validate([
            'sender_user_id' => 'required|integer|min:1|max_digits:10',
            'receiver_user_id' => 'required|integer|min:1|max_digits:10',
            'free_proposal' => 'required|boolean',
        ]);

        $single_reject = Proposal::where('sender_user_id', $request->sender_user_id)
        ->where('receiver_user_id', $request->receiver_user_id)
        ->where('in_trash', false)
        ->update([
            'in_trash' => true,
            'proposal_status' => 'Canceled',
        ]);

        if(  $single_reject ){
            if( !$request->free_proposal ){
                $proposal_sender_biodata = Biodata::where('user_id', $request->sender_user_id)->get();
                if( $proposal_sender_biodata ){
                    if( count($proposal_sender_biodata) == 1 ){
                        $updated_package = $proposal_sender_biodata[0]->biodata_package;
                        $updated_package++;
                        $update_biodata = Biodata::where( 'user_id', $request->sender_user_id )->update([
                            'biodata_package' => $updated_package,
                        ]);
                    }
                }
            }
        }


        // get their biodatas
        $proposal_receiver_biodata = Biodata::where('user_id', $request->receiver_user_id)->get();
        $proposal_sender_biodata = Biodata::where('user_id', $request->sender_user_id)->get();

        // sending email notification
        if( $proposal_sender_biodata[0]->user_email ){
            $request = new Request([
                'name' => $proposal_receiver_biodata[0]->biodata_code,
                'email' => $proposal_sender_biodata[0]->user_email,
                'subject' => str_replace(':biodata_code', $proposal_receiver_biodata[0]->biodata_code, __('frontend.email_notifications.propose_reject_sender_subject')),
                'message' => str_replace(':biodata_code', $proposal_receiver_biodata[0]->biodata_code, __('frontend.email_notifications.propose_reject_sender_body')),
            ]);
            $mailController = new MailController();
            $mailController->proposalNotifications($request);
        }

        if( $request->user_page ){
            if (Auth::guard('web')->user()) {
                $user_id = Auth::guard('web')->user()->id;
                return Proposal::where('receiver_user_id', $user_id)
                ->where('in_trash', false)
                ->get();
            }
        }

        return Proposal::all();

    }


}
