<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelamar;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PelamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $pelamar = Pelamar::with('job.position')->orderByDesc('created_at')->get();

        return Inertia::render('admin/pelamar/Index', [
            'pelamar' => $pelamar,
            'breadcrumbs' => [
                [
                    'name' => 'Pelamar',
                ],
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('admin/pelamar/Create', [
            'breadcrumbs' => [
                [
                    'href' => route('admin.pelamar.index'),
                    'name' => 'Pelamar',
                ],
                [
                    'name' => 'Tambah',
                ],
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
