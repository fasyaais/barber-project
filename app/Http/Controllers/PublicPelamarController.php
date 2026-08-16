<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Pelamar;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PublicPelamarController extends Controller
{
    public function create(): Response
    {
        $jobs = Job::where('status', 'available')->with('position')->get();

        return Inertia::render('Apply', [
            'jobs' => $jobs,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_id' => ['required', 'exists:jobs,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'no_whatsapp' => ['required', 'string', 'max:255'],
            'cv' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:2048'],
        ]);

        $cvPath = $request->file('cv')->store('cv', 'public');

        Pelamar::create([
            'job_id' => $validated['job_id'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'no_whatsapp' => $validated['no_whatsapp'],
            'cv' => $cvPath,
            'submited_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Lamaran terkirim! Kami akan menghubungi Anda melalui WhatsApp.');
    }
}
