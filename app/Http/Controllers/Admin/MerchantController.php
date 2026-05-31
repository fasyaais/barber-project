<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Merchant::select(['merchants.name','merchants.id','merchants.user_id','users.fullname as fullname','users.id as user_id'])->leftJoin('users','merchants.user_id','=','users.id')->orderByDesc('merchants.created_at')->get();
        // dd($data->first());
        return Inertia::render('admin/merchants/Index',[
            'data' =>$data,
            'breadcrumbs' => [
                [
                    'name' => "Gerai"
                ],
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
    */
    public function create()
    {
        $users = User::all();
        // dd($user);
        return Inertia::render('admin/merchants/Create',[
            'users' => $users,
            'breadcrumbs' => [
                [
                    'href' => route('admin.merchants.index'),
                    'name' => "Gerai"
                ],
                [
                    'name' => "Edit"
                ],
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => ['string','required','min:10'],
            'user_id' => ['exists:users,id','required'],
            'locate' => ['string','required'],
            'img'=>['image','required','min:10']
        ]);
        try {
            if ($request->hasFile('img')) {
                $path = $request->file('img')->store('merchants', 'public');
                $validated['img'] = $path;
            }
            Merchant::create($validated);
        } catch (\Throwable $th) {
            dd($th);
            return back()->with('error','Gagal menambahkan gerai baru.');
        }
        return to_route('admin.merchants.index')->with('success','Berhasil menambahkan gerai baru.');
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
        $data = Merchant::find($id);
        $users = User::all();
        $data->img = asset('storage/' . $data->img);
        return Inertia::render('admin/merchants/Edit',[
            'data'=> $data,
            'users' =>$users
        ]);
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
