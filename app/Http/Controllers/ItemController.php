<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'hpj' => 'required|numeric|min:0',
            'hpb' => 'required|numeric|min:0',
            'hpf' => 'nullable|numeric|min:0',
        ]);

        Item::create([
            'name' => $request->name,
            'hpj' => $request->hpj,
            'hpb' => $request->hpb,
            'hpf' => $request->hpf ?? 0,
        ]);

        return redirect()->route('items.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'hpj' => 'required|numeric|min:0',
            'hpb' => 'required|numeric|min:0',
            'hpf' => 'nullable|numeric|min:0',
        ]);

        $item = Item::findOrFail($id);
        $item->update($request->only(['name', 'hpj', 'hpb', 'hpf']));

        return redirect()->route('items.index')->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Item::findOrFail($id)->delete();
        return redirect()->route('items.index')->with('success', 'Barang berhasil dihapus!');
    }
}
