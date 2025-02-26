<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

class MenuController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Simpan gambar jika ada
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('menu_images', 'public');
        }

        // Simpan menu
        $menu = Menu::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'gambar' => $gambarPath,
        ]);

        return response()->json(['message' => 'Menu berhasil ditambahkan', 'menu' => $menu], 201);
    }
    protected $middlewareGroups = [
        'api' => [
            EnsureFrontendRequestsAreStateful::class, // Tambahkan ini
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];
}

