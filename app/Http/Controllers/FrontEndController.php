<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Models\District;
use Illuminate\Http\Request;
use App\Models\Biodata;
use App\Models\Like;
use App\Models\Proposal;
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
            'single_biodata' => [],
        ];

        if (Auth::guard('web')->user()) {
            $user_id = Auth::guard('web')->user()->id;
            $single_biodata = Biodata::where('user_id', $user_id)->get();
            if( $single_biodata ){
                if( count( $single_biodata ) == 1 ){
                    $this->pageProps['single_biodata'] = $single_biodata[0];
                }
            }
        }

    }

    public function homePage(Request $request){

        $districts = District::all();
        $districts_array = [
            'districts' => $districts,
        ];
        $pageProps = $districts_array + $this->pageProps;

        return Inertia::render('Home', $pageProps);
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

        return Inertia::render('User/Profile', $pageProps);
    }


    public function userLikes(){

        $biodatas_array = [
            'biodatas' => [],
            'likes' => [],
            'proposals' => [],
        ];

        if (Auth::guard('web')->user()) {
            $user_id = Auth::guard('web')->user()->id;
            $likes = Like::where('sender_user_id', $user_id)->get();
            if( $likes ){
                if( count( $likes ) > 0 ){
                    $biodatas_array['likes'] = $likes;
                }
            }
            $proposals = Proposal::where('sender_user_id', $user_id)
            ->orWhere('receiver_user_id', $user_id)
            ->where('proposal_rejected', false)
            ->where('in_trash', false)
            ->get();
            if( $proposals ){
                if( count( $proposals ) > 0 ){
                    $biodatas_array['proposals'] = $proposals;
                }
            }
        }

        $likedUserIds = [];
        foreach ( $biodatas_array['likes'] as $single_like_key => $single_like ){
            array_push($likedUserIds, $single_like['receiver_user_id']);
        }

        $biodatas_array['biodatas'] = Biodata::whereIn( 'user_id', $likedUserIds )
        ->paginate(10)->withQueryString();

        $pageProps = $biodatas_array + $this->pageProps;

        return Inertia::render('User/Likes', $pageProps);
    }


    public function userProposals(){

        $biodatas_array = [
            'sent_biodatas' => [],
            'all_sent_biodatas' => [],
            'received_biodatas' => [],
            'all_received_biodatas' => [],
            'sent_proposals' => [],
            'all_sent_proposals' => [],
            'received_proposals' => [],
            'all_received_proposals' => [],
            'likes' => [],
        ];

        if (Auth::guard('web')->user()) {
            $user_id = Auth::guard('web')->user()->id;

            $sent_proposals = Proposal::where('sender_user_id', $user_id)
            ->where('proposal_rejected', false)
            ->where('in_trash', false)
            ->orderBy('created_at', 'desc')
            ->get();
            if( $sent_proposals ){
                if( count( $sent_proposals ) > 0 ){
                    $biodatas_array['sent_proposals'] = $sent_proposals;
                }
            }
            $all_sent_proposals = Proposal::where('sender_user_id', $user_id)
            ->where('in_trash', false)
            ->orderBy('created_at', 'desc')
            ->get();
            if( $all_sent_proposals ){
                if( count( $all_sent_proposals ) > 0 ){
                    $biodatas_array['all_sent_proposals'] = $all_sent_proposals;
                }
            }

            $received_proposals = Proposal::where('receiver_user_id', $user_id)
            ->where('proposal_rejected', false)
            ->where('in_trash', false)
            ->orderBy('created_at', 'desc')
            ->get();
            if( $received_proposals ){
                if( count( $received_proposals ) > 0 ){
                    $biodatas_array['received_proposals'] = $received_proposals;
                }
            }
            $all_received_proposals = Proposal::where('receiver_user_id', $user_id)
            ->where('in_trash', false)
            ->orderBy('created_at', 'desc')
            ->get();
            if( $all_received_proposals ){
                if( count( $all_received_proposals ) > 0 ){
                    $biodatas_array['all_received_proposals'] = $all_received_proposals;
                }
            }

            $likes = Like::where('sender_user_id', $user_id)->get();
            if( $likes ){
                if( count( $likes ) > 0 ){
                    $biodatas_array['likes'] = $likes;
                }
            }
        }

        $sentProposalIds = [];
        foreach ( $biodatas_array['sent_proposals'] as $single_proposal_key => $single_proposal ){
            array_push($sentProposalIds, $single_proposal['receiver_user_id']);
        }

        $allSentProposalIds = [];
        foreach ( $biodatas_array['all_sent_proposals'] as $single_proposal_key => $single_proposal ){
            array_push($allSentProposalIds, $single_proposal['receiver_user_id']);
        }

        $receivedProposalIds = [];
        foreach ( $biodatas_array['received_proposals'] as $single_proposal_key => $single_proposal ){
            array_push($receivedProposalIds, $single_proposal['sender_user_id']);
        }

        $allReceivedProposalIds = [];
        foreach ( $biodatas_array['all_received_proposals'] as $single_proposal_key => $single_proposal ){
            array_push($allReceivedProposalIds, $single_proposal['sender_user_id']);
        }

        $biodatas_array['sent_biodatas'] = Biodata::whereIn( 'user_id', $sentProposalIds )
        ->orderBy('created_at', 'desc')
        ->paginate(10)->withQueryString();

        $biodatas_array['all_sent_biodatas'] = Biodata::whereIn( 'user_id', $allSentProposalIds )
        ->orderBy('created_at', 'desc')
        ->paginate(10)->withQueryString();

        $biodatas_array['received_biodatas'] = Biodata::whereIn( 'user_id', $receivedProposalIds )
        ->orderBy('created_at', 'desc')
        ->paginate(10)->withQueryString();

        $biodatas_array['all_received_biodatas'] = Biodata::whereIn( 'user_id', $allReceivedProposalIds )
        ->orderBy('created_at', 'desc')
        ->paginate(10)->withQueryString();

        $pageProps = $biodatas_array + $this->pageProps;

        return Inertia::render('User/Proposals', $pageProps);
    }


    public function userPackages(){
        return Inertia::render('User/Packages', $this->pageProps);
    }


    public function frontEndFallBack(){

        return Inertia::render('404',  $this->pageProps);
    }


    public function biodataSearch(Request $request){

        $request->validate([
            'selectedGender' => $request->searchNumber != 2 ? 'required|string|min:1|max:10' : 'nullable|string|min:1|max:10',
            'selectedDistricts' => $request->searchNumber != 2  ? 'required|string|min:1|max:700' : 'nullable|string|min:1|max:700',
            'ageRange' => 'nullable|string|min:1|max:10',
            'maritialStatuses' => 'nullable|string|min:1|max:200',
            'selectedCategory' => 'nullable|string|min:1|max:1',
            'codeNumber' => $request->searchNumber == 2  ? 'required|string|min:1|max:20' : 'nullable|string|min:1|max:20',
            'heightRange' => 'nullable|string|min:1|max:30',
            'skinColors' => 'nullable|string|min:1|max:200',
            'akidaMajhabs' => 'nullable|string|min:1|max:200',
            'familyConditions' => 'nullable|string|min:1|max:200',
            'selectedJobs' => 'nullable|string|min:1|max:300',
            'educationMediums' => 'nullable|string|min:1|max:200',
            'specialCategory' => $request->searchNumber == 4 ? 'required|string|min:1|max:30' : 'nullable|string|min:1|max:30',
        ]);

        // initializing
        $biodatas = [];
        $lowerAge = '';
        $upperAge = '';
        $lowerHeight = '';
        $upperHeight = '';
        $filteredHeights = [];


        if( $request->searchNumber == 1 ){

            $biodatas = Biodata::where([
                ['is_approved', true],
                ['in_trash', false],
                ['in_admin_trash', false],
                ['is_blocked', false],
                ['hide_biodata', false],
            ])
            ->when($request->selectedGender, function($query, $selectedGender) {
                return $query->where('gender', $selectedGender);
            })
            ->when($request->selectedDistricts, function($query, $selectedDistricts) {
                $districts = explode(',', trim($selectedDistricts));
                return $query->where(function($query) use ($districts) {
                    return $query
                    ->whereIn('permanent_district', $districts)
                    ->orWhereIn('temporary_district', $districts);
                });
            })
            ->when($request->ageRange, function($query, $ageRange) {
                $ageArray = explode("-", trim($ageRange));
                $lowerAge = trim($ageArray[0]);
                $upperAge = trim($ageArray[1]);
                return $query
                ->where( 'age', '>=', $lowerAge )
                ->where( 'age', '<=', $upperAge );
            })
            ->when($request->maritialStatuses, function($query, $maritialStatuses) {
                $maritialStatusesArray = array_map('trim', explode(',', $maritialStatuses));
                if( trim($maritialStatuses) != "any" && trim($maritialStatuses) != "যেকোনো" && !in_array("যেকোনো", $maritialStatusesArray) && !in_array("any", $maritialStatusesArray) ){
                    return $query->whereIn( 'maritial_status', $maritialStatusesArray );
                }
            })
            ->when($request->selectedCategory, function($query, $selectedCategory) {
                if( $selectedCategory != 1 ){
                    if( $selectedCategory == 2 ){
                        return $query->where('free_biodata', 1);
                    }
                    elseif( $selectedCategory == 3 ){
                        return $query->where(function($query) {
                            return $query
                            ->where('free_biodata', 0)
                            ->orWhere('free_biodata', null);
                        });
                    }
                }
            })
            ->paginate(10)->withQueryString();
        }


        if( $request->searchNumber == 2 ){
            $biodatas = Biodata::where([
                ['is_approved', true],
                ['in_trash', false],
                ['in_admin_trash', false],
                ['is_blocked', false],
                ['hide_biodata', false],
            ])
            ->where('biodata_code', $request->codeNumber )
            ->paginate(10)->withQueryString();
        }


        if( $request->searchNumber == 3 || $request->searchNumber == 4 ){
            if (Auth::guard('web')->user()) {
                $user_id = Auth::guard('web')->user()->id;
                $single_biodata = Biodata::where('user_id', $user_id)->get();
                if( $single_biodata ){
                    if( count( $single_biodata ) == 1 ){
                        $is_free_biodata = $single_biodata[0]->free_biodata;
                        if( !$is_free_biodata ){
                            return back()->with('error', "Whoops! it's a paid service.");
                        }
                    }
                }
            }else{
                return redirect(route('register'));
            }
        }

        // special search 1
        if( $request->searchNumber == 3 ){

            $biodatas = Biodata::where([
                ['is_approved', true],
                ['in_trash', false],
                ['in_admin_trash', false],
                ['is_blocked', false],
                ['hide_biodata', false],
            ])
            ->when($request->selectedGender, function($query, $selectedGender) {
                return $query->where('gender', $selectedGender);
            })
            ->when($request->selectedDistricts, function($query, $selectedDistricts) {
                $districts = explode(',', trim($selectedDistricts));
                return $query->where(function($query) use ($districts) {
                    return $query
                        ->whereIn('permanent_district', $districts)
                        ->orWhereIn('temporary_district', $districts);
                });
            })
            ->when($request->maritialStatuses, function($query, $maritialStatuses) {
                $maritialStatusesArray = array_map('trim', explode(',', $maritialStatuses));
                if( trim($maritialStatuses) != "any" && trim($maritialStatuses) != "যেকোনো" && !in_array("যেকোনো", $maritialStatusesArray) && !in_array("any", $maritialStatusesArray) ){
                    return $query->whereIn( 'maritial_status', $maritialStatusesArray );
                }
            })
            ->when($request->akidaMajhabs, function($query, $akidaMajhabs) {
                $akidaMajhabsArray = array_map('trim', explode(',', $akidaMajhabs));
                if( trim($akidaMajhabs) != "any" && trim($akidaMajhabs) != "যেকোনো" && !in_array("যেকোনো", $akidaMajhabsArray) && !in_array("any", $akidaMajhabsArray) ){
                    return $query->whereIn( 'akida_majhhab', $akidaMajhabsArray );
                }
            })
            ->when($request->ageRange, function($query, $ageRange) {
                return $query->where(function($query) use ($ageRange) {
                    $ageArray = explode("-", trim($ageRange));
                    $lowerAge = trim($ageArray[0]);
                    $upperAge = trim($ageArray[1]);
                    return $query
                    ->where( 'age', '>=', $lowerAge )
                    ->orWhere( 'age', '<=', $upperAge );
                });
            })
            ->when($request->heightRange, function($query, $heightRange) {
                $heightArray = explode("-", trim( $heightRange ));
                $lowerHeight = trim($heightArray[0]);
                $upperHeight = trim($heightArray[1]);
                $height_options = __('frontend.biodata_form.personal_biodata.height_options');
                $startKey = array_search($lowerHeight, $height_options);
                $endKey = array_search($upperHeight, $height_options);
                if ($startKey !== false && $endKey !== false) {
                    $filteredHeights = array_slice($height_options, $startKey - 1, ($endKey - $startKey) + 1, true);
                } else {
                    $filteredHeights = [];
                }
                return $query
                ->whereIn('height',  $filteredHeights);
            })
            ->when($request->selectedJobs, function($query, $selectedJobs) {
                $selectedJobsArray = array_map('trim', explode(',', $selectedJobs));
                if( trim($selectedJobs) != "any" && trim($selectedJobs) != "যেকোনো" && !in_array("যেকোনো", $selectedJobsArray) && !in_array("any", $selectedJobsArray) ){
                    return $query->whereIn( 'job_title', $selectedJobsArray );
                }
            })
            ->when($request->skinColors, function($query, $skinColors) {
                $skinColorsArray = array_map('trim', explode(',', $skinColors));
                if( trim($skinColors) != "any" && trim($skinColors) != "যেকোনো" && !in_array("যেকোনো", $skinColorsArray) && !in_array("any", $skinColorsArray) ){
                    return $query->whereIn( 'skin_color', $skinColorsArray );
                }
            })
            ->when($request->educationMediums, function($query, $educationMediums) {
                $educationMediumsArray = array_map('trim', explode(',', $educationMediums));
                if( trim($educationMediums) != "any" && trim($educationMediums) != "যেকোনো" && !in_array("যেকোনো", $educationMediumsArray) && !in_array("any", $educationMediumsArray) ){
                    return $query->whereIn( 'medium_of_study', $educationMediumsArray );
                }
            })
            ->when($request->familyConditions, function($query, $familyConditions) {
                $familyConditionsArray = array_map('trim', explode(',', $familyConditions));
                if( trim($familyConditions) != "any" && trim($familyConditions) != "যেকোনো" && !in_array("যেকোনো", $familyConditionsArray) && !in_array("any", $familyConditionsArray) ){
                    return $query->whereIn( 'family_condition', $familyConditionsArray );
                }
            })
            ->paginate(10)->withQueryString();
        }


        // special search 2
        if( $request->searchNumber == 4 ){
            $biodatas = Biodata::where([
                ['is_approved', true],
                ['in_trash', false],
                ['in_admin_trash', false],
                ['is_blocked', false],
                ['hide_biodata', false],
            ])
            ->when($request->selectedGender, function($query, $selectedGender) {
                return $query->where('gender', $selectedGender);
            })
            ->when($request->selectedDistricts, function($query, $selectedDistricts) {
                $districts = explode(',', trim($selectedDistricts));
                return $query->where(function($query) use ($districts) {
                    return $query
                        ->whereIn('permanent_district', $districts)
                        ->orWhereIn('temporary_district', $districts);
                });
            })
            ->when($request->specialCategory, function($query, $specialCategory) {
                return $query->whereIn( 'biodata_categories', explode( ",", trim( $specialCategory ) ) );
            })
            ->when($request->specialCategory, function($query, $specialCategory) {
                $specialCategoryArray = array_map('trim', explode(',', $specialCategory));
                if( trim($specialCategory) != "any" && trim($specialCategory) != "যেকোনো" && !in_array("যেকোনো", $specialCategoryArray) && !in_array("any", $specialCategoryArray) ){
                    return $query->whereIn( 'biodata_categories', $specialCategoryArray );
                }
            })
            ->paginate(10)->withQueryString();
        }


        $biodatas_array = [
            'biodatas' => $biodatas,
            'likes' => [],
            'proposals' => [],
        ];

        if (Auth::guard('web')->user()) {
            $user_id = Auth::guard('web')->user()->id;
            $likes = Like::where('sender_user_id', $user_id)->get();
            if( $likes ){
                if( count( $likes ) > 0 ){
                    $biodatas_array['likes'] = $likes;
                }
            }
            $proposals = Proposal::where('sender_user_id', $user_id)
            ->orWhere('receiver_user_id', $user_id)
            ->where('in_trash', false)
            ->get();
            if( $proposals ){
                if( count( $proposals ) > 0 ){
                    $biodatas_array['proposals'] = $proposals;
                }
            }
        }

        $pageProps = $biodatas_array + $this->pageProps;

        return Inertia::render('Frontend/BiodataSearch', $pageProps);
    }


}
