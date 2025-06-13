<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CatController extends Controller
{
    public function index(Request $request)
    {
       
        $query = Cat::query();

        
        if (!auth()->user() || auth()->user()->role !== 'admin') {
            $query->whereDoesntHave('adoptions', function ($q) {
                $q->where('status', 'approved');
            })->where('status', 'available');
        }

        
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%')
                    ->orWhere('ras', 'like', '%' . $request->search . '%');
            });
        }

        $cats = $query->latest()->paginate(12);
        $allCats = Cat::all(); 

        $totalCats = Cat::count();
        $availableCount = Cat::where('status', 'available')->count();

        $adoptedCount = 0;
        $pendingCount = 0;
        $unavailableCount = 0;

        try {
            if (class_exists('\App\Models\Adoption')) {
                $adoptedCount = \App\Models\Adoption::where('status', 'approved')->count();
                $pendingCount = \App\Models\Adoption::where('status', 'pending')->count();
                $unavailableCount = Cat::where('status', '!=', 'available')->count();
            }
        } catch (\Exception $e) {
            
            \Log::error('Error counting adoptions: ' . $e->getMessage());
        }

        
        $userAdoptions = [];

        return view('cats.index', compact(
            'cats',
            'allCats',
            'totalCats',
            'availableCount',
            'adoptedCount',
            'pendingCount',
            'unavailableCount',
            'userAdoptions'
        ));
    }

    public function create()
    {
        return view('cats.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'ras' => 'nullable|string|max:255',
            'age' => 'required|numeric',
            'gender' => 'required|in:jantan,betina',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only('name', 'ras', 'age', 'gender', 'description');

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('cats', 'public');
        }

        Cat::create($data);

        return redirect()->route('cats.index')->with('success', 'Kucing berhasil ditambahkan');
    }

    public function show(Cat $cat)
    {
        return view('cats.show', compact('cat'));
    }

    public function edit($id)
    {
        $cat = Cat::findOrFail($id);
        return view('cats.form', compact('cat'));
    }

    public function update(Request $request, $id)
    {
        $cat = Cat::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'ras' => 'nullable|string|max:255',
            'age' => 'required|integer',
            'gender' => 'required|in:jantan,betina',
            'description' => 'nullable|string',
        ]);

        $cat->update($validatedData);

        return redirect()->route('cats.index')->with('success', 'Kucing berhasil diperbarui');
    }

    public function destroy(Cat $cat)
    {
        if ($cat->photo && Storage::exists('public/' . $cat->photo)) {
            Storage::delete('public/' . $cat->photo);
        }

        $cat->delete();

        return back()->with('success', 'Yah, Kucing berhasil dihapus');
    }
}
