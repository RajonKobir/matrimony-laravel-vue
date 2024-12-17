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
            'birth_date' => 'required|date',
            'skin_color' => 'required|string|max:20',
            'height' => 'required|string|max:20',
            'weight' => 'required|string|max:20',
            'blood_group' => 'required|string|max:10',
        ]);
        $biodata = Biodata::where('user_id', $request->user_id)->get();
        if( count($biodata) == 1 ){
            $biodata = Biodata::where('user_id', $request->user_id)->update([
                'birth_date' => $request->birth_date,
                'skin_color' => $request->skin_color,
                'height' => $request->height,
                'weight' => $request->weight,
                'blood_group' => $request->blood_group,
            ]);
            if($biodata){
                return redirect()->back()->with('success', __('frontend.flush_messages.personal_biodata_onsave'));
            }
        }
        return redirect()->back()->with('error',  __('frontend.flush_messages.personal_biodata_onerror'));
    }


}
