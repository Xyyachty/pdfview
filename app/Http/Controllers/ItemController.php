<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class ItemController extends Controller
{
    public function pdfview(Request $request)
    {
        $error = null;

        try {
            $items = User::all();
        } catch (\Throwable $exception) {
            // Keep the page available even if MySQL is temporarily down.
            $items = collect();
            $error = 'Database connection failed. Start MySQL and reload this page.';
        }

        if ($request->has('download')) {
            $pdf = Pdf::loadView('pdfview', compact('items'));
            return $pdf->download('pdfview.pdf');
        }

        return view('pdfview', compact('items', 'error'));
    }
}
