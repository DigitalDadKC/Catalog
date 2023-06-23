<?php

namespace App\Http\Controllers;

use view;
use App\Models\Guideline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuidelineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('estimating.guideline', [
            'guidelines' => Guideline::latest()->paginate(30),
            'id' => null
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'guideline' => 'required'
        ]);

        $formFields['user_id'] = auth()->id();

        Guideline::create($formFields);

        return redirect('/estimating/guidelines')->with('message', 'Guideline created successfully!');
    }

    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guideline $guideline)
    {
        return view('estimating.guideline', [
            'id' => $guideline->id,
            'guidelines' => Guideline::latest()->paginate(30)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guideline $guideline)
    {
        if ($guideline->user_id != auth()->id()) {
            return redirect('/estimating/guidelines')->with('message', 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'guideline' => 'required'
        ]);

        $guideline->update($formFields);

        return view('estimating.guideline', [
            'guidelines' => Guideline::latest()->paginate(30),
            'id' => null
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Guideline $guideline)
    {
        if ($guideline->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $guideline->delete();
        return redirect('/estimating/guidelines')->with('message', 'Guideline deleted successfully');
    }
}