<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biodata;
use Illuminate\Validation\Rule;

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
            'job_details' => trim($request->job_title) == 'নাই' || trim($request->job_title) == 'None' ? 'nullable|string|min:10|max:200' : 'required|string|min:10|max:200',
            'job_location' => trim($request->job_title) == 'নাই' || trim($request->job_title) == 'None' ? 'nullable|string|min:2|max:50' : 'required|string|min:2|max:50',
            'monthly_income' => trim($request->job_title) == 'নাই' || trim($request->job_title) == 'None' ? 'nullable|string|min:2|max:20' : 'required|string|min:2|max:20',
            'medium_of_study' => 'required|string|min:10|max:100',
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
            'study_in_details' => 'required|string|min:10|max:300',
            'is_honorable_selected' => 'nullable|boolean',
            'honorable_degree_details' => $request->is_honorable_selected ? 'required|string|min:10|max:200' : 'nullable|string|min:10|max:200',
            'honorable_degree_place' => $request->is_honorable_selected ? 'required|string|min:10|max:100' : 'nullable|string|min:10|max:100',
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
                'honorable_degree_place' => $request->honorable_degree_place,
            ]);
            if($biodata_update){
                $retrieved_biodata = $retrieved_biodata[0];
                if( (int)$retrieved_biodata->running_tab < (int)$request->running_tab ){
                    $biodata_update = Biodata::where('user_id', $request->user_id)->update([
                        'running_tab' => $request->running_tab,
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
            'three_choosen_alems' => 'required|string|min:10|max:100',
            'physical_weakness' => 'required|boolean',
            'physical_weakness_desc' => $request->physical_weakness ? 'required|string|min:10|max:255' : 'nullable|string|min:10|max:255',
            'good_affairs' => 'required|string|min:10|max:255',
            'religious_future_plan' => 'required|string|min:10|max:255',
            'borka_wearing' => $request->gender == 'female' ? 'required|string|max:30' : 'nullable|string|max:30',
            'nikab_with_borka' => $request->gender == 'female' ? 'required|string|max:30' : 'nullable|string|max:30',
        ]);
        $retrieved_biodata = Biodata::where('user_id', $request->user_id)->get();
        if( count($retrieved_biodata) == 1 ){
            $biodata_update = Biodata::where('user_id', $request->user_id)->update([
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
                    $biodata_update = Biodata::where('user_id', $request->user_id)->update([
                        'running_tab' => $request->running_tab,
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
            'running_tab' => 'required|int|max:6',
            'father_name' => 'required|string|min:2|max:30',
            'father_desc' => 'required|string|min:10|max:255',
            'mother_name' => 'required|string|min:2|max:30',
            'mother_desc' => 'required|string|min:10|max:255',
            'brother_sister_desc' => 'required|string|min:10|max:255',
            'relative_desc' => 'required|string|min:10|max:255',
            'family_condition' => 'required|string|min:4|max:30',
            'property_and_income' => 'required|string|min:10|max:255',
            'personal_maritial_agreement' => 'required|boolean',
            'family_maritial_agreement' => 'required|boolean',
        ]);
        $retrieved_biodata = Biodata::where('user_id', $request->user_id)->get();
        if( count($retrieved_biodata) == 1 ){
            $biodata_update = Biodata::where('user_id', $request->user_id)->update([
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
                    $biodata_update = Biodata::where('user_id', $request->user_id)->update([
                        'running_tab' => $request->running_tab,
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
            'running_tab' => 'required|int|max:6',
            'deserved_division' => 'required|string|min:2|max:20',
            'deserved_district' => 'required|string|min:2|max:20',
            'deserved_age' => 'required|string|min:2|max:20',
            'deserved_skin_color' => 'required|string|min:2|max:20',
            'deserved_height' => 'required|string|min:2|max:30',
            'deserved_akida_majhhab' => 'required|string|min:2|max:30',
            'deserved_family_condition' => 'required|string|min:2|max:20',
            'deserved_job_title' => 'required|string|min:2|max:20',
            'deserved_education' => 'required|string|min:2|max:20',
            'deserved_maritial_status' => 'required|string|min:2|max:20',
            'deserved_condition' => 'required|string|min:2|max:30',
            'deserved_others_desc' => 'required|string|min:10|max:255',
        ]);
        $retrieved_biodata = Biodata::where('user_id', $request->user_id)->get();
        if( count($retrieved_biodata) == 1 ){
            $biodata_update = Biodata::where('user_id', $request->user_id)->update([
                'deserved_division' => $request->deserved_division,
                'deserved_district' => $request->deserved_district,
                'deserved_age' => $request->deserved_age,
                'deserved_skin_color' => $request->deserved_skin_color,
                'deserved_height' => $request->deserved_height,
                'deserved_akida_majhhab' => $request->deserved_akida_majhhab,
                'deserved_family_condition' => $request->deserved_family_condition,
                'deserved_job_title' => $request->deserved_job_title,
                'deserved_education' => $request->deserved_education,
                'deserved_maritial_status' => $request->deserved_maritial_status,
                'deserved_condition' => $request->deserved_condition,
                'deserved_others_desc' => $request->deserved_others_desc,
            ]);
            if($biodata_update){
                $retrieved_biodata = $retrieved_biodata[0];
                if( (int)$retrieved_biodata->running_tab < (int)$request->running_tab ){
                    $biodata_update = Biodata::where('user_id', $request->user_id)->update([
                        'running_tab' => $request->running_tab,
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
            'running_tab' => 'required|int|max:6',
            'form_holder_desc' => 'required|string|min:10|max:255',
            'male_guardian_desc' => 'required|string|min:10|max:255',
            'male_guardian_agreement' => 'required|boolean',
            'eleven_digit_mobile_number' => 'required|regex:/(01)[0-9]{9}/|max:11',
            'main_email_address' => 'required|email:rfc,dns|max:50',
            'deserved_money_pay' => 'required|string|min:2|max:20',
            'media_terms_one_agreement' => 'required|boolean',
            'hundred_money_pay' => 'required|boolean',
            'three_hundred_money_pay' => 'required|boolean',
            'media_terms_two_agreement' => 'required|boolean',
            'reference_code' => 'nullable|string|min:2|max:20',
        ]);
        $retrieved_biodata = Biodata::where('user_id', $request->user_id)->get();
        if( count($retrieved_biodata) == 1 ){
            $biodata_update = Biodata::where('user_id', $request->user_id)->update([
                'form_holder_desc' => $request->form_holder_desc,
                'male_guardian_desc' => $request->male_guardian_desc,
                'male_guardian_agreement' => $request->male_guardian_agreement,
                'eleven_digit_mobile_number' => $request->eleven_digit_mobile_number,
                'main_email_address' => $request->main_email_address,
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
                    $biodata_update = Biodata::where('user_id', $request->user_id)->update([
                        'running_tab' => $request->running_tab,
                    ]);
                }
                return redirect()->back()->with('success', __('frontend.flash_messages.others_biodata_onsave'));
            }
        }
        return redirect()->back()->with('error',  __('frontend.flash_messages.biodata_onerror'));
    }


}
