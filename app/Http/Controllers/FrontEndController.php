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
        }

        $likedUserIds = [];
        foreach ( $biodatas_array['likes'] as $single_like_key => $single_like ){
            array_push($likedUserIds, $single_like['receiver_user_id']);
        }

        $biodatas_array['biodatas'] = Biodata::whereIn( 'user_id', $likedUserIds )
        ->paginate(10)->withQueryString();

        $proposals = Proposal::whereIn('sender_user_id', $likedUserIds)
        ->orWhereIn('receiver_user_id', $likedUserIds)
        ->where('in_trash', false)
        ->get();
        if( $proposals ){
            if( count( $proposals ) > 0 ){
                $biodatas_array['proposals'] = $proposals;
            }
        }

        $pageProps = $biodatas_array + $this->pageProps;

        return Inertia::render('User/Likes', $pageProps);
    }


    public function userProposals(){

        $biodatas_array = [
            'sent_biodatas' => [],
            'received_biodatas' => [],
            'sent_proposals' => [],
            'received_proposals' => [],
            'likes' => [],
        ];

        if (Auth::guard('web')->user()) {
            $user_id = Auth::guard('web')->user()->id;

            $sent_proposals = Proposal::where('sender_user_id', $user_id)
            ->where('in_trash', false)
            ->orderBy('created_at', 'desc')
            ->get();
            if( $sent_proposals ){
                if( count( $sent_proposals ) > 0 ){
                    $biodatas_array['sent_proposals'] = $sent_proposals;
                }
            }

            $received_proposals = Proposal::where('receiver_user_id', $user_id)
            ->where('in_trash', false)
            ->orderBy('created_at', 'desc')
            ->get();
            if( $received_proposals ){
                if( count( $received_proposals ) > 0 ){
                    $biodatas_array['received_proposals'] = $received_proposals;
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

        $receivedProposalIds = [];
        foreach ( $biodatas_array['received_proposals'] as $single_proposal_key => $single_proposal ){
            array_push($receivedProposalIds, $single_proposal['sender_user_id']);
        }

        $biodatas_array['sent_biodatas'] = Biodata::whereIn( 'user_id', $sentProposalIds )
        ->orderBy('created_at', 'desc')
        ->paginate(30)->withQueryString();

        $biodatas_array['received_biodatas'] = Biodata::whereIn( 'user_id', $receivedProposalIds )
        ->orderBy('created_at', 'desc')
        ->paginate(30)->withQueryString();

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

        if( $request->ageRange ){
            $ageArray = explode("-", trim($request->ageRange));
            $lowerAge = trim($ageArray[0]);
            $upperAge = trim($ageArray[1]);
        }


        if( $request->searchNumber == 1 ){

            $biodatas = Biodata::where([
                ['is_approved', true],
                ['gender', $request->selectedGender],
                ['age', '>=', $lowerAge],
                ['age', '<=', $upperAge],
            ])
            ->when($request->maritialStatuses, function($query, $maritialStatuses) {
                if( $maritialStatuses ){
                    return $query->WhereIn( 'maritial_status', explode( ",", trim( $maritialStatuses ) ) );
                }
            })
            ->where(function($query) use ($request) {
                return $query
                ->WhereIn( 'permanent_district', explode( ",", trim( $request->selectedDistricts ) ) )
                ->orWhereIn ( 'temporary_district', explode( ",", trim( $request->selectedDistricts ) ) );
            })
            ->when($request->selectedCategory, function($query, $selectedCategory) {
                if( $selectedCategory ){
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
            ])
            ->where('biodata_code', 'LIKE', '%' . $request->codeNumber . '%')
            ->paginate(10)->withQueryString();
        }


        if( $request->searchNumber == 3 || $request->searchNumber == 4 ){
            if (Auth::guard('web')->user()) {
                return back()->with('error', "Whoops! it's a paid service.");
            }
            return redirect(route('register'));
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
