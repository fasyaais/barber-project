<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Merchant;
use App\Models\Pelamar;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $weekAgo = now()->subWeek();

        $stats = [
            ['key' => 'merchants', 'title' => 'Total Gerai', 'value' => Merchant::count(), 'change' => '+'.Merchant::where('created_at', '>=', $weekAgo)->count().' minggu ini'],
            ['key' => 'users', 'title' => 'Total Pengguna', 'value' => User::count(), 'change' => '+'.User::where('created_at', '>=', $weekAgo)->count().' minggu ini'],
            ['key' => 'products', 'title' => 'Total Produk', 'value' => Product::count(), 'change' => '+'.Product::where('created_at', '>=', $weekAgo)->count().' minggu ini'],
            ['key' => 'jobs', 'title' => 'Total Lowongan', 'value' => Job::count(), 'change' => '+'.Job::where('created_at', '>=', $weekAgo)->count().' minggu ini'],
        ];

        $recentActivities = collect()
            ->concat(Merchant::latest()->limit(3)->get()->map(fn ($m) => ['title' => "Gerai baru ditambahkan: {$m->name}", 'created_at' => $m->created_at]))
            ->concat(Product::latest()->limit(3)->get()->map(fn ($p) => ['title' => "Produk baru dipublish: {$p->name}", 'created_at' => $p->created_at]))
            ->concat(Job::latest()->limit(3)->get()->map(fn ($j) => ['title' => 'Lowongan pekerjaan diperbarui', 'created_at' => $j->created_at]))
            ->concat(Pelamar::latest()->limit(3)->get()->map(fn ($p) => ['title' => "Pelamar baru: {$p->name}", 'created_at' => $p->created_at]))
            ->concat(Service::latest()->limit(3)->get()->map(fn ($s) => ['title' => "Layanan baru ditambahkan: {$s->name}", 'created_at' => $s->created_at]))
            ->concat(User::latest()->limit(3)->get()->map(fn ($u) => ['title' => "Pengguna baru terdaftar: {$u->fullname}", 'created_at' => $u->created_at]))
            ->sortByDesc('created_at')
            ->take(6)
            ->values();

        $latestPelamar = Pelamar::with(['job.position'])->latest()->first();

        return Inertia::render('admin/AdminHome', [
            'stats' => $stats,
            'recentActivities' => $recentActivities,
            'latestPelamar' => $latestPelamar ? [
                'id' => $latestPelamar->id,
                'name' => $latestPelamar->name,
                'job' => $latestPelamar->job?->position?->name ?? 'Lowongan',
            ] : null,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
