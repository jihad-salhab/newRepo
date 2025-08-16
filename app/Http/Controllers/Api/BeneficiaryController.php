<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Beneficiary;
use Illuminate\Support\Facades\Storage;

class BeneficiaryController extends Controller
{
    // ✅ إضافة طلب مستفيد جديد
    public function store(Request $request)
    {
        $existing = Beneficiary::where('user_id', $request->user()->id)->first();
    if ($existing) {
        return response()->json(['message' => 'You already submitted a request'], 400);
    }
    
        $request->validate([
            'full_name' => 'required|string|max:255',
            'identity' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'family_members' => 'required|integer|min:1',
            'home_status' => 'required|boolean',
            'rent_document' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'health_status' => 'nullable|boolean',
            'discribe_status' => 'nullable|string',
            'city' => 'required|string|max:100',
            'address' => 'required|string'
        ]);

       
        $identityPath = $request->file('identity')->store('identities', 'public');
        $rentDocPath = $request->hasFile('rent_document') ? $request->file('rent_document')->store('rent_docs', 'public') : null;

        $beneficiary = Beneficiary::create([
            'user_id' => $request->user()->id,
            'full_name' => $request->full_name,
            'identity' => $identityPath,
            'family_members' => $request->family_members,
            'home_status' => $request->home_status,
            'rent_document' => $rentDocPath,
            'health_status' => $request->health_status ?? false,
            'discribe_status' => $request->discribe_status,
            'city' => $request->city,
            'address' => $request->address,
            'status' => 'pending'
        ]);

        return response()->json([
            'message' => 'Request submitted successfully',
            'data' => $beneficiary
        ]);
    }

    // ✅ عرض طلبات المستخدم
    public function myRequests(Request $request)
    {
        $requests = Beneficiary::where('user_id', $request->user()->id)->get();
        return response()->json($requests);
    }

    // ✅ قبول أو رفض طلب (لأدمن فقط)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected'
        ]);

        $beneficiary = Beneficiary::findOrFail($id);
        $beneficiary->status = $request->status;
        $beneficiary->approved_at = $request->status === 'approved' ? now() : null;
        $beneficiary->save();

        return response()->json(['message' => 'Status updated', 'data' => $beneficiary]);
    }
}