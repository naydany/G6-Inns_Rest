<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RegisterUserServiceController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'profile' => $request->profile,
                'password' => Hash::make($request->password),
            ]);


            // Set role user
            $roles = Role::all();
            $user->syncRoles($roles[1]->id);

            // Set specific permissions to the user
            $user->givePermissionTo(['Chat access', 'Chat user', 'Request_account_service access', 'Request_account_service create','Dashboard_service access','Dashboard access']);

            // Switch to the account auto
            event(new Registered($user));
            Auth::login($user);
            return redirect(RouteServiceProvider::ADMIN_HOME);
        } catch (\Throwable $th) {
            return back()->with('message', 'Your password is not match please try again');
        }
    }
}
