<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::where('email', $googleUser->getEmail())->first();

        $avatarUrl = $googleUser->getAvatar();

        if($avatarUrl){
            $imageContents = Http::get($avatarUrl)->body();

            $filename = 'profile_pictures/' . Str::random(40) . '.jpg';

            Storage::disk('s3')->put($filename, $imageContents);
        }

        if (!$user) {
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => bcrypt(uniqid()),
                'profilePicture' => $filename,
                'role' => 'student',
                'phoneNumber' => '-',
            ]);

            Student::create([
                'id' => $user->id,
            ]);
        }

        Auth::login($user);

        return redirect('/');
    }
}
