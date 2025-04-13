<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tutorial;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class TutorialController extends Controller
{
    public function index()
    {
        $tutorials = Tutorial::all();
        return view('tutorials.index', compact('tutorials'));
    }

    public function create()
    {
        return view('tutorials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'course_code' => 'required|string',
        ]);

        $slug = Str::slug($request->title);
        $presentation = $slug . '-' . Str::random(15);
        $finished = $slug . '-' . Str::random(15);

        Tutorial::create([
            'title' => $request->title,
            'course_code' => $request->course_code,
            'url_presentation' => '/presentation/' . $presentation,
            'url_finished' => '/finished/' . $finished,
            'creator_email' => Session::get('user_email'),
        ]);

        return redirect()->route('tutorials.index')->with('success', 'Tutorial berhasil dibuat.');
    }

    public function edit(Tutorial $tutorial)
    {
        return view('tutorials.edit', compact('tutorial'));
    }

    public function update(Request $request, Tutorial $tutorial)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'course_code' => 'required|string',
        ]);

        $tutorial->update([
            'title' => $request->title,
            'course_code' => $request->course_code,
        ]);

        return redirect()->route('tutorials.index')->with('success', 'Tutorial berhasil diperbarui.');
    }

    public function destroy(Tutorial $tutorial)
    {
        $tutorial->delete();
        return back()->with('success', 'Tutorial berhasil dihapus.');
    }
}
