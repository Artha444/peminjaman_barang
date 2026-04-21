<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $request->validate(['avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048']);
        $user = auth()->user();

        if ($request->hasFile('avatar')) {
            // Hapus foto lama jika ada
            if ($user->avatar && file_exists(public_path('storage/avatars/' . $user->avatar))) {
                unlink(public_path('storage/avatars/' . $user->avatar));
            }

            $fileName = time() . '.' . $request->avatar->extension();
            $request->avatar->move(public_path('storage/avatars'), $fileName);

            $user->update(['avatar' => $fileName]);
        }

        return back()->with('success', 'Foto profil berhasil diperbarui!');
    }
}
