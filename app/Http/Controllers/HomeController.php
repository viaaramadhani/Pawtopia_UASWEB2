<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cat;
use App\Models\Adoption;

class HomeController extends Controller
{
   

    public function dashboard()
    {
        $user = auth()->user();

        $userAdoptions = collect([]);
        $notifications = collect([]);

        try {
            
            $featuredCats = Cat::where('status', 'available')
                ->latest()
                ->get() ?? collect([]);

            
            $userAdoptions = Adoption::where('user_id', $user->id)
                ->with('cat')
                ->latest('adopted_at')
                ->get() ?? collect([]);

            $notifications = $user->notifications ?? collect([]);

        } catch (\Exception $e) {
            
            \Log::error('Error fetching data: ' . $e->getMessage());
            $featuredCats = collect([]);
        }

        
        $recentCats = $featuredCats->take(5);

       
        $stats = [
            'total_cats' => Cat::count() ?? 0,
            'adopted_cats' => Adoption::where('status', 'approved')->count() ?? 0,
            'pending_adoptions' => Adoption::where('status', 'pending')->count() ?? 0,
        ];

        return view('user.dashboard', compact(
            'featuredCats',
            'recentCats',
            'userAdoptions',
            'notifications',
            'stats'
        ));
    }

   
}