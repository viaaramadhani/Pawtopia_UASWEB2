<?php

namespace App\Http\Controllers;

use App\Models\Shelter;
use Illuminate\Http\Request;

class ShelterController extends Controller
{
    public function index(Request $request)
    {
        
        $query = Shelter::query();

        if ($request->has('location') && $request->location != '') {
            $query->where('location', $request->location);
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('contact', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $shelters = $query->latest()->paginate(9);

        $locations = Shelter::distinct()->pluck('location')->toArray();

        return view('shelters.index', compact('shelters', 'locations'));
    }

    public function create()
    {
        return view('shelters.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'contact' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        Shelter::create($request->only('name', 'location', 'contact', 'description'));

        return redirect()->route('shelters.index')->with('success', 'Shelter berhasil ditambahkan');
    }

    public function show(Shelter $shelter)
    {
        return view('shelters.show', compact('shelter'));
    }

    public function edit(Shelter $shelter)
    {
        return view('shelters.form', compact('shelter'));
    }

    public function update(Request $request, Shelter $shelter)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'contact' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $shelter->update($request->only('name', 'location', 'contact', 'description'));

        return redirect()->route('shelters.index')->with('success', 'Shelter berhasil diperbarui');
    }

    public function destroy(Shelter $shelter)
    {
        $shelter->delete();

        return back()->with('success', 'Shelter berhasil dihapus');
    }
}
