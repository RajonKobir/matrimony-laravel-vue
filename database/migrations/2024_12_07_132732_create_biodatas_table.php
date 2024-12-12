<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('biodatas', function (Blueprint $table) {

            $table->id();
            $table->bigInteger('user_id')->unique();
            $table->boolean('is_approved')->nullable();
            $table->string('biodata_code', length: 10)->unique()->nullable();

            //personal data starts here
            $table->boolean('media_agreement')->nullable();
            $table->string('gender', length: 10)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('skin_color', length: 20)->nullable();
            $table->string('height', length: 10)->nullable();
            $table->string('weight', length: 20)->nullable();
            $table->string('blood_group', length: 10)->nullable();
            $table->string('maritial_status', length: 20)->nullable();
            $table->boolean('have_children')->nullable();
            $table->string('permanent_country', length: 20)->nullable();
            $table->string('permanent_division', length: 20)->nullable();
            $table->string('permanent_district', length: 20)->nullable();
            $table->string('permanent_upazila', length: 30)->nullable();
            $table->string('permanent_post_office', length: 40)->nullable();
            $table->string('permanent_post_code', length: 6)->nullable();
            $table->boolean('address_same')->nullable();
            $table->string('temporary_country', length: 20)->nullable();
            $table->string('temporary_division', length: 20)->nullable();
            $table->string('temporary_district', length: 20)->nullable();
            $table->string('temporary_upazila', length: 30)->nullable();
            $table->string('temporary_post_office', length: 40)->nullable();
            $table->string('temporary_post_code', length: 6)->nullable();
            $table->boolean('address_hide')->nullable();
            $table->string('job_title', length: 50 )->nullable();
            $table->string('job_details', length: 200)->nullable();
            $table->string('job_location', length: 50)->nullable();
            $table->string('monthly_income', length: 20)->nullable();
            $table->string('medium_of_study', length: 60)->nullable();
            $table->boolean('general_selected')->nullable();
            $table->string('general_highest_degree', length: 50)->nullable();
            $table->boolean('general_running')->nullable();
            $table->boolean('general_pass')->nullable();
            $table->boolean('aliya_selected')->nullable();
            $table->string('aliya_highest_degree', length: 50)->nullable();
            $table->boolean('aliya_running')->nullable();
            $table->boolean('aliya_pass')->nullable();
            $table->boolean('kowmi_selected')->nullable();
            $table->string('kowmi_highest_degree', length: 50)->nullable();
            $table->boolean('kowmi_running')->nullable();
            $table->boolean('kowmi_pass')->nullable();
            $table->boolean('study_others_selected')->nullable();
            $table->string('study_others_highest_degree', length: 50)->nullable();
            $table->boolean('study_others_running')->nullable();
            $table->boolean('study_others_pass')->nullable();
            $table->string('study_in_details', length: 300)->nullable();
            $table->string('honorable_degree_result', length: 20)->nullable();
            $table->string('honorable_degree_place', length: 100)->nullable();
            $table->string('honorable_degree_details', length: 200)->nullable();
            //personal data ends here

            //religious data starts here
            $table->string('five_waqt_salat', length: 20)->nullable();
            $table->string('beard_quantity', length: 20)->nullable();
            $table->string('pants_worn_style', length: 20)->nullable();
            $table->string('veiling_style', length: 20)->nullable();
            $table->string('islamic_studies', length: 50)->nullable();
            $table->string('drugs_taken', length: 50)->nullable();
            $table->string('dowry_deserve', length: 20)->nullable();
            $table->string('akida_majhhab', length: 20)->nullable();
            $table->string('three_choosen_alems', length: 50)->nullable();
            $table->string('family_islam_maintain', length: 20)->nullable();
            $table->boolean('physical_weekness')->nullable();
            $table->tinyText('physical_weekness_desc')->nullable();
            $table->tinyText('good_affairs')->nullable();
            $table->tinyText('religious_future_plan')->nullable();
            //specially for female
            $table->string('borka_wearing', length: 20)->nullable();
            $table->string('nikab_with_borka', length: 20)->nullable();
            //specially for female ends
            //religious data ends here

            // family data
            $table->string('father_name', length: 30)->nullable();
            $table->tinyText('father_desc')->nullable();
            $table->string('mother_name', length: 30)->nullable();
            $table->tinyText('mother_desc')->nullable();
            $table->tinyText('brother_sister_desc')->nullable();
            $table->tinyText('relative_desc')->nullable();
            $table->tinyText('property_and_income')->nullable();
            $table->boolean('personal_maritial_agreement')->nullable();
            $table->boolean('family_maritial_agreement')->nullable();
            // family data ends

            //deserved data
            $table->string('deserved_division', length: 20)->nullable();
            $table->string('deserved_district', length: 20)->nullable();
            $table->tinyInteger('deserved_age')->nullable();
            $table->string('deserved_skin_color', length: 20)->nullable();
            $table->string('deserved_height', length: 10)->nullable();
            $table->string('deserved_akida_majhhab', length: 20)->nullable();
            $table->string('deserved_family_condition', length: 20)->nullable();
            $table->string('deserved_job_title', length: 20)->nullable();
            $table->string('deserved_education', length: 20)->nullable();
            $table->string('deserved_maritial_status', length: 20)->nullable();
            $table->tinyText('deserved_maritial_status_desc')->nullable();
            $table->tinyText('deserved_others_desc')->nullable();
            //deserved data ends

            //others data
            $table->string('form_holder_name', length: 20)->nullable();
            $table->string('form_holder_email', length: 50)->nullable();
            $table->string('form_holder_mobile', length: 20)->nullable();
            $table->string('form_holder_relation', length: 20)->nullable();
            $table->boolean('form_holder_mobile_whatsapp')->nullable();
            $table->boolean('form_holder_mobile_imo')->nullable();
            $table->boolean('form_holder_mobile_telegram')->nullable();
            $table->string('form_holder_mobile_social', length: 20)->nullable();
            $table->string('bride_or_groom_name', length: 20)->nullable();
            $table->string('male_guardian_name', length: 20)->nullable();
            $table->string('male_guardian_email', length: 50)->nullable();
            $table->string('male_guardian_mobile', length: 20)->nullable();
            $table->boolean('male_guardian_mobile_telegram')->nullable();
            $table->boolean('male_guardian_mobile_imo')->nullable();
            $table->boolean('male_guardian_mobile_whatsapp')->nullable();
            $table->string('male_guardian_relation', length: 20)->nullable();
            $table->boolean('male_guardian_agreement')->nullable();
            $table->string('eleven_digit_mobile_number', length: 11)->nullable();
            $table->string('reference_code', length: 20)->nullable();
            $table->string('deserved_money_pay', length: 20)->nullable();
            $table->boolean('media_terms_one_agreement')->nullable();
            $table->boolean('hundred_money_pay')->nullable();
            $table->boolean('media_terms_two_agreement')->nullable();
            $table->tinyText('admin_comment')->nullable();
            //others data ends

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biodatas');
    }
};
