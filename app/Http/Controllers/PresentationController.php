<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tutorial;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class PresentationController extends Controller
{
    public function showPresentation($slug)
    {
        $tutorial = Tutorial::where('url_presentation', $slug)->firstOrFail();
        $details = $tutorial->details()->where('status', 'show')->orderBy('order')->get();

        return view('presentation', compact('tutorial', 'details'));
    }

    public function showFinished($slug)
    {
        $tutorial = Tutorial::where('url_finished', $slug)->firstOrFail();
        $details = $tutorial->details()->orderBy('order')->get();

        $pdf = Pdf::loadView('finished', compact('tutorial', 'details'));
        return $pdf->stream('tutorial-' . Str::slug($tutorial->title) . '.pdf');
    }
}
