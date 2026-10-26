<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'product_id' => 'nullable|exists:products,id',
            'message' => 'nullable|string',
        ]);

        $data['quantity'] = 1;
        $data['status'] = 'new';

        Inquiry::create($data);

        return back()->with('success', 'Thank you — we\'ll get back to you shortly.');
    }
}