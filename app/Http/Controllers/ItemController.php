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

    public function flashMessage()
    {
        return view('flash-demo');
    }

    public function testSuccess()
    {
        return redirect()->route('flash-message')->with('success', 'Success! This is a success message.');
    }

    public function testError()
    {
        return redirect()->route('flash-message')->with('error', 'Error! Something went wrong.');
    }

    public function testWarning()
    {
        return redirect()->route('flash-message')->with('warning', 'Warning! Please be careful.');
    }

    public function testInfo()
    {
        return redirect()->route('flash-message')->with('info', 'Info! Here is some information.');
    }
}
