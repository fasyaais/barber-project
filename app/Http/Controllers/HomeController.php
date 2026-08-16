<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Merchant;
use App\Models\Pelamar;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function __invoke(): Response
    {
        $products = Product::all()->map(fn ($p) => [
            'name' => $p->name,
            'price' => $p->price,
            'desc' => $p->description,
            'image' => asset('storage/'.$p->image),
        ])->values();

        $jobs = Job::with('position')->where('status', 'available')->get()->map(fn ($j) => [
            'title' => $j->position?->name ?? 'Lowongan',
            'type' => $j->type,
            'loc' => $j->loc,
            'salary' => $j->salary,
            'desc' => $j->description,
        ])->values();

        $locations = Merchant::all()->map(function ($m) {
            return [
                'name' => $m->name,
                'address' => $m->locate,
                'image' => $m->img && Storage::disk('public')->exists($m->img) ? asset('storage/'.$m->img) : null,
                'link' => $m->maps_link,
            ];
        })->values();

        $services = Service::all()->map(function ($s) {
            return [
                'name' => $s->name,
                'desc' => $s->description,
                'image' => $s->img && Storage::disk('public')->exists($s->img) ? asset('storage/'.$s->img) : null,
            ];
        })->values();

        $stats = [
            ['value' => Merchant::count(), 'label' => 'Gerai'],
            ['value' => Job::where('status', 'available')->count(), 'label' => 'Lowongan'],
            ['value' => Product::count(), 'label' => 'Produk'],
            ['value' => Pelamar::count(), 'label' => 'Pelamar'],
        ];

        return Inertia::render('Home', [
            'products' => $products,
            'jobs' => $jobs,
            'locations' => $locations,
            'services' => $services,
            'stats' => $stats,
        ]);
    }

    public function locations(): Response
    {
        $locations = Merchant::all()->map(function ($m) {
            return [
                'name' => $m->name,
                'address' => $m->locate,
                'image' => $m->img && Storage::disk('public')->exists($m->img) ? asset('storage/'.$m->img) : null,
                'link' => $m->maps_link,
            ];
        })->values();

        return Inertia::render('Locations', [
            'locations' => $locations,
        ]);
    }

    public function careers(): Response
    {
        return Inertia::render('Careers');
    }
}
