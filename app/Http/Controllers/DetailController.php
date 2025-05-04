<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detail;
use App\Models\Tutorial;
use Illuminate\Support\Facades\Log;

class DetailController extends Controller
{
    public function index($tutorialId)
    {
        $tutorial = Tutorial::findOrFail($tutorialId); // Ambil tutorial berdasarkan ID
        $details = Detail::where('tutorial_id', $tutorial->id)->get(); // Ambil detail berdasarkan tutorial
        return view('details.index', compact('details', 'tutorial')); // Kirim $tutorial ke view
    }

    public function create($tutorialId)
    {
        $tutorial = Tutorial::findOrFail($tutorialId); // Ambil tutorial berdasarkan ID
        $details = Detail::where('tutorial_id', $tutorial->id)->get();
        return view('details.create', compact('tutorial'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tutorial_id' => 'required|exists:tutorials,id',
            'text' => 'nullable|string',
            'code' => 'nullable|string',
            'url' => 'nullable|url',
            'order' => 'required|integer',
            'status' => 'required|in:show,hide',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif',
        ]);

        Log::info('Data yang diterima:', $validatedData);

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

        Log::info('Detail berhasil disimpan.');

        return redirect()->route('details.index', $request->tutorial_id)->with('success', 'Detail tutorial berhasil ditambahkan.');
    }

    public function edit($tutorialId, $detailId)
    {
        $tutorial = Tutorial::findOrFail($tutorialId); // Ambil tutorial berdasarkan ID
        $detail = Detail::findOrFail($detailId); // Ambil detail berdasarkan ID
        return view('details.edit', compact('tutorial', 'detail'));
    }

    public function update(Request $request, $tutorialId, $detailId)
    {
        $detail = Detail::findOrFail($detailId); // Ambil detail berdasarkan ID

        // Log data yang diterima
        Log::info('Data yang diterima untuk update:', $request->all());

        $request->validate([
            'tutorial_id' => 'required|exists:tutorials,id',
            'text' => 'nullable|string',
            'code' => 'nullable|string',
            'url' => 'nullable|url',
            'order' => 'required|integer',
            'status' => 'required|in:show,hide',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif',
        ]);

        // Log data sebelum diperbarui
        Log::info('Detail sebelum diperbarui:', $detail->toArray());

        // Perbarui properti model dengan data dari request
        $detail->tutorial_id = $request->tutorial_id;
        $detail->text = $request->text;
        $detail->code = $request->code;
        $detail->url = $request->url;
        $detail->order = $request->order;
        $detail->status = $request->status;

        // Periksa apakah ada file gambar yang diunggah
        if ($request->hasFile('image')) {
            $detail->image = base64_encode(file_get_contents($request->file('image')->getRealPath()));
        }

        // Simpan perubahan ke database
        $detail->save();

        // Log data setelah diperbarui
        Log::info('Detail setelah diperbarui:', $detail->toArray());

        return redirect()->route('details.index', $tutorialId)->with('success', 'Detail tutorial diperbarui.');
    }

    public function updateStatus(Request $request, $tutorialId, $detailId)
    {
        $request->validate([
            'status' => 'required|in:show,hide',
        ]);

        $detail = Detail::findOrFail($detailId);
        $detail->status = $request->status;
        $detail->save();

        return back()->with('success', 'Status berhasil diperbarui.');
    }

    public function destroy($tutorialId, $detailId)
    {
        $detail = Detail::findOrFail($detailId);
        $detail->delete();
        return back()->with('success', 'Detail tutorial dihapus.');
    }
}
