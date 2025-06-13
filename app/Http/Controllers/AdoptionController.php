<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use App\Models\Cat;
use Illuminate\Http\Request;

class AdoptionController extends Controller
{
    public function index(Request $request)
    {
        
        $query = Adoption::with('cat');

        
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

       
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                // Cari berdasarkan nama kucing
                $q->whereHas('cat', function ($catQuery) use ($search) {
                    $catQuery->where('name', 'like', "%{$search}%");
                })
                    // Atau cari berdasarkan nama pengadopsi
                    ->orWhere('adopter_name', 'like', "%{$search}%")
                    // Atau cari berdasarkan nomor telepon pengadopsi
                    ->orWhere('adopter_phone', 'like', "%{$search}%");
            });
        }

    
        $adoptions = $query->latest('adopted_at')->paginate(10);

        // Hitung jumlah untuk setiap status (untuk kartu ringkasan)
        $pendingCount = Adoption::where('status', 'pending')->count();
        $approvedCount = Adoption::where('status', 'approved')->count();
        $rejectedCount = Adoption::where('status', 'rejected')->count();

        return view('adoptions.index', compact('adoptions', 'pendingCount', 'approvedCount', 'rejectedCount'));
    }

    public function create()
    {
        $cats = Cat::all();
        return view('adoptions.form', compact('cats'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cat_id' => 'required|exists:cats,id',
            'adopted_at' => 'required|date',
            'adopter_name' => 'required|string|max:255',
            'adopter_phone' => 'required|string',
            'adopter_address' => 'required|string',
            'adopter_description' => 'nullable|string',
            'adopter_instagram' => 'nullable|string',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        Adoption::create($validated);

        return redirect()->route('adoptions.index')->with('success', 'Data adopsi berhasil disimpan!');
    }
    /**
     * Update the specified adoption in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Adoption  $adoption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Adoption $adoption)
    {
        // Log debugging info
        \Log::info('Adoption update request received', [
            'adoption_id' => $adoption->id,
            'status' => $request->input('status')
        ]);

        // Validate the request
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        // Get the old status for comparison
        $oldStatus = $adoption->status;

        // Update the adoption status
        $adoption->status = $validated['status'];
        $adoption->save();

        // Update the cat's status based on adoption status
        $cat = Cat::findOrFail($adoption->cat_id);
        if ($validated['status'] === 'approved') {
            $cat->status = 'adopted';
            $cat->save();

            // Reject other pending adoptions for this cat
            Adoption::where('cat_id', $cat->id)
                ->where('id', '!=', $adoption->id)
                ->where('status', 'pending')
                ->update(['status' => 'rejected']);
        } elseif ($validated['status'] === 'rejected' && $oldStatus === 'pending') {
            // Only reset cat to available if this was a pending adoption that was rejected
            $cat->status = 'available';
            $cat->save();
        }

        // Send notification if status changed
        if ($oldStatus !== $validated['status']) {
            $user = \App\Models\User::find($adoption->user_id);
            if ($user) {
                $user->notify(new \App\Notifications\AdoptionStatusChanged($adoption));
            }
        }

        return redirect()->route('adoptions.index')
            ->with('success', 'Status adopsi berhasil diperbarui menjadi ' . ucfirst($validated['status']));
    }

    public function edit(Adoption $adoption)
    {
        $cats = Cat::all();
        return view('adoptions.form', compact('adoption', 'cats'));
    }

    public function show($id)
    {
        $adoption = Adoption::findOrFail($id);


        return view('adoptions.show', compact('adoption'));
    }


    public function destroy(Adoption $adoption)
    {
        $adoption->delete();
        return back()->with('success', 'Adopsi berhasil dihapus');
    }
}
