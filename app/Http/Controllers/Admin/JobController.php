<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Merchant;
use App\Models\Position;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Job::with(['merchant', 'position'])->get();

        return Inertia::render('admin/jobs/Index', [
            'data' => $data,
            'breadcrumbs' => [
                [
                    'name' => 'Pekerjaan',
                ],
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $merchants = Merchant::select('id', 'name', 'locate')->get();
        $positions = Position::select('id', 'name')->get();

        return Inertia::render('admin/jobs/Create', [
            'merchants' => $merchants,
            'positions' => $positions,
            'breadcrumbs' => [
                [
                    'href' => route('admin.jobs.index'),
                    'name' => 'Pekerjaan',
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
        // dd($request->all());
        $req = $request->validate([
            'merchant_id' => 'required|exists:merchants,id',
            'position_id' => 'nullable|exists:positions,id',
            'description' => 'required|string',
            'slot' => 'required|numeric',
            'due_date' => 'required|date',
        ]);

        Job::create($req);

        return to_route('admin.jobs.index');
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
        $data = Job::with(['merchant', 'position'])->findOrFail($id);
        $merchants = Merchant::select('id', 'name', 'locate')->get();
        $positions = Position::select('id', 'name')->get();

        return Inertia::render('admin/jobs/Edit', [
            'data' => $data,
            'merchants' => $merchants,
            'positions' => $positions,
            'breadcrumbs' => [
                [
                    'href' => route('admin.jobs.index'),
                    'name' => 'Pekerjaan',
                ],
                [
                    'name' => 'Edit',
                ],
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $req = $request->validate([
            'merchant_id' => 'required|exists:merchants,id',
            'position_id' => 'nullable|exists:positions,id',
            'description' => 'required|string',
            'slot' => 'required|numeric',
            'due_date' => 'required|date',
        ]);

        $job = Job::findOrFail($id);
        $job->update($req);

        return to_route('admin.jobs.index')->with('success', 'Berhasil memperbarui lowongan pekerjaan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $job = Job::findOrFail($id);
        $job->delete();

        return to_route('admin.jobs.index')->with('success', 'Berhasil menghapus lowongan pekerjaan.');
    }
}
