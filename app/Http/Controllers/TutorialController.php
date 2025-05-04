<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tutorial;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;

class TutorialController extends Controller
{

    private function getMakulFromWebservice()
    {
        $refreshToken = session('refreshToken');

        if (!$refreshToken) {
            return [];
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $refreshToken,
        ])->get('https://jwt-auth-eight-neon.vercel.app/getMakul');

        if ($response->failed()) {
            dd('API Error:', $response->status(), $response->body());
        }

        if ($response->successful()) {
            $json = $response->json();
            return $json['data'] ?? []; // hanya return bagian 'data' saja
        }

        return [];
    }


    public function index()
    {
        $tutorials = Tutorial::all();
        return view('tutorials.index', compact('tutorials'));
    }

    public function create()
    {
        $makulList = $this->getMakulFromWebservice(); // ambil dari webservice
        return view('tutorials.create', compact('makulList'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'title' => 'required|string|max:255',
            'course_code' => 'required|string',
            'kode_matkul' => 'required|string',
            'nama_matkul' => 'required|string',
        ]);


        $slug = Str::slug($request->title);
        $presentation = $slug . '-' . Str::random(15);
        $finished = $slug . '-' . Str::random(15);

        Tutorial::create([
            'title' => $request->title,
            'course_code' => $request->course_code,
            'kode_matkul' => $request->kode_matkul,
            'nama_matkul' => $request->nama_matkul,
            'url_presentation' => '/presentation/' . $presentation,
            'url_finished' => '/finished/' . $finished,
            'creator_email' => Session::get('user_email'),
        ]);


        return redirect()->route('tutorials.index')->with('success', 'Tutorial berhasil dibuat.');
    }

    public function edit(Tutorial $tutorial)
    {
        $makulList = $this->getMakulFromWebservice();
        return view('tutorials.edit', compact('tutorial', 'makulList'));
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

    public function presentation($slug)
    {
        $tutorial = Tutorial::where('url_presentation', '/presentation/' . $slug)->firstOrFail();
        $details = $tutorial->details()->where('status', 'show')->get();

        return view('presentation', compact('tutorial', 'details'));
    }

    public function finished($slug)
    {
        $tutorial = Tutorial::where('url_finished', '/finished/' . $slug)->firstOrFail();
        $details = $tutorial->details()->get();

        return view('finished', compact('tutorial', 'details'));
    }

    public function generatePDF($slug)
    {
        $tutorial = Tutorial::where('url_finished', '/finished/' . $slug)->firstOrFail();
        $details = $tutorial->details()->get(); // ambil semua status (show & hide)

        $pdf = Pdf::loadView('pdf.tutorial', compact('tutorial', 'details'));
        return $pdf->stream($tutorial->title . '.pdf');
        // atau: return $pdf->download($tutorial->title . '.pdf');
    }
}
