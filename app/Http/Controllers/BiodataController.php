<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biodata;
use App\Models\BiodataUpdate;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Http\Controllers\MailController;


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


    public function updateHideBiodata(Request $request)
    {
        $request->validate([
            'user_id' => 'required|int',
            'hide_biodata' => 'required|boolean',
        ]);
        $biodata = Biodata::where('user_id', $request->user_id)->get();
        if( count($biodata) == 1 ){
            $biodata = Biodata::where('user_id', $request->user_id)->update([
                'hide_biodata' => $request->hide_biodata,
            ]);
            return true;
        }
        elseif( count($biodata) > 1 ){
            return false;
        }
        return false;
    }


    public function updateMediaAgreement(Request $request)
    {
        $request->validate([
            'user_id' => 'required|int',
            'media_agreement' => 'required|boolean',
            'user_mobile' => 'nullable|regex:/(01)[0-9]{9}/|max:11',
            'user_email' => 'nullable|email|max:50',
        ]);
        $biodata = Biodata::where('user_id', $request->user_id)->get();
        if ($request->media_agreement){
            if( count($biodata) == 1 ){
                $biodata = Biodata::where('user_id', $request->user_id)->update([
                    'media_agreement' => $request->media_agreement,
                    'user_mobile' => $request->user_mobile,
                    'user_email' => $request->user_email,
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
                $biodata->biodata_code = mt_rand(100000,999999) . '-' . uniqid();
                $biodata->user_mobile = $request->user_mobile;
                $biodata->user_email = $request->user_email;
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
            'editRequest' => 'nullable|boolean',
        ]);

        // initializing
        $biodata_class = \App\Models\Biodata::class;

        if( $request->editRequest ){
            $biodata_class = \App\Models\BiodataUpdate::class;
        }

        $biodata = $biodata_class::where('user_id', $request->user_id)->get();
        if ($request->gender){
            if( count($biodata) == 1 ){
                $retrieved_biodata = $biodata[0];
                $maritial_status = $retrieved_biodata->maritial_status;
                $job_title = $retrieved_biodata->job_title;
                $deserved_job_titles = $retrieved_biodata->deserved_job_titles;
                $deserved_maritial_statuses = $retrieved_biodata->deserved_maritial_statuses;

                //modifying job_title
                if( $job_title ){
                    if( $request->gender == 'female' ){
                        $job_title = str_replace( "শিক্ষক", "শিক্ষিকা", $job_title );
                    }
                    elseif( $request->gender == 'male' ){
                        $job_title = str_replace( "শিক্ষিকা", "শিক্ষক", $job_title );
                    }
                }
                //modifying job_title ends

                //modifying maritial_status
                if( $maritial_status ){
                    if( $request->gender == 'female' && $maritial_status == 'widower_no_child' ){
                        $maritial_status = 'widow_no_child';
                    }
                    elseif( $request->gender == 'female' && $maritial_status == 'widower_with_child' ){
                        $maritial_status = 'widow_with_child';
                    }
                    elseif( $request->gender == 'male' && $maritial_status == 'widow_no_child' ){
                        $maritial_status = 'widower_no_child';
                    }
                    elseif( $request->gender == 'male' && $maritial_status == 'widow_with_child' ){
                        $maritial_status = 'widower_with_child';
                    }
                }
                //modifying maritial_status ends here

                //modifying deserved_job_titles
                if( $deserved_job_titles ){
                    if( $request->gender == 'male' ){
                        $deserved_job_titles = str_replace( "শিক্ষক", "শিক্ষিকা", $deserved_job_titles );
                    }
                    elseif( $request->gender == 'female' ){
                        $deserved_job_titles = str_replace( "শিক্ষিকা", "শিক্ষক", $deserved_job_titles );
                    }
                }
                //modifying deserved_job_titles ends here

                //modifying deserved_maritial_statuses
                if( $deserved_maritial_statuses ){
                    if( $request->gender == 'male' && str_contains($deserved_maritial_statuses, 'widower_no_child') || str_contains($deserved_maritial_statuses, 'widower_with_child') ){
                        $deserved_maritial_statuses = str_replace( "widower_no_child", "widow_no_child", $deserved_maritial_statuses );
                        $deserved_maritial_statuses = str_replace( "widower_with_child", "widow_with_child", $deserved_maritial_statuses );
                    }
                    elseif( $request->gender == 'female' && str_contains($deserved_maritial_statuses, 'widow_no_child') || str_contains($deserved_maritial_statuses, 'widow_with_child') ){
                        $deserved_maritial_statuses = str_replace( "widow_no_child", "widower_no_child", $deserved_maritial_statuses );
                        $deserved_maritial_statuses = str_replace( "widow_with_child", "widower_with_child", $deserved_maritial_statuses );
                    }
                }
                //modifying deserved_maritial_statuses ends here

                // updating biodata
                $updated_biodata = $biodata_class::where('user_id', $request->user_id)->update([
                    'gender' => $request->gender,
                    'maritial_status' =>  $maritial_status,
                    'job_title' =>  $job_title,
                    'deserved_job_titles' =>  $deserved_job_titles,
                    'deserved_maritial_statuses' =>  $deserved_maritial_statuses,
                ]);
                // if succeed
                if( $updated_biodata ){
                    $biodata = $biodata_class::where('user_id', $request->user_id)->get();
                    return $biodata[0];
                }
            }
            elseif( count($biodata) > 1 ){
                return false;
            }
        }
        return false;
    }




    public function updateSingleItems(Request $request)
    {
        $request->validate([
            'user_id' => 'required|int',
            'birth_date' => 'nullable|date',
            'skin_color' => 'nullable|string|max:20',
            'height' => 'nullable|string|max:20',
            'weight' => 'nullable|string|max:20',
            'blood_group' => 'nullable|string|max:10',
            'maritial_status' => 'nullable|string|max:20',
            'permanent_country' => 'nullable|string|max:20',
            'permanent_division' => 'nullable|string|max:20',
            'permanent_district' => 'nullable|string|max:20',
            'permanent_upazila' => 'nullable|string|max:30',
            'permanent_union_parishad' => 'nullable|string|max:40',
            'temporary_country' => 'nullable|string|max:20',
            'temporary_division' => 'nullable|string|max:20',
            'temporary_district' => 'nullable|string|max:20',
            'temporary_upazila' => 'nullable|string|max:30',
            'temporary_union_parishad' => 'nullable|string|max:40',
            'job_title' => 'nullable|min:2|max:100',
            'job_details' => 'nullable|string|max:500',
            'job_location' => 'nullable|string|max:100',
            'monthly_income' => 'nullable|string|max:20',
            'medium_of_study' => 'nullable|string|max:100',
            'general_highest_degree' => 'nullable|string|max:50',
            'aliya_highest_degree' => 'nullable|string|max:50',
            'kowmi_highest_degree' => 'nullable|string|max:50',
            'study_others_highest_degree' => 'nullable|string|max:50',
            'study_in_details' => 'nullable|string|max:500',
            'editRequest' => 'nullable|boolean',
        ]);

        // initializing
        $biodata_class = \App\Models\Biodata::class;

        if( $request->editRequest ){
            $biodata_class = \App\Models\BiodataUpdate::class;
        }

        $retrieved_biodata = $biodata_class::where('user_id', $request->user_id)->get();

        if( count($retrieved_biodata) == 1 ){
            $biodata = $biodata_class::where('user_id', $request->user_id)->update([
                'birth_date' => $request->birth_date ? $request->birth_date : $retrieved_biodata[0]->birth_date,
                'skin_color' => $request->skin_color ? $request->skin_color : $retrieved_biodata[0]->skin_color,
                'height' => $request->height ? $request->height : $retrieved_biodata[0]->height,
                'weight' => $request->weight ? $request->weight : $retrieved_biodata[0]->weight,
                'blood_group' => $request->blood_group ? $request->blood_group : $retrieved_biodata[0]->blood_group,
                'maritial_status' => $request->maritial_status ? $request->maritial_status : $retrieved_biodata[0]->maritial_status,
                'permanent_country' => $request->permanent_country ? $request->permanent_country : $retrieved_biodata[0]->permanent_country,
                'permanent_division' => $request->permanent_division ? $request->permanent_division : $retrieved_biodata[0]->permanent_division,
                'permanent_district' => $request->permanent_district ? $request->permanent_district : $retrieved_biodata[0]->permanent_district,
                'permanent_upazila' => $request->permanent_upazila ? $request->permanent_upazila : $retrieved_biodata[0]->permanent_upazila,
                'permanent_union_parishad' => $request->permanent_union_parishad ? $request->permanent_union_parishad : $retrieved_biodata[0]->permanent_union_parishad,
                'temporary_country' => $request->temporary_country ? $request->temporary_country : $retrieved_biodata[0]->temporary_country,
                'temporary_division' => $request->temporary_division ? $request->temporary_division : $retrieved_biodata[0]->temporary_division,
                'temporary_district' => $request->temporary_district ? $request->temporary_district : $retrieved_biodata[0]->temporary_district,
                'temporary_upazila' => $request->temporary_upazila ? $request->temporary_upazila : $retrieved_biodata[0]->temporary_upazila,
                'temporary_union_parishad' => $request->temporary_union_parishad ? $request->temporary_union_parishad : $retrieved_biodata[0]->temporary_union_parishad,
                'job_title' => $request->job_title ? $request->job_title : $retrieved_biodata[0]->job_title,
                'job_details' => $request->job_details ? $request->job_details : $retrieved_biodata[0]->job_details,
                'job_location' => $request->job_location ? $request->job_location : $retrieved_biodata[0]->job_location,
                'monthly_income' => $request->monthly_income ? $request->monthly_income : $retrieved_biodata[0]->monthly_income,
                'medium_of_study' => $request->medium_of_study ? $request->medium_of_study : $retrieved_biodata[0]->medium_of_study,
                'general_highest_degree' => $request->general_highest_degree ? $request->general_highest_degree : $retrieved_biodata[0]->general_highest_degree,
                'aliya_highest_degree' => $request->aliya_highest_degree ? $request->aliya_highest_degree : $retrieved_biodata[0]->aliya_highest_degree,
                'kowmi_highest_degree' => $request->kowmi_highest_degree ? $request->kowmi_highest_degree : $retrieved_biodata[0]->kowmi_highest_degree,
                'study_others_highest_degree' => $request->study_others_highest_degree ? $request->study_others_highest_degree : $retrieved_biodata[0]->study_others_highest_degree,
                'study_in_details' => $request->study_in_details ? $request->study_in_details : $retrieved_biodata[0]->study_in_details,
            ]);
            return true;
        }
        elseif( count($retrieved_biodata) > 1 ){
            return false;
        }
        return false;
    }




    public function updatePersonalBiodata(Request $request){

        $request->validate([
            'user_id' => 'required|int',
            'biodata_completion' => 'required|int|max:100',
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
            'permanent_union_parishad' => 'required|string|max:40',
            'address_same' => 'boolean',
            'temporary_country' => 'required|string|max:20',
            'temporary_division' => 'required|string|max:20',
            'temporary_district' => 'required|string|max:20',
            'temporary_upazila' => 'required|string|max:30',
            'temporary_union_parishad' => 'required|string|max:40',
            'job_title' => 'required|string|min:2|max:100',
            'job_details' => trim($request->job_title) == 'নাই' || trim($request->job_title) == 'None' ? 'nullable|string|min:10|max:500' : 'required|string|min:10|max:500',
            'job_location' => trim($request->job_title) == 'নাই' || trim($request->job_title) == 'None' ? 'nullable|string|min:2|max:100' : 'required|string|min:2|max:100',
            'monthly_income' => trim($request->job_title) == 'নাই' || trim($request->job_title) == 'None' ? 'nullable|string|min:2|max:20' : 'required|string|min:2|max:20',
            'medium_of_study' => 'required|string|min:2|max:100',
            'general_selected' => 'required|boolean',
            'general_highest_degree' => $request->general_selected ? 'required|string|min:2|max:50' : 'nullable|string|min:2|max:50',
            'is_general_honorable_selected' => 'nullable|boolean',
            'aliya_selected' => 'required|boolean',
            'aliya_highest_degree' => $request->aliya_selected ? 'required|string|min:2|max:50' : 'nullable|string|min:2|max:50',
            'is_aliya_honorable_selected' => 'nullable|boolean',
            'kowmi_selected' => 'required|boolean',
            'kowmi_highest_degree' => $request->kowmi_selected ? 'required|string|min:2|max:50' : 'nullable|string|min:2|max:50',
            'is_kowmi_honorable_selected' => 'nullable|boolean',
            'study_others_selected' => 'required|boolean',
            'study_others_highest_degree' => $request->study_others_selected ? 'required|string|min:2|max:50' : 'nullable|string|min:2|max:50',
            'study_in_details' => 'required|string|min:10|max:500',
            'is_honorable_selected' => 'nullable|boolean',
            'honorable_degree_details' => $request->is_honorable_selected ? 'required|string|min:10|max:500' : 'nullable|string|min:10|max:500',
            'honorable_degree_places' => $request->is_honorable_selected ? 'required|string|min:2|max:100' : 'nullable|string|min:2|max:100',
            'editRequest' => 'nullable|boolean',
        ]);

        // initializing
        $biodata_class = \App\Models\Biodata::class;

        if( $request->editRequest ){
            $biodata_class = \App\Models\BiodataUpdate::class;
        }

        $retrieved_biodata = $biodata_class::where('user_id', $request->user_id)->get();

        if( count($retrieved_biodata) == 1 ){
            $biodata_update = $biodata_class::where('user_id', $request->user_id)->update([
                'birth_date' => $request->birth_date,
                'age' => Carbon::parse($request->birth_date)->age,
                'skin_color' => $request->skin_color,
                'height' => $request->height,
                'weight' => $request->weight,
                'blood_group' => $request->blood_group,
                'maritial_status' => $request->maritial_status,
                'permanent_country' => $request->permanent_country,
                'permanent_division' => $request->permanent_division,
                'permanent_district' => $request->permanent_district,
                'permanent_upazila' => $request->permanent_upazila,
                'permanent_union_parishad' => $request->permanent_union_parishad,
                'address_same' => $request->address_same,
                'temporary_country' => $request->temporary_country,
                'temporary_division' => $request->temporary_division,
                'temporary_district' => $request->temporary_district,
                'temporary_upazila' => $request->temporary_upazila,
                'temporary_union_parishad' => $request->temporary_union_parishad,
                'job_title' => $request->job_title,
                'job_details' => $request->job_details,
                'job_location' => $request->job_location,
                'monthly_income' => $request->monthly_income,
                'medium_of_study' => $request->medium_of_study,
                'general_selected' => $request->general_selected,
                'general_highest_degree' => $request->general_highest_degree,
                'is_general_honorable_selected' => $request->is_general_honorable_selected,
                'aliya_selected' => $request->aliya_selected,
                'aliya_highest_degree' => $request->aliya_highest_degree,
                'is_aliya_honorable_selected' => $request->is_aliya_honorable_selected,
                'kowmi_selected' => $request->kowmi_selected,
                'kowmi_highest_degree' => $request->kowmi_highest_degree,
                'is_kowmi_honorable_selected' => $request->is_kowmi_honorable_selected,
                'study_others_selected' => $request->study_others_selected,
                'study_others_highest_degree' => $request->study_others_highest_degree,
                'study_in_details' => $request->study_in_details,
                'is_honorable_selected' => $request->is_honorable_selected,
                'honorable_degree_details' => $request->honorable_degree_details,
                'honorable_degree_places' => $request->honorable_degree_places,
            ]);
            if($biodata_update){
                $retrieved_biodata = $retrieved_biodata[0];
                if( (int)$retrieved_biodata->running_tab < (int)$request->running_tab ){
                    $biodata_update = $biodata_class::where('user_id', $request->user_id)->update([
                        'running_tab' => $request->running_tab,
                    ]);
                }
                if( (int)$retrieved_biodata->biodata_completion < (int)$request->biodata_completion ){
                    $biodata_update = $biodata_class::where('user_id', $request->user_id)->update([
                        'biodata_completion' => $request->biodata_completion,
                    ]);
                }
                return redirect()->back()->with('success', __('frontend.flash_messages.personal_biodata_onsave'));
            }
        }
        return redirect()->back()->with('error',  __('frontend.flash_messages.biodata_onerror'));
    }


    public function updateReligiousBiodata(Request $request){

        $request->validate([
            'user_id' => 'required|int',
            'biodata_completion' => 'required|int|max:100',
            'running_tab' => 'required|int|max:6',
            'five_waqt_salat' => 'required|string|max:30',
            'beard_quantity' => $request->gender == 'male' ? 'required|string|max:30' : 'nullable|string|max:30',
            'pants_worn_style' => $request->gender == 'male' ? 'required|string|max:30' : 'nullable|string|max:30',
            'veiling_style' => 'required|string|max:50',
            'islamic_studies' => 'required|string|max:50',
            'drugs_taken' => 'required|string|max:50',
            'dowry_deserve_male' => $request->gender == 'male' ? 'required|string|max:30' : 'nullable|string|max:30',
            'dowry_deserve_female' => $request->gender == 'female' ? 'required|string|max:30' : 'nullable|string|max:30',
            'akida_majhhab' => 'required|string|max:30',
            'family_islam_maintain' => 'required|string|max:20',
            'three_choosen_alems' => 'required|string|min:10|max:500',
            'physical_weakness' => 'required|boolean',
            'physical_weakness_desc' => $request->physical_weakness ? 'required|string|min:2|max:500' : 'nullable|string|min:2|max:500',
            'good_affairs' => 'required|string|min:10|max:3000',
            'religious_future_plan' => 'required|string|min:10|max:3000',
            'borka_wearing' => $request->gender == 'female' ? 'required|string|max:30' : 'nullable|string|max:30',
            'nikab_with_borka' => $request->gender == 'female' ? 'required|string|max:30' : 'nullable|string|max:30',
            'editRequest' => 'nullable|boolean',
        ]);

        // initializing
        $biodata_class = \App\Models\Biodata::class;

        if( $request->editRequest ){
            $biodata_class = \App\Models\BiodataUpdate::class;
        }

        $retrieved_biodata = $biodata_class::where('user_id', $request->user_id)->get();
        if( count($retrieved_biodata) == 1 ){
            $biodata_update = $biodata_class::where('user_id', $request->user_id)->update([
                'five_waqt_salat' => $request->five_waqt_salat,
                'beard_quantity' => $request->beard_quantity,
                'pants_worn_style' => $request->pants_worn_style,
                'veiling_style' => $request->veiling_style,
                'islamic_studies' => $request->islamic_studies,
                'drugs_taken' => $request->drugs_taken,
                'dowry_deserve_male' => $request->dowry_deserve_male,
                'dowry_deserve_female' => $request->dowry_deserve_female,
                'akida_majhhab' => $request->akida_majhhab,
                'family_islam_maintain' => $request->family_islam_maintain,
                'three_choosen_alems' => $request->three_choosen_alems,
                'physical_weakness' => $request->physical_weakness,
                'physical_weakness_desc' => $request->physical_weakness_desc,
                'good_affairs' => $request->good_affairs,
                'religious_future_plan' => $request->religious_future_plan,
                'borka_wearing' => $request->borka_wearing,
                'nikab_with_borka' => $request->nikab_with_borka,
            ]);
            if($biodata_update){
                $retrieved_biodata = $retrieved_biodata[0];
                if( (int)$retrieved_biodata->running_tab < (int)$request->running_tab ){
                    $biodata_update = $biodata_class::where('user_id', $request->user_id)->update([
                        'running_tab' => $request->running_tab,
                    ]);
                }
                if( (int)$retrieved_biodata->biodata_completion < (int)$request->biodata_completion ){
                    $biodata_update = $biodata_class::where('user_id', $request->user_id)->update([
                        'biodata_completion' => $request->biodata_completion,
                    ]);
                }
                return redirect()->back()->with('success', __('frontend.flash_messages.religious_biodata_onsave'));
            }
        }
        return redirect()->back()->with('error',  __('frontend.flash_messages.biodata_onerror'));
    }


    public function updateFamilyBiodata(Request $request){

        $request->validate([
            'user_id' => 'required|int',
            'biodata_completion' => 'required|int|max:100',
            'running_tab' => 'required|int|max:6',
            'father_name' => 'required|string|min:2|max:50',
            'father_desc' => 'required|string|min:10|max:300',
            'mother_name' => 'required|string|min:2|max:50',
            'mother_desc' => 'required|string|min:10|max:300',
            'brother_sister_desc' => 'required|string|min:10|max:3000',
            'relative_desc' => 'required|string|min:10|max:3000',
            'family_condition' => 'required|string|min:4|max:30',
            'property_and_income' => 'required|string|min:10|max:1500',
            'personal_maritial_agreement' => 'required|boolean',
            'family_maritial_agreement' => 'required|boolean',
            'editRequest' => 'nullable|boolean',
        ]);

        // initializing
        $biodata_class = \App\Models\Biodata::class;

        if( $request->editRequest ){
            $biodata_class = \App\Models\BiodataUpdate::class;
        }

        $retrieved_biodata = $biodata_class::where('user_id', $request->user_id)->get();
        if( count($retrieved_biodata) == 1 ){
            $biodata_update = $biodata_class::where('user_id', $request->user_id)->update([
                'father_name' => $request->father_name,
                'father_desc' => $request->father_desc,
                'mother_name' => $request->mother_name,
                'mother_desc' => $request->mother_desc,
                'brother_sister_desc' => $request->brother_sister_desc,
                'relative_desc' => $request->relative_desc,
                'family_condition' => $request->family_condition,
                'property_and_income' => $request->property_and_income,
                'personal_maritial_agreement' => $request->personal_maritial_agreement,
                'family_maritial_agreement' => $request->family_maritial_agreement,
            ]);
            if($biodata_update){
                $retrieved_biodata = $retrieved_biodata[0];
                if( (int)$retrieved_biodata->running_tab < (int)$request->running_tab ){
                    $biodata_update = $biodata_class::where('user_id', $request->user_id)->update([
                        'running_tab' => $request->running_tab,
                    ]);
                }
                if( (int)$retrieved_biodata->biodata_completion < (int)$request->biodata_completion ){
                    $biodata_update = $biodata_class::where('user_id', $request->user_id)->update([
                        'biodata_completion' => $request->biodata_completion,
                    ]);
                }
                return redirect()->back()->with('success', __('frontend.flash_messages.family_biodata_onsave'));
            }
        }
        return redirect()->back()->with('error',  __('frontend.flash_messages.biodata_onerror'));
    }


    public function updateDeservedBiodata(Request $request){

        $request->validate([
            'user_id' => 'required|int',
            'biodata_completion' => 'required|int|max:100',
            'running_tab' => 'required|int|max:6',
            'deserved_districts' => 'required|string|min:2|max:700',
            'deserved_age_range' => 'required|string|min:2|max:20',
            'deserved_skin_colors' => 'required|string|min:2|max:200',
            'deserved_height_range' => 'required|string|min:2|max:30',
            'deserved_akida_majhhabs' => 'required|string|min:2|max:200',
            'deserved_family_conditions' => 'required|string|min:2|max:200',
            'deserved_job_titles' => 'required|string|min:2|max:300',
            'deserved_education_mediums' => 'required|string|min:2|max:200',
            'deserved_general_selected' => 'required|boolean',
            'deserved_general_degrees' => $request->deserved_general_selected ? 'required|string|min:2|max:500' : 'nullable|string|min:2|max:500',
            'deserved_aliya_selected' => 'required|boolean',
            'deserved_aliya_degrees' => $request->deserved_aliya_selected ? 'required|string|min:2|max:500' : 'nullable|string|min:2|max:500',
            'deserved_kowmi_selected' => 'required|boolean',
            'deserved_kowmi_degrees' => $request->deserved_kowmi_selected ? 'required|string|min:2|max:500' : 'nullable|string|min:2|max:500',
            'deserved_study_others_selected' => 'required|boolean',
            'deserved_study_others_degrees' => $request->deserved_study_others_selected ? 'required|string|min:2|max:500' : 'nullable|string|min:2|max:500',
            'deserved_maritial_statuses' => 'required|string|min:2|max:200',
            'deserved_conditions' => 'required|string|min:2|max:500',
            'deserved_others_desc' => 'required|string|min:2|max:3000',
            'editRequest' => 'nullable|boolean',
        ]);

        // initializing
        $biodata_class = \App\Models\Biodata::class;

        if( $request->editRequest ){
            $biodata_class = \App\Models\BiodataUpdate::class;
        }

        $retrieved_biodata = $biodata_class::where('user_id', $request->user_id)->get();
        if( count($retrieved_biodata) == 1 ){
            $biodata_update = $biodata_class::where('user_id', $request->user_id)->update([
                'deserved_districts' => $request->deserved_districts,
                'deserved_age_range' => $request->deserved_age_range,
                'deserved_skin_colors' => $request->deserved_skin_colors,
                'deserved_height_range' => $request->deserved_height_range,
                'deserved_akida_majhhabs' => $request->deserved_akida_majhhabs,
                'deserved_family_conditions' => $request->deserved_family_conditions,
                'deserved_job_titles' => $request->deserved_job_titles,
                'deserved_education_mediums' => $request->deserved_education_mediums,
                'deserved_general_selected' => $request->deserved_general_selected,
                'deserved_general_degrees' => $request->deserved_general_degrees,
                'deserved_aliya_selected' => $request->deserved_aliya_selected,
                'deserved_aliya_degrees' => $request->deserved_aliya_degrees,
                'deserved_kowmi_selected' => $request->deserved_kowmi_selected,
                'deserved_kowmi_degrees' => $request->deserved_kowmi_degrees,
                'deserved_study_others_selected' => $request->deserved_study_others_selected,
                'deserved_study_others_degrees' => $request->deserved_study_others_degrees,
                'deserved_maritial_statuses' => $request->deserved_maritial_statuses,
                'deserved_conditions' => $request->deserved_conditions,
                'deserved_others_desc' => $request->deserved_others_desc,
            ]);
            if($biodata_update){
                $retrieved_biodata = $retrieved_biodata[0];
                if( (int)$retrieved_biodata->running_tab < (int)$request->running_tab ){
                    $biodata_update = $biodata_class::where('user_id', $request->user_id)->update([
                        'running_tab' => $request->running_tab,
                    ]);
                }
                if( (int)$retrieved_biodata->biodata_completion < (int)$request->biodata_completion ){
                    $biodata_update = $biodata_class::where('user_id', $request->user_id)->update([
                        'biodata_completion' => $request->biodata_completion,
                    ]);
                }
                return redirect()->back()->with('success', __('frontend.flash_messages.deserved_biodata_onsave'));
            }
        }
        return redirect()->back()->with('error',  __('frontend.flash_messages.biodata_onerror'));
    }


    public function updateOthersBiodata(Request $request){

        $request->validate([
            'user_id' => 'required|int',
            'biodata_completion' => 'required|int|max:100',
            'running_tab' => 'required|int|max:6',
            'form_holder_desc' => 'required|string|min:10|max:500',
            'male_guardian_desc' => 'required|string|min:10|max:500',
            'male_guardian_agreement' => 'accepted',
            'deserved_money_pay' => 'required|string|min:2|max:50',
            'media_terms_one_agreement' => 'accepted',
            'hundred_money_pay' => 'accepted',
            'three_hundred_money_pay' => 'accepted',
            'media_terms_two_agreement' => 'accepted',
            'reference_code' => 'nullable|string|min:2|max:50',
            'editRequest' => 'nullable|boolean',
        ]);

        // initializing
        $biodata_class = \App\Models\Biodata::class;

        if( $request->editRequest ){
            $biodata_class = \App\Models\BiodataUpdate::class;
        }

        $retrieved_biodata = $biodata_class::where('user_id', $request->user_id)->get();
        if( count($retrieved_biodata) == 1 ){
            $biodata_update = $biodata_class::where('user_id', $request->user_id)->update([
                'form_holder_desc' => $request->form_holder_desc,
                'male_guardian_desc' => $request->male_guardian_desc,
                'male_guardian_agreement' => $request->male_guardian_agreement,
                'deserved_money_pay' => $request->deserved_money_pay,
                'media_terms_one_agreement' => $request->media_terms_one_agreement,
                'hundred_money_pay' => $request->hundred_money_pay,
                'three_hundred_money_pay' => $request->three_hundred_money_pay,
                'media_terms_two_agreement' => $request->media_terms_two_agreement,
                'reference_code' => $request->reference_code,
            ]);
            if($biodata_update){
                $retrieved_biodata = $retrieved_biodata[0];
                if( (int)$retrieved_biodata->running_tab < (int)$request->running_tab ){
                    $biodata_update = $biodata_class::where('user_id', $request->user_id)->update([
                        'running_tab' => $request->running_tab,
                    ]);
                }
                if( (int)$retrieved_biodata->biodata_completion < (int)$request->biodata_completion ){
                    $biodata_update = $biodata_class::where('user_id', $request->user_id)->update([
                        'biodata_completion' => $request->biodata_completion,
                    ]);
                }
                return redirect()->back()->with('success', __('frontend.flash_messages.others_biodata_onsave'));
            }
        }
        return redirect()->back()->with('error',  __('frontend.flash_messages.biodata_onerror'));
    }


    public function onClickPermanentDeleteUser(Request $request)
    {

        $request->validate([
            'user_id' => 'required|integer|min:1|max_digits:10',
        ]);

        $biodata = Biodata::where('user_id', $request->user_id)->delete();

        return $biodata;

    }




    // backend starts here
    public function updateIsApprovedSingle(Request $request)
    {

        $request->validate([
            'user_id' => 'required|integer|min:1|max_digits:10',
            'is_approved' => 'required|boolean',
        ]);

        $biodata = Biodata::where('user_id', $request->user_id)->get();

        if( count($biodata) == 1 ){
            $biodata = Biodata::where('user_id', $request->user_id)->update([
                'is_approved' => $request->is_approved,
                'approved_date' => $request->is_approved && !$biodata[0]->approved_date ? Carbon::now()->format('Y-m-d') : $biodata[0]->approved_date,
                'in_admin_trash' => $request->is_approved && $biodata[0]->in_admin_trash ? false : $biodata[0]->in_admin_trash,
            ]);

            // sending email notification
            if( $biodata[0]->user_email ){
                $request = new Request([
                    'name' => $biodata[0]->biodata_code,
                    'email' => $biodata[0]->user_email,
                    'subject' => str_replace(':biodata_code', $biodata[0]->biodata_code, __('frontend.email_notifications.biodata_approve_subject')),
                    'message' => str_replace(':biodata_code', $biodata[0]->biodata_code, __('frontend.email_notifications.biodata_approve_body')),
                ]);
                $mailController = new MailController();
                $mailController->generalNotifications($request);
            }

        }

        return Biodata::all();

    }


    public function updateIsApprovedMultiple(Request $request)
    {

        $request->validate([
            'user_ids' => 'required|array',
            'is_approved' => 'required|boolean',
        ]);

        foreach ($request->user_ids as $user_id_key => $single_user_id) {

            $biodata = Biodata::where('user_id', $single_user_id)->get();

            if( count($biodata) == 1 ){
                $biodata = Biodata::where('user_id', $single_user_id)->update([
                    'is_approved' => $request->is_approved,
                    'approved_date' => $request->is_approved && !$biodata[0]->approved_date ? Carbon::now()->format('Y-m-d') : $biodata[0]->approved_date,
                ]);

                // sending email notification
                if( $biodata[0]->user_email ){
                    $request = new Request([
                        'name' => $biodata[0]->biodata_code,
                        'email' => $biodata[0]->user_email,
                        'subject' => str_replace(':biodata_code', $biodata[0]->biodata_code, __('frontend.email_notifications.biodata_approve_subject')),
                        'message' => str_replace(':biodata_code', $biodata[0]->biodata_code, __('frontend.email_notifications.biodata_approve_body')),
                    ]);
                    $mailController = new MailController();
                    $mailController->generalNotifications($request);
                }

            }

        }

        return Biodata::all();

    }


    public function updateInTrashMultiple(Request $request)
    {

        $request->validate([
            'user_ids' => 'required|array',
            'in_admin_trash' => 'required|boolean',
        ]);

        foreach ($request->user_ids as $user_id_key => $single_user_id) {

            $biodata = Biodata::where('user_id', $single_user_id)->get();

            if( count($biodata) == 1 ){
                $biodata = Biodata::where('user_id', $single_user_id)->update([
                    'is_approved' => $request->in_admin_trash ? false : $biodata[0]->is_approved,
                    'in_admin_trash' => $request->in_admin_trash,
                ]);
            }

        }

        return Biodata::all();

    }


    public function updateInTrashSingle(Request $request)
    {

        $request->validate([
            'user_id' => 'required|integer|min:1|max_digits:10',
            'in_admin_trash' => 'required|boolean',
        ]);

        $biodata = Biodata::where('user_id', $request->user_id)->get();

        if( count($biodata) == 1 ){
            $biodata = Biodata::where('user_id', $request->user_id)->update([
                'is_approved' => $request->in_admin_trash ? false : $biodata[0]->is_approved,
                'in_admin_trash' => $request->in_admin_trash,
            ]);
        }

        return Biodata::all();

    }


    public function onClickPermanentDelete(Request $request)
    {

        $request->validate([
            'user_id' => 'required|integer|min:1|max_digits:10',
        ]);

        $biodata = Biodata::where('user_id', $request->user_id)->delete();

        return Biodata::all();

    }


    public function takeAction(Request $request)
    {

        $request->validate([
            'biodata_code' => [
                'required',
                'string',
                'min:3',
                'max:20',
                Rule::unique('biodatas', 'biodata_code')->ignore($request->user_id, 'user_id'),
            ],
            'free_biodata' => 'required|boolean',
            'biodata_categories' => 'nullable|string|min:4|max:100',
            'biodata_restrictions' => 'nullable|string|min:4|max:200',
            'daily_free' => 'required|int|min:0|max:127',
            'biodata_package' => 'required|int|min:0|max:32767',
            'username' => [
                'required',
                'string',
                'min:4',
                'max:50',
                Rule::unique('biodatas', 'user_email')->ignore($request->user_id, 'user_id'),
                Rule::unique('biodatas', 'user_mobile')->ignore($request->user_id, 'user_id'),
                Rule::unique('users', 'email')->ignore($request->user_id, 'id'),
                Rule::unique('users', 'mobile')->ignore($request->user_id, 'id'),
            ],
            'password' => ['nullable', 'string', Rules\Password::defaults()->min(6)->max(20)],
            'is_approved' => 'required|boolean',
            'user_id' => 'required|integer|min:1|max_digits:10',
            'admin_comment' => 'nullable|string|min:1|max:250',
        ]);

        $biodata = Biodata::where('user_id', trim($request->user_id))->get();

        if( count($biodata) == 1 ){
            $biodata_update = Biodata::where('user_id', trim($request->user_id))->update([
                'user_id' => $request->user_id,
                'is_approved' => $request->is_approved,
                'approved_date' => $request->is_approved && !$biodata[0]->approved_date ? Carbon::now()->format('Y-m-d') : $biodata[0]->approved_date,
                'user_mobile' => !filter_var($request->username, FILTER_VALIDATE_EMAIL) ? $request->username : $biodata[0]->user_mobile,
                'user_email' => filter_var($request->username, FILTER_VALIDATE_EMAIL) ? $request->username : $biodata[0]->user_email,
                'biodata_package' => $request->biodata_package,
                'daily_free' => $request->daily_free,
                'biodata_restrictions' => $request->biodata_restrictions,
                'biodata_categories' => $request->biodata_categories,
                'free_biodata' => $request->free_biodata,
                'biodata_code' => $request->biodata_code,
                'admin_comment' => $request->admin_comment,
            ]);

            if( $biodata_update ){

                $user = User::where('id', trim($request->user_id))->get();

                if( count($user) == 1 ){

                    $user = User::where('id',  trim($request->user_id))->update([
                        'email' => filter_var($request->username, FILTER_VALIDATE_EMAIL) ? $request->username : $user[0]->email,
                        'mobile' => !filter_var($request->username, FILTER_VALIDATE_EMAIL) ? $request->username : $user[0]->mobile,
                        'password' => !$request->password || $request->password == '' ? $user[0]->password : Hash::make($request->password),
                    ]);
                    if( $user ){

                        // sending email notification
                        if( $request->is_approved && !$biodata[0]->is_approved ){
                            if( $biodata[0]->user_email ){
                                $request = new Request([
                                    'name' => $biodata[0]->biodata_code,
                                    'email' => $biodata[0]->user_email,
                                    'subject' => str_replace(':biodata_code', $biodata[0]->biodata_code, __('frontend.email_notifications.biodata_approve_subject')),
                                    'message' => str_replace(':biodata_code', $biodata[0]->biodata_code, __('frontend.email_notifications.biodata_approve_body')),
                                ]);
                                $mailController = new MailController();
                                $mailController->generalNotifications($request);
                            }
                        }

                        return redirect()->back()->with('success', 'Action Taken Successfully!');
                    }
                }
            }
        }

        return redirect()->back()->with('error', 'Something Went Wrong!');

    }


    public function checkUniqueBiodataCode(Request $request){

        $exists = Biodata::where('biodata_code', $request->biodata_code)
        ->where('user_id', '!=', $request->user_id)
        ->exists();

        if( $exists ){
            return false;
        }

        return true;
    }
    // backend ends here


    public function biodataDuplication(Request $request){
        $request->validate([
            'user_id' => 'required|integer|min:1|max_digits:10',
        ]);

        $biodataUpdate = BiodataUpdate::where('user_id', $request->user_id )->get();
        if( $biodataUpdate ){
            if( count($biodataUpdate) == 1 ){
                return $biodataUpdate[0];
            }
        }

        $biodata = Biodata::where('user_id', $request->user_id )->get();
        if( $biodata ){
            if( count($biodata) == 1 ){
                $newBiodataUpdate = BiodataUpdate::create($biodata[0]->toArray());
                if( $newBiodataUpdate ){
                    return $newBiodataUpdate;
                }
            }
        }

        return false;

    }


    public function onClickEditRequest(Request $request){
        $request->validate([
            'user_id' => 'required|integer|min:1|max_digits:10',
        ]);

        // initializing
        $biodata_array = [];
        $biodataUpdate_array = [];

        $biodata = Biodata::where('user_id', $request->user_id )->get();
        if( $biodata ){
            if( count($biodata) == 1 ){
                $biodata_array = $biodata[0]->toArray();
            }
        }

        $biodataUpdate = BiodataUpdate::where('user_id', $request->user_id )->get();
        if( $biodataUpdate ){
            if( count($biodataUpdate) == 1 ){
                $biodataUpdate_array = $biodataUpdate[0]->toArray();
            }
        }

        // Remove keys
        unset($biodata_array['id'], $biodata_array['in_edit_request'], $biodata_array['in_admin_trash'], $biodata_array['created_at'], $biodata_array['updated_at']);

        unset($biodataUpdate_array['id'], $biodataUpdate_array['in_edit_request'], $biodataUpdate_array['in_admin_trash'], $biodataUpdate_array['created_at'], $biodataUpdate_array['updated_at']);

        if ( $biodata_array == $biodataUpdate_array ) {
            return false;
        }else{
            $biodata_update = Biodata::where('user_id', trim($request->user_id))->update([
                'in_edit_request' => true,
            ]);
            if( $biodata_update ){
                return true;
            }
        }

        return false;

    }


    public function onClickApproveEditRequest(Request $request){
        $request->validate([
            'user_id' => 'required|integer|min:1|max_digits:10',
        ]);

        // initializing
        $biodataUpdate_array = [];

        $biodataUpdate = BiodataUpdate::where('user_id', $request->user_id )->get();
        if( $biodataUpdate ){
            if( count($biodataUpdate) == 1 ){
                $biodataUpdate_array = $biodataUpdate[0]->toArray();
            }
        }

        unset($biodataUpdate_array['id'], $biodataUpdate_array['created_at'], $biodataUpdate_array['updated_at']);

        $biodataUpdate_array['in_edit_request'] = false;

        $biodata = Biodata::where('user_id', $request->user_id )->get();
        if( $biodata ){
            if( count($biodata) == 1 ){
                $biodata_update = Biodata::where('user_id', trim($request->user_id))->update( $biodataUpdate_array );
                if( $biodata_update ){
                    $biodataDelete = BiodataUpdate::where('user_id', $request->user_id )->delete();
                    if( $biodataDelete ){
                        return Biodata::all();
                    }
                }
            }
        }

        return false;

    }


    public function onClickCancelEditRequest(Request $request){
        $request->validate([
            'user_id' => 'required|integer|min:1|max_digits:10',
        ]);

        $biodataDelete = BiodataUpdate::where('user_id', $request->user_id )->delete();
        if( $biodataDelete ){
            $biodata = Biodata::where('user_id', $request->user_id )->update([
                'in_edit_request' => false,
            ]);
            if( $biodata ){
                return Biodata::all();
            }
        }

        return false;

    }


}
