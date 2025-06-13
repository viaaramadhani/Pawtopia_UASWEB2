<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use App\Models\User;
use App\Models\Adoption;
use App\Notifications\NewAdoptionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserAdoptionController extends Controller
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

    public function submitAdoptForm(Request $request, Cat $cat)
    {
       
        $validated = $request->validate([
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'reason' => 'required|string|min:10',
            'agreement' => 'required',
        ]);

        try {
            
            $adoption = new Adoption();
            $adoption->cat_id = $cat->id;
            $adoption->user_id = Auth::id();
            $adoption->adopted_at = now();
            $adoption->adopter_name = Auth::user()->name;
            $adoption->adopter_phone = $validated['phone'];
            $adoption->adopter_address = $validated['address'];
            $adoption->adopter_description = $validated['reason'];
            $adoption->status = 'pending'; 
            $adoption->save();

            
            $cat->status = 'in_process';
            $cat->save();

            $admins = User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                $admin->notify(new NewAdoptionRequest($adoption));
            }


            Log::info('User adoption request submitted', [
                'user_id' => Auth::id(),
                'cat_id' => $cat->id,
                'adoption_id' => $adoption->id
            ]);

            return redirect()->route('user.dashboard')
                ->with('success', 'Permintaan adopsi untuk ' . $cat->name . ' berhasil dikirim! Silakan tunggu konfirmasi dari admin.');

        } catch (\Exception $e) {
            Log::error('Error submitting adoption request', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
                'cat_id' => $cat->id
            ]);

            return back()->withInput()
                ->with('error', 'Terjadi kesalahan saat mengirim permintaan adopsi. Silakan coba lagi.');
        }
    }
}
