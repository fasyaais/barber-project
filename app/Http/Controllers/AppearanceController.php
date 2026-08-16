<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AppearanceController extends Controller
{
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'appearance' => ['required', 'in:light,dark,system'],
        ]);

        $request->session()->put('appearance', $validated['appearance']);

        return redirect()->back();
    }
}
