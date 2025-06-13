<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cat;
use App\Models\Adoption;

class UserDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function landing()
    {
      
        $recentAdoptions = Adoption::where('status', 'approved')
            ->with('cat')
            ->latest('adopted_at')
            ->take(3)
            ->get();

        return view('user.landing', compact('recentAdoptions'));
    }

    public function index()
    {
       
        $featuredCats = Cat::where('status', 'available')
            ->latest()
            ->get() ?? collect([]);


        $recentCats = Cat::where('status', 'available')
            ->latest()
            ->take(5)
            ->get() ?? collect([]);

        
        $userAdoptions = [];
        if (Auth::check()) {
            $userAdoptions = Adoption::where('user_id', Auth::id())
                ->with('cat')
                ->get();
        }

        // Get adoption stats
        $stats = [
            'total_cats' => Cat::count(),
            'adopted_cats' => Adoption::where('status', 'approved')->count(),
            'pending_adoptions' => Adoption::where('status', 'pending')->count(),
        ];

        return view('user.dashboard', compact('featuredCats', 'recentCats', 'userAdoptions', 'stats'));
    }
}
