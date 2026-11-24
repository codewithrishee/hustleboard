<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', [
            'user' => auth()->user()
        ]);
    }

  
public function update(Request $request)
{
    $user = $request->user();

    // Password change tabhi trigger hoga jab new password
    // ya confirmation field mein user kuch enter kare.
    $changePassword =
        $request->filled('new_password') ||
        $request->filled('new_password_confirmation');

    $rules = [
        'name' => ['required', 'string', 'max:255'],

        'email' => [
            'required',
            'email',
            'max:255',
            \Illuminate\Validation\Rule::unique('users', 'email')
                ->ignore($user->id),
        ],

        'profile_photo' => [
            'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:2048',
        ],
    ];

    if ($changePassword) {
        $rules['current_password'] = [
            'required',
            'current_password',
        ];

        $rules['new_password'] = [
            'required',
            'string',
            'min:8',
            'confirmed',
            'different:current_password',
        ];
    }

    $validated = $request->validate($rules);

    // Update basic information
    $user->name = $validated['name'];
    $user->email = $validated['email'];

    // Upload new profile photo
    $oldPhotoPath = $user->profile_photo;
    $newPhotoPath = null;

    if ($request->hasFile('profile_photo')) {
        $newPhotoPath = $request->file('profile_photo')
            ->store('profiles', 'public');

        if (!$newPhotoPath) {
            return back()->with('error', 'Profile photo upload failed. Please try again.');
        }

        $user->profile_photo = $newPhotoPath;
    }

    // Change password only when new password is entered
    if ($changePassword) {
        $user->password = \Illuminate\Support\Facades\Hash::make(
            $validated['new_password']
        );
    }

    // Save profile and password
    $user->save();

    // Delete old photo only after successful save
    if ($newPhotoPath && $oldPhotoPath) {
        \Illuminate\Support\Facades\Storage::disk('public')
            ->delete($oldPhotoPath);
    }

    return redirect()
        ->route('profile.edit')
        ->with('success', 'Profile updated successfully.');
}

}
