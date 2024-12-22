<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biodata;

class BiodataController extends Controller
{
    /**
     * Show the form for creating the resource.
     */
    public function create(): never
    {
        abort(404);
    }

    /**
     * Store the newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the resource.
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the resource from storage.
     */
    public function destroy(): never
    {
        abort(404);
    }


    public function getSingleBiodata(string $user_id){
        $biodata = Biodata::where('user_id', $user_id)->get();
        return $biodata;
    }


    public function updateMediaAgreement(Request $request)
    {
        $request->validate([
            'user_id' => 'required|int',
            'media_agreement' => 'required|boolean',
        ]);
        $biodata = Biodata::where('user_id', $request->user_id)->get();
        if ($request->media_agreement){
            if( count($biodata) == 1 ){
                $biodata = Biodata::where('user_id', $request->user_id)->update([
                    'media_agreement' => $request->media_agreement,
                ]);
                return true;
            }
            elseif( count($biodata) > 1 ){
                return false;
            }
            else{
                $biodata = new Biodata();
                $biodata->user_id = $request->user_id;
                $biodata->media_agreement = $request->media_agreement;
                $biodata->save();
                return true;
            }
        }
        return false;
    }


    public function updateGender(Request $request)
    {
        $request->validate([
            'user_id' => 'required|int',
            'gender' => 'required|string|max:10',
        ]);
        $biodata = Biodata::where('user_id', $request->user_id)->get();
        if ($request->gender){
            if( count($biodata) == 1 ){
                $biodata = Biodata::where('user_id', $request->user_id)->update([
                    'gender' => $request->gender,
                ]);
                return true;
            }
            elseif( count($biodata) > 1 ){
                return false;
            }
        }
        return false;
    }


    public function updatePersonalBiodata(Request $request){

        $request->validate([
            'user_id' => 'required|int',
            'running_tab' => 'required|int|max:6',
            'birth_date' => 'required|date',
            'skin_color' => 'required|string|max:20',
            'height' => 'required|string|max:20',
            'weight' => 'required|string|max:20',
            'blood_group' => 'required|string|max:10',
            'maritial_status' => 'required|string|max:20',
            'permanent_country' => 'required|string|max:20',
            'permanent_division' => 'required|string|max:20',
            'permanent_district' => 'required|string|max:20',
            'permanent_upazila' => 'required|string|max:30',
            'permanent_post_office' => 'required|string|max:40',
            'permanent_post_code' => 'required|string|max:6',
            'address_same' => 'boolean',
            'temporary_country' => 'required|string|max:20',
            'temporary_division' => 'required|string|max:20',
            'temporary_district' => 'required|string|max:20',
            'temporary_upazila' => 'required|string|max:30',
            'temporary_post_office' => 'required|string|max:40',
            'temporary_post_code' => 'required|string|max:6',
            'job_title' => 'required|string|max:100',
            'job_details' => 'required|string|min:10|max:200',
            'medium_of_study' => 'required|string|min:10|max:100',
        ]);
        $retrieved_biodata = Biodata::where('user_id', $request->user_id)->get();
        if( count($retrieved_biodata) == 1 ){
            $biodata_update = Biodata::where('user_id', $request->user_id)->update([
                'birth_date' => $request->birth_date,
                'skin_color' => $request->skin_color,
                'height' => $request->height,
                'weight' => $request->weight,
                'blood_group' => $request->blood_group,
                'maritial_status' => $request->maritial_status,
                'permanent_country' => $request->permanent_country,
                'permanent_division' => $request->permanent_division,
                'permanent_district' => $request->permanent_district,
                'permanent_upazila' => $request->permanent_upazila,
                'permanent_post_office' => $request->permanent_post_office,
                'permanent_post_code' => $request->permanent_post_code,
                'address_same' => $request->address_same,
                'temporary_country' => $request->temporary_country,
                'temporary_division' => $request->temporary_division,
                'temporary_district' => $request->temporary_district,
                'temporary_upazila' => $request->temporary_upazila,
                'temporary_post_office' => $request->temporary_post_office,
                'temporary_post_code' => $request->temporary_post_code,
                'job_title' => $request->job_title,
                'job_details' => $request->job_details,
                'medium_of_study' => $request->medium_of_study,
            ]);
            if($biodata_update){
                $retrieved_biodata = $retrieved_biodata[0];
                if( $retrieved_biodata->running_tab < $request->running_tab ){
                    $biodata_update = Biodata::where('user_id', $request->user_id)->update([
                        'running_tab' => $request->running_tab,
                    ]);
                }
                return redirect()->back()->with('success', __('frontend.flush_messages.personal_biodata_onsave'));
            }
        }
        return redirect()->back()->with('error',  __('frontend.flush_messages.personal_biodata_onerror'));
    }


}
