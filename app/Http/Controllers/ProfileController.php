<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Post;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $request->user()->password = password_hash($_POST['password'],PASSWORD_DEFAULT);


        $request->user()->save();

        return Redirect::route('users.edit-profile');
    }

    public function updateAllIformations(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $request->user()->password = password_hash($_POST['password'],PASSWORD_DEFAULT);


        $request->user()->save();

        return redirect('admin/allusers/edit/profile');
    }

    public function editt(){

        $posts = Post::all();
        return view('edit')->with('user' , auth()->user());

    }


    public function edittAllInformation(){

        $posts = Post::all();
        return view('all-informations-edit')->with('user' , auth()->user());

    }
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


    public function showAllUsers(){

        $users = User::all();
        return view('users_editing')->with('users',$users);
    }


    public function deleteTheUser($id){
        $user = User::find($id);
        $user->delete();
        return redirect('admin/allusers/profile');

    }
}
