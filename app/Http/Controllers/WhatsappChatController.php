<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WhatsappChat;
use Illuminate\Support\Facades\Auth;

class WhatsappChatController extends Controller
{
    public function log(Request $request)
    {
        $request->validate([
            'shop_id' => 'required|exists:shops,id',
            'product_id' => 'nullable|exists:products,id',
            'message' => 'nullable|string',
        ]);

        if (Auth::check()) {
            WhatsappChat::create([
                'user_id' => Auth::id(),
                'shop_id' => $request->shop_id,
                'product_id' => $request->product_id,
                'message' => $request->message,
            ]);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Unauthenticated'], 401);
    }
}
