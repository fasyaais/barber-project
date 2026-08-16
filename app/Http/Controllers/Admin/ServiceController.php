<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Service::all()->map(function ($service) {
            $service->img = $service->img && Storage::disk('public')->exists($service->img) ? asset('storage/'.$service->img) : null;

            return $service;
        });

        return Inertia::render('admin/services/Index', [
            'data' => $data,
            'breadcrumbs' => [
                [
                    'name' => 'Layanan',
                ],
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('admin/services/Create', [
            'breadcrumbs' => [
                [
                    'href' => route('admin.services.index'),
                    'name' => 'Layanan',
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
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'img' => ['required', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('img')) {
            $validated['img'] = $request->file('img')->store('services', 'public');
        }

        Service::create($validated);

        return to_route('admin.services.index')->with('success', 'Berhasil menambahkan layanan.');
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
        $data = Service::findOrFail($id);
        $data->img = $data->img && Storage::disk('public')->exists($data->img) ? asset('storage/'.$data->img) : null;

        return Inertia::render('admin/services/Edit', [
            'data' => $data,
            'breadcrumbs' => [
                [
                    'href' => route('admin.services.index'),
                    'name' => 'Layanan',
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
        $service = Service::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        if ($request->hasFile('img')) {
            $request->validate(['img' => ['image', 'max:2048']]);

            if ($service->img && Storage::disk('public')->exists($service->img)) {
                Storage::disk('public')->delete($service->img);
            }

            $validated['img'] = $request->file('img')->store('services', 'public');
        }

        $service->update($validated);

        return to_route('admin.services.index')->with('success', 'Berhasil memperbarui layanan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);

        if ($service->img && Storage::disk('public')->exists($service->img)) {
            Storage::disk('public')->delete($service->img);
        }

        $service->delete();

        return to_route('admin.services.index')->with('success', 'Berhasil menghapus layanan.');
    }
}
