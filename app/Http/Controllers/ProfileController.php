<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the user's profile.
     */
    public function edit()
    {
        $user = Auth::user();
        $role = $user->roles->first();

        return view('profile.edit', compact('user', 'role'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
            'current_password' => ['nullable', 'required_with:new_password'],
            'new_password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        // Update basic info
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'] ?? $user->phone;

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            // Store new photo
            $path = $request->file('photo')->store('profile-photos', 'public');
            $user->profile_photo_path = $path;
        }

        // Update password if provided
        if ($request->filled('current_password') && $request->filled('new_password')) {
            if (Hash::check($request->current_password, $user->password)) {
                $user->password = Hash::make($validated['new_password']);

                // Update password changed at timestamp
                $user->password_changed_at = now();
                $user->must_change_password = false;
            } else {
                return back()->withErrors([
                    'current_password' => 'The current password is incorrect.'
                ]);
            }
        }

        $user->save();

        return redirect()->route('profile.edit')
            ->with('success', 'Profile updated successfully.');
    }

    /**
     * Force password change for users with must_change_password flag
     */
    public function forcePasswordChange()
    {
        $user = Auth::user();

        if (!$user->must_change_password) {
            return redirect()->route('dashboard');
        }

        return view('auth.force-password-change', compact('user'));
    }

    /**
     * Update password for forced change
     */
    public function updateForcedPassword(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if (Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($validated['new_password']);
            $user->password_changed_at = now();
            $user->must_change_password = false;
            $user->save();

            return redirect()->route('dashboard')
                ->with('success', 'Password changed successfully. You can now access the system.');
        } else {
            return back()->withErrors([
                'current_password' => 'The current password is incorrect.'
            ]);
        }
    }

    /**
     * Show user activity/logs (optional feature)
     */
    public function activity()
    {
        $user = Auth::user();
        $role = $user->roles->first();

        // Get user's recent activity (you can implement this later)
        $activities = []; // Placeholder for now

        return view('profile.activity', compact('user', 'role', 'activities'));
    }

    /**
     * Show notification preferences
     */
    public function notifications()
    {
        $user = Auth::user();
        $role = $user->roles->first();

        return view('profile.notifications', compact('user', 'role'));
    }

    /**
     * Update notification preferences
     */
    public function updateNotifications(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'email_notifications' => ['boolean'],
            'sms_notifications' => ['boolean'],
            'push_notifications' => ['boolean'],
        ]);

        // Update notification preferences here
        // You can store these in a separate table or as JSON in the users table

        return redirect()->route('profile.notifications')
            ->with('success', 'Notification preferences updated successfully.');
    }
}
