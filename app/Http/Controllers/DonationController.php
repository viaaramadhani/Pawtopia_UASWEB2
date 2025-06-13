<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index()
    {
        return view('donation');
    }

    public function process(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|in:credit_card,paypal,bank_transfer',
            'message' => 'nullable|string',
        ]);

        

        return redirect()->route('donation')->with('success', 'Thank you for your donation of $' . $validated['amount'] . '! Your support means the world to our cats.');
    }
}
