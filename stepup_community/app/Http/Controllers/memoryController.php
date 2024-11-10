<?php

namespace App\Http\Controllers;

use App\Models\Memorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class memoryController extends Controller
{
    public function addMemory(Request $request) {
        $request->validate([
            'memory_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Get the authenticated user ID
        $userId = Auth::user()->uid;
        $uniqueMid = "MID_".uniqid();
        if ($request->hasFile('memory_image')) {
            $image = $request->file('memory_image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('memoryImage'), $imageName);
            $memory_image = $imageName;
            $data = [
                'uid' => $userId,
                'm_id' => $uniqueMid,
                'memory_image' => $memory_image,
            ];

            $createMemory = Memorie::create($data);
            if ($createMemory) {
                return response()->json(['message' => 'Memory created successfully!']);
            } else {
                return response()->json(['message' => 'Faild to create Memory!']);
            }
        }
    }

    // show memory
    public function loadMemory(Request $request) {
        $memory_id = $request->memory_id;
        $memories = Memorie::where('m_id',$memory_id)
                    ->where('memories.created_at', '>=', now()->subDay())
                    ->join('users','memories.uid','users.uid')
                    ->orderBy('memories.created_at', 'desc')->first();
        $html = view('Render.memory', compact(['memories']))->render();
        if (!$html) {
            return response()->json(['message'=>'No Memory Found !']);
        } else {
            return response()->json(['message'=>'success','html' => $html]);
        }
    }
}
