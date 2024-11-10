<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Destroy an authenticated session.
     */
    public function destroy() {
        Auth::guard('web')->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('loginPage');
    }
}
