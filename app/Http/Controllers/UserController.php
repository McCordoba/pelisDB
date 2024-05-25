<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LikedMovie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Displays all the users
        // $users = User::all();

        // Displays a certain number of users per page
        // paginate() default value is 15
        $users = User::paginate(20);

        return view('users.userData', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fetch the user or fail if not found
        $user = User::findOrFail($id);

        // Fetch liked movies for the user
        $likedMovies = LikedMovie::where('user_id', $user->id)->get();

        return view('users.show', [
            'user' => $user,
            'likedMovies' => $likedMovies
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = Auth::user();
        
        return view('users.edit', [
            'user' => $user,
        ]);
    }

     /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $this->validator($request->all())->validate();

        if ($request->hasFile('image')) {
            // Store the image and get its path
            $imagePath = $request->file('image')->store('profile_images', 'public');

            // Delete the old image if it exists
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }

            // Update the user record with the new image path
            $user->image = $imagePath;
        }

        $user->update($request->only('name', 'email'));

        return redirect()->route('users.edit',  $user->id)->with('success', 'Profile updated successfully.');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
