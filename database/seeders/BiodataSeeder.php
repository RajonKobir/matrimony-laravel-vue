<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class BiodataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/data/biodatas.json");
        $biodatas = json_decode($json);
        $biodatas = $biodatas->biodatas;

        foreach ( $biodatas as $biodata_key => $biodata_value ) {
            DB::table('biodatas')->insert([
                'user_id' => $biodata_value->user_id,
                'biodata_code' => $biodata_value->biodata_code,
                'biodata_completion' => $biodata_value->biodata_completion,
                'is_approved' => $biodata_value->is_approved,
                'pending_approve' => $biodata_value->pending_approve,
                'media_agreement' => $biodata_value->media_agreement,
                'gender' => $biodata_value->gender,
                'birth_date' => $biodata_value->birth_date,
                'skin_color' => $biodata_value->skin_color,
                'height' => $biodata_value->height,
                'weight' => $biodata_value->weight,
                'blood_group' => $biodata_value->blood_group,
                'maritial_status' => $biodata_value->maritial_status,
                'have_children' => $biodata_value->have_children,
                'permanent_country' => $biodata_value->permanent_country,
                'permanent_division' => $biodata_value->permanent_division,
                'permanent_district' => $biodata_value->permanent_district,
                'permanent_upazila' => $biodata_value->permanent_upazila,
                'permanent_post_office' => $biodata_value->permanent_post_office,
                'permanent_post_code' => $biodata_value->permanent_post_code,
                'address_same' => $biodata_value->address_same,
                'address_hide' => $biodata_value->address_hide,
                'job_title' => $biodata_value->job_title,
                'job_details' => $biodata_value->job_details,
                'job_location' => $biodata_value->job_location,
                'monthly_income' => $biodata_value->monthly_income,
                'medium_of_study' => $biodata_value->medium_of_study,
                'general_highest_degree' => $biodata_value->general_highest_degree,
                'general_running' => $biodata_value->general_running,
                'general_pass' => $biodata_value->general_pass,
                'study_in_details' => $biodata_value->study_in_details,
                'honorable_degree_result' => $biodata_value->honorable_degree_result,
                'honorable_degree_place' => $biodata_value->honorable_degree_place,
                'honorable_degree_details' => $biodata_value->honorable_degree_details,
                'five_waqt_salat' => $biodata_value->five_waqt_salat,
                'beard_quantity' => $biodata_value->beard_quantity,
                'pants_worn_style' => $biodata_value->pants_worn_style,
                'veiling_style' => $biodata_value->veiling_style,
                'islamic_studies' => $biodata_value->islamic_studies,
                'drugs_taken' => $biodata_value->drugs_taken,
                'dowry_deserve' => $biodata_value->dowry_deserve,
                'akida_majhhab' => $biodata_value->akida_majhhab,
                'three_choosen_alems' => $biodata_value->three_choosen_alems,
                'family_islam_maintain' => $biodata_value->family_islam_maintain,
                'physical_weekness' => $biodata_value->physical_weekness,
                'good_affairs' => $biodata_value->good_affairs,
                'religious_future_plan' => $biodata_value->religious_future_plan,
                'borka_wearing' => $biodata_value->borka_wearing,
                'nikab_with_borka' => $biodata_value->nikab_with_borka,
                'father_name' => $biodata_value->father_name,
                'father_desc' => $biodata_value->father_desc,
                'mother_name' => $biodata_value->mother_name,
                'mother_desc' => $biodata_value->mother_desc,
                'brother_sister_desc' => $biodata_value->brother_sister_desc,
                'property_and_income' => $biodata_value->property_and_income,
                'personal_maritial_agreement' => $biodata_value->personal_maritial_agreement,
                'family_maritial_agreement' => $biodata_value->family_maritial_agreement,
                'deserved_division' => $biodata_value->deserved_division,
                'deserved_district' => $biodata_value->deserved_district,
                'deserved_age' => $biodata_value->deserved_age,
                'deserved_skin_color' => $biodata_value->deserved_skin_color,
                'deserved_height' => $biodata_value->deserved_height,
                'deserved_akida_majhhab' => $biodata_value->deserved_akida_majhhab,
                'deserved_family_condition' => $biodata_value->deserved_family_condition,
                'deserved_job_title' => $biodata_value->deserved_job_title,
                'deserved_maritial_status' => $biodata_value->deserved_maritial_status,
                'deserved_maritial_status_desc' => $biodata_value->deserved_maritial_status_desc,
                'deserved_others_desc' => $biodata_value->deserved_others_desc,
                'form_holder_name' => $biodata_value->form_holder_name,
                'form_holder_email' => $biodata_value->form_holder_email,
                'form_holder_mobile' => $biodata_value->form_holder_mobile,
                'form_holder_relation' => $biodata_value->form_holder_relation,
                'form_holder_mobile_whatsapp' => $biodata_value->form_holder_mobile_whatsapp,
                'form_holder_mobile_imo' => $biodata_value->form_holder_mobile_imo,
                'form_holder_mobile_telegram' => $biodata_value->form_holder_mobile_telegram,
                'form_holder_mobile_social' => $biodata_value->form_holder_mobile_social,
                'bride_or_groom_name' => $biodata_value->bride_or_groom_name,
                'male_guardian_name' => $biodata_value->male_guardian_name,
                'male_guardian_email' => $biodata_value->male_guardian_email,
                'male_guardian_mobile' => $biodata_value->male_guardian_mobile,
                'male_guardian_mobile_telegram' => $biodata_value->male_guardian_mobile_telegram,
                'male_guardian_mobile_imo' => $biodata_value->male_guardian_mobile_imo,
                'male_guardian_mobile_whatsapp' => $biodata_value->male_guardian_mobile_whatsapp,
                'male_guardian_relation' => $biodata_value->male_guardian_relation,
                'male_guardian_agreement' => $biodata_value->male_guardian_agreement,
                'eleven_digit_mobile_number' => $biodata_value->eleven_digit_mobile_number,
                'reference_code' => $biodata_value->reference_code,
                'deserved_money_pay' => $biodata_value->deserved_money_pay,
                'media_terms_one_agreement' => $biodata_value->media_terms_one_agreement,
                'hundred_money_pay' => $biodata_value->hundred_money_pay,
                'media_terms_two_agreement' => $biodata_value->media_terms_two_agreement,
                'admin_comment' => $biodata_value->admin_comment,
            ]);
        }
    }
}
