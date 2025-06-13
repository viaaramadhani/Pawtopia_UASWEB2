<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use App\Models\User;
use App\Models\Adoption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewAdoptionRequest;

class AdoptionApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showAdoptForm(Cat $cat)
    {
        
        if ($cat->status !== 'available') {
            return redirect()->route('user.dashboard')
                ->with('error', 'Maaf, kucing ini tidak tersedia untuk adopsi.');
        }

        return view('user.adopt', compact('cat'));
    }

    public function create(Cat $cat)
    {
        
        if ($cat->status !== 'available') {
            return redirect()->route('cats.index')
                ->with('error', 'Maaf, kucing ini tidak tersedia untuk adopsi.');
        }

        return view('adoptions.apply', compact('cat'));
    }

    public function store(Request $request, Cat $cat)
    {
        
        if ($cat->status !== 'available') {
            return redirect()->route('cats.index')
                ->with('error', 'Maaf, kucing ini tidak lagi tersedia untuk adopsi.');
        }

        $validated = $request->validate([
            'adopter_phone' => 'required|string|max:20',
            'adopter_address' => 'required|string',
            'adopter_description' => 'nullable|string',
            'adopter_instagram' => 'nullable|string',
            'terms_agreement' => 'required',
        ]);

        try {
            
            $adoption = new Adoption();
            $adoption->cat_id = $cat->id;
            $adoption->user_id = Auth::id();
            $adoption->adopted_at = now();
            $adoption->adopter_name = Auth::user()->name;
            $adoption->adopter_email = Auth::user()->email;
            $adoption->adopter_phone = $validated['adopter_phone'];
            $adoption->adopter_address = $validated['adopter_address'];
            $adoption->adopter_description = $validated['adopter_description'] ?? '';
            $adoption->adopter_instagram = $validated['adopter_instagram'] ?? null;
            $adoption->status = 'pending';
            $adoption->save();


            $cat->status = 'in_process';
            $cat->save();

            $admins = User::where('role', 'admin')->get();

            if ($admins->isEmpty()) {
                Log::warning('No admin users found to notify about adoption request');
            }

            foreach ($admins as $admin) {
                Log::info('Sending notification to admin', ['admin_id' => $admin->id]);
                $admin->notify(new NewAdoptionRequest($adoption));
            }

            return redirect()->route('adoption.confirmation', ['cat' => $cat->id]);

        } catch (\Exception $e) {
            Log::error('Error creating adoption application', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
                'cat_id' => $cat->id
            ]);

            return back()->withInput()
                ->with('error', 'Terjadi kesalahan saat mengirim permintaan adopsi: ' . $e->getMessage());
        }
    }

    public function confirmation(Cat $cat)
    {
        return view('adoptions.confirmation', compact('cat'));
    }
}
