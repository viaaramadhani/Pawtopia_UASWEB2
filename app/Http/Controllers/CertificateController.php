<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function generate(Adoption $adoption)
    {
        
        if (auth()->user()->id !== $adoption->user_id && auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

       
        if ($adoption->status !== 'approved') {
            return back()->with('error', 'Sertifikat hanya tersedia untuk adopsi yang disetujui.');
        }

        
        if (!$adoption->certificate_generated) {
            $adoption->certificate_generated = true;
            $adoption->save();
        }

       
        $data = [
            'adoption' => $adoption,
            'cat' => $adoption->cat,
            'user' => $adoption->user,
            'certificate_id' => 'PWC-' . str_pad($adoption->id, 5, '0', STR_PAD_LEFT),
            'issue_date' => now()->format('d M Y')
        ];

        $pdf = PDF::loadView('certificates.adoption', $data)->setPaper('a4', 'landscape');

        return $pdf->download('Sertifikat_Adopsi_' . $adoption->cat->name . '.pdf');
    }
}
