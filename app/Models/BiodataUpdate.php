<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BiodataUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'is_approved',
        'approved_date',
        'running_tab',
        'biodata_code',
        'biodata_completion',
        'pending_approve',
        'in_admin_trash',
        'in_trash',
        'in_edit_request',
        'is_blocked',
        'special_biodata',
        'free_biodata',
        'similar_biodata',
        'similar_biodata_ids',
        'biodata_categories',
        'biodata_restriction',
        'daily_free',
        'special_package',
        'biodata_package',
        'user_mobile',
        'user_email',
        'media_agreement',
        'gender',
        'birth_date',
        'age',
        'skin_color',
        'height',
        'weight',
        'blood_group',
        'maritial_status',
        'have_children',
        'permanent_country',
        'permanent_division',
        'permanent_district',
        'permanent_upazila',
        'permanent_post_office',
        'permanent_post_code',
        'permanent_union_parishad',
        'address_same',
        'temporary_country',
        'temporary_division',
        'temporary_district',
        'temporary_upazila',
        'temporary_post_office',
        'temporary_post_code',
        'temporary_union_parishad',
        'address_hide',
        'job_title',
        'job_details',
        'job_location',
        'monthly_income',
        'medium_of_study',
        'general_selected',
        'general_highest_degree',
        'is_general_honorable_selected',
        'aliya_selected',
        'aliya_highest_degree',
        'is_aliya_honorable_selected',
        'kowmi_selected',
        'kowmi_highest_degree',
        'is_kowmi_honorable_selected',
        'study_others_selected',
        'study_others_highest_degree',
        'study_others_running',
        'study_others_pass',
        'study_in_details',
        'is_honorable_selected',
        'honorable_degree_details',
        'honorable_degree_place',
        'five_waqt_salat',
        'beard_quantity',
        'pants_worn_style',
        'veiling_style',
        'islamic_studies',
        'drugs_taken',
        'dowry_deserve_male',
        'akida_majhhab',
        'family_islam_maintain',
        'three_choosen_alems',
        'physical_weakness',
        'physical_weakness_desc',
        'good_affairs',
        'religious_future_plan',
        'borka_wearing',
        'nikab_with_borka',
        'dowry_deserve_female',
        'father_name',
        'father_desc',
        'mother_name',
        'mother_desc',
        'brother_sister_desc',
        'relative_desc',
        'family_condition',
        'property_and_income',
        'personal_maritial_agreement',
        'family_maritial_agreement',
        'deserved_districts',
        'deserved_age_range',
        'deserved_skin_colors',
        'deserved_height_range',
        'deserved_akida_majhhabs',
        'deserved_family_conditions',
        'deserved_job_titles',
        'deserved_education_mediums',
        'deserved_general_selected',
        'deserved_general_degrees',
        'deserved_aliya_selected',
        'deserved_aliya_degrees',
        'deserved_kowmi_selected',
        'deserved_kowmi_degrees',
        'deserved_study_others_selected',
        'deserved_study_others_degrees',
        'deserved_maritial_statuses',
        'deserved_conditions',
        'deserved_others_desc',
        'form_holder_desc',
        'male_guardian_desc',
        'male_guardian_agreement',
        'deserved_money_pay',
        'media_terms_one_agreement',
        'hundred_money_pay',
        'three_hundred_money_pay',
        'media_terms_two_agreement',
        'reference_code',
        'admin_comment',
    ];
}

