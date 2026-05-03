<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // REGISTER — crée toujours un SYNDIC
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'syndic', // par défaut
        ]);

        Auth::login($user);

        return redirect()->route('dashboard.syndic');
    }
    public function login(Request $request)
{
    $credentials = $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        if ($user->role === 'syndic') {
            return redirect()->route('dashboard.syndic');
        } elseif ($user->role === 'resident') {
            return redirect()->route('dashboard.resident');
        }
    }

    return back()->withErrors([
        'email' => 'Identifiants incorrects.',
    ]);
}

}

