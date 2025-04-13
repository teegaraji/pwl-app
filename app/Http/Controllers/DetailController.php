<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detail;
use App\Models\Tutorial;

class DetailController extends Controller
{
    public function index()
    {
        $details = Detail::with('tutorial')->get();
        return view('details.index', compact('details'));
    }

    public function create()
    {
        $tutorials = Tutorial::all();
        return view('details.create', compact('tutorials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tutorial_id' => 'required|exists:tutorials,id',
            'text' => 'nullable|string',
            'code' => 'nullable|string',
            'url' => 'nullable|url',
            'order' => 'required|integer',
            'status' => 'required|in:show,hide',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif',
        ]);

        $imageData = null;
        if ($request->hasFile('image')) {
            $imageData = base64_encode(file_get_contents($request->file('image')->getRealPath()));
        }

        Detail::create([
            'tutorial_id' => $request->tutorial_id,
            'text' => $request->text,
            'code' => $request->code,
            'url' => $request->url,
            'order' => $request->order,
            'status' => $request->status,
            'image' => $imageData,
        ]);

        return redirect()->route('details.index')->with('success', 'Detail tutorial berhasil ditambahkan.');
    }

    public function edit(Detail $detail)
    {
        $tutorials = Tutorial::all();
        return view('details.edit', compact('detail', 'tutorials'));
    }

    public function update(Request $request, Detail $detail)
    {
        $request->validate([
            'tutorial_id' => 'required|exists:tutorials,id',
            'text' => 'nullable|string',
            'code' => 'nullable|string',
            'url' => 'nullable|url',
            'order' => 'required|integer',
            'status' => 'required|in:show,hide',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif',
        ]);

        if ($request->hasFile('image')) {
            $detail->image = base64_encode(file_get_contents($request->file('image')->getRealPath()));
        }

        $detail->update([
            'tutorial_id' => $request->tutorial_id,
            'text' => $request->text,
            'code' => $request->code,
            'url' => $request->url,
            'order' => $request->order,
            'status' => $request->status,
            'image' => $detail->image,
        ]);

        return redirect()->route('details.index')->with('success', 'Detail tutorial diperbarui.');
    }

    public function destroy(Detail $detail)
    {
        $detail->delete();
        return back()->with('success', 'Detail tutorial dihapus.');
    }
}
