<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Laravel\Socialite\Facades\Socialite;

class loginController extends Controller
{
    // loggin page
    public function loginPage() {
        return view('login');
    }

    //redirect to auth login
    public function googleLogin() {
        return Socialite::driver('google')->redirect();
    }

    // auth user data
    public function userLogin() {
        try {
            $user = Socialite::driver('google')->user();
            $findUserByEmail = User::where('email', $user->email)->first();
            if ($findUserByEmail) {
                if ($findUserByEmail->google_id === $user->id) {
                    // Delete the old avatar if it exists
                    if ($findUserByEmail->avatar) {
                        $oldImagePath = public_path('profileImage/' . $findUserByEmail->avatar);
                        if (File::exists($oldImagePath)) {
                            File::delete($oldImagePath);
                        }
                    }

                    // Insert new image
                    $imageContents = file_get_contents($user->avatar);
                    if ($imageContents === false) {
                        return redirect()->route('loginPage')->with('err','Please try after sometimes !');
                    }
                    $filename = 'image_' . Str::random(10) . '.jpg';
                    $path = public_path('profileImage/' . $filename);
                    file_put_contents($path, $imageContents);

                    $findUserByEmail->update([
                        'avatar' => $filename,
                    ]);
                } else {
                    // Delete the old avatar if it exists
                    if ($findUserByEmail->avatar) {
                        $oldImagePath = public_path('profileImage/' . $findUserByEmail->avatar);
                        if (File::exists($oldImagePath)) {
                            File::delete($oldImagePath);
                        }
                    }
                    
                    // Insert new image
                    $imageContents = file_get_contents($user->avatar);
                    if ($imageContents === false) {
                        return redirect()->route('loginPage')->with('err','Please try after sometimes !');
                    }
                    $filename = 'image_' . Str::random(10) . '.jpg';
                    $path = public_path('profileImage/' . $filename);
                    file_put_contents($path, $imageContents);

                    $findUserByEmail->update([
                        'google_id' => $user->id,
                        'avatar' => $filename,
                    ]);
                }

                Auth::login($findUserByEmail);
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('loginPage')->with('err','Please contact support !');
            }
        } catch (Exception $e) {
            // dd($e->getMessage());
            return redirect()->route('loginPage')->with('err','Please try after sometimes !');
        }
    }
}
