<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Models\District;
use Illuminate\Http\Request;
use App\Models\Biodata;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class FrontEndController extends Controller
{

    private $pageProps;

    public function __construct(){
        //initializing
        $this->pageProps = [
            'translations' => __('frontend'),
            'locale' => session('localization', config('app.locale')),
            'locales' => config('localization.locales'),
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ];
    }

    public function homePage(){

        $districts = District::all();
        $districts_array = [
            'districts' => $districts,
        ];
        $pageProps = $districts_array + $this->pageProps;

        return Inertia::render('Home', $pageProps);
    }

    public function aboutPage(){
        return Inertia::render('Frontend/About', $this->pageProps);
    }

    public function termsPage(){
        return Inertia::render('Frontend/Terms', $this->pageProps);
    }

    public function opinionsPage(){
        return Inertia::render('Frontend/Opinions', $this->pageProps);
    }

    public function contactPage(){
        return Inertia::render('Frontend/Contact', $this->pageProps);
    }

    public function userProfile(){

        $districts = District::all();
        $districts_array = [
            'districts' => $districts,
            'single_biodata' => [],
        ];
        if (Auth::guard('web')->user()) {
            $user_id = Auth::guard('web')->user()->id;
            $single_biodata = Biodata::where('user_id', $user_id)->get();
            if( $single_biodata ){
                if( count( $single_biodata ) == 1 ){
                    $districts_array['single_biodata'] = $single_biodata[0];
                }
            }
        }
        $pageProps = $districts_array + $this->pageProps;

        return Inertia::render('Profile', $pageProps);
    }


    public function frontEndFallBack(){

        return Inertia::render('404',  $this->pageProps);
    }

    public function biodataSearchPost(Request $request)
    {

        $request->validate([
            'gender' => 'required|text|max:10',
        ]);

        $biodatas = Biodata::where('gender', $request->gender)->paginate(1);
        $biodatas_array = [
            'biodatas' => $biodatas,
        ];
        $pageProps = $biodatas_array + $this->pageProps;

        // return $biodatas;

        return Inertia::render('Frontend/BiodataSearch', $pageProps);

        // return redirect()->route('frontend.biodata_search');
    }

    public function biodataSearch(Request $request){

        $request->validate([
            'selectedGender' => $request->searchNumber != 2 ? 'required|string|min:1|max:10' : 'nullable|string|min:1|max:10',
            'selectedDistricts' => $request->searchNumber != 2  ? 'required|string|min:1|max:700' : 'nullable|string|min:1|max:700',
            'ageRange' => $request->searchNumber == 1 || $request->searchNumber == 3 ? 'required|string|min:1|max:10' : 'nullable|string|min:1|max:10',
            'maritialStatuses' => $request->searchNumber == 1 || $request->searchNumber == 3 ? 'required|string|min:1|max:200' : 'nullable|string|min:1|max:200',
            'selectedCategory' => $request->searchNumber == 1  ? 'required|string|min:1|max:1' : 'nullable|string|min:1|max:1',
            'codeNumber' => $request->searchNumber == 2  ? 'required|string|min:1|max:20' : 'nullable|string|min:1|max:20',
            'heightRange' => $request->searchNumber == 3 ? 'required|string|min:1|max:30' : 'nullable|string|min:1|max:30',
            'skinColors' => $request->searchNumber == 3 ? 'required|string|min:1|max:200' : 'nullable|string|min:1|max:200',
            'akidaMajhabs' => $request->searchNumber == 3 ? 'required|string|min:1|max:200' : 'nullable|string|min:1|max:200',
            'familyConditions' => $request->searchNumber == 3 ? 'required|string|min:1|max:200' : 'nullable|string|min:1|max:200',
            'selectedJobs' => $request->searchNumber == 3 ? 'required|string|min:1|max:300' : 'nullable|string|min:1|max:300',
            'educationMediums' => $request->searchNumber == 3 ? 'required|string|min:1|max:200' : 'nullable|string|min:1|max:200',
            'specialCategory' => $request->searchNumber == 4 ? 'required|string|min:1|max:30' : 'nullable|string|min:1|max:30',
        ]);

        // initializing
        $lowerAge = '';
        $upperAge = '';

        if( $request->ageRange ){
            $ageArray = explode("-", trim($request->ageRange));
            $lowerAge = trim($ageArray[0]);
            $upperAge = trim($ageArray[1]);
        }

        $biodatas = Biodata::paginate(10)->withQueryString();

        if( $request->searchNumber == 1 ){
            $biodatas = Biodata::where('gender', $request->selectedGender)
            ->where('permanent_district', 'LIKE', '%'.$request->selectedDistricts.'%' )
            ->where('temporary_district', 'LIKE', '%'.$request->selectedDistricts.'%' )
            ->where('age', '>=', $lowerAge)
            ->where('age', '<=', $upperAge)
            ->where('maritial_status', 'LIKE', '%'.$request->maritialStatuses.'%' )
            // ->where('free_biodata', '=', $request->selectedCategory)
            ->paginate(10)->withQueryString();
        }


        $biodatas_array = [
            'biodatas' => $biodatas,
        ];
        $pageProps = $biodatas_array + $this->pageProps;

        return Inertia::render('Frontend/BiodataSearch', $pageProps);
    }


}
