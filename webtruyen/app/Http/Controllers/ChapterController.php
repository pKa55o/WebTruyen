<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Truyen;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($truyenId)
{
    // Fetch the story (truyen) by its ID
    $truyen = Truyen::findOrFail($truyenId);

    // Fetch all chapters related to this story
    $chapters = Chapter::where('truyen_id', $truyenId)->get();

    // Return the 'index' view with the data
    return view('admin.chapter.index', compact('truyen', 'chapters'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create($truyen_id)
{
    $truyen = Truyen::findOrFail($truyen_id);
    return view('admin.chapter.create', compact('truyen'));
}
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $truyenId)
    {
        //
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}