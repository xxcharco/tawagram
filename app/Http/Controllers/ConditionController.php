<?php

namespace App\Http\Controllers;

use App\Models\Condition;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(auth()->id());
        $conditions = Condition::orderBy('recorded_date', 'desc')->get();
        
        return Inertia::render('Conditions/Index', [
            'conditions' => $conditions,
            'message' => session('message')
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
        $request->validate([
            'is_high' => 'required|boolean',
            'condition' => 'required|in:良い,やや良い,やや悪い,悪い',
        ]);
    
        $condition = new Condition($request->input());
        $condition->recorded_date = now();
        $condition->save();
    
        return redirect()->back()->with('message', '記録しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Condition $condition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Condition $condition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Condition $condition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Condition $condition)
    {
        //
    }
}
