<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;
use Inertia\Inertia;


class TermsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Term::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'serial_no' => 'required|integer|min:1|max:255',
            'question' => 'required|string|min:2|max:3000',
            'question_en' => 'required|string|min:2|max:3000',
            'answer' => 'required|string|min:2|max:3000',
            'answer_en' => 'required|string|min:2|max:3000',
        ]);

        $single_term = Term::create([
            'serial_no' => $request->serial_no,
            'question' => $request->question,
            'question_en' => $request->question_en,
            'answer' => $request->answer,
            'answer_en' => $request->answer_en,
        ]);

        if ($single_term) {
            return back()->with([
                'success' => $single_term->id,
            ]);
        }

        return back()->with([
            'error' => 'Something went wrong!',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Term $terms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Term $terms)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Term $terms)
    public function update(Request $request)
    {
        // Validate request data
        $request->validate([
            'id' => 'required|integer|min:1|max:255',
            'serial_no' => 'required|integer|min:1|max:255',
            'question' => 'required|string|min:2|max:3000',
            'question_en' => 'required|string|min:2|max:3000',
            'answer' => 'required|string|min:2|max:3000',
            'answer_en' => 'required|string|min:2|max:3000',
        ]);
        $single_term = Term::find($request->id);

        if( $single_term ){
            // Update term details
            $single_term->update([
                'serial_no' => $request->serial_no,
                'question' => $request->question,
                'question_en' => $request->question_en,
                'answer' => $request->answer,
                'answer_en' => $request->answer_en,
            ]);

            return back()->with([
                'success' => $single_term->id,
            ]);
        }

        return back()->with([
            'error' => 'Something went wrong!',
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Term $term)
    public function destroy($id)
    {
        $single_term = Term::find($id);

        if( $single_term ){
            $single_term->delete();

            return Term::all();
        }

        return false;

    }


}
