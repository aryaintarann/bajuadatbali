<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Setting';
        $setting = Setting::first();
        return view('setting.index', compact('setting', 'title'));
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
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $setting = Setting::find($id);
        $logo = $setting->logo_setting;
        $logo_login = $setting->logo_login_setting;
        $favicon = $setting->favicon_setting;
        $update = [
            'instansi_setting' => $request->instansi_setting,
            'pimpinan_setting' => $request->pimpinan_setting,
            'logo_setting' => $logo,
            'logo_login_setting' => $logo_login,
            'favicon_setting' => $favicon,
            'tentang_setting' => $request->tentang_setting,
            'misi_setting' => $request->misi_setting,
            'visi_setting' => $request->visi_setting,
            'keyword_setting' => $request->keyword_setting,
            'alamat_setting' => $request->alamat_setting,
            'instagram_setting' => $request->instagram_setting,
            'youtube_setting' =>$request->youtube_setting,
            'email_setting' => $request->email_setting,
            'no_hp_setting' => $request->no_hp_setting,
            'maps_setting' => $request->maps_setting,
        ];
        if ($request->logo_setting != ""){
            $request->logo_setting->move(public_path('logo/'),$logo);
        }
        if ($request->hasFile('logo_login_setting')) {
            $logo_login = time() . '_login.' . $request->logo_login_setting->extension();
            $request->logo_login_setting->move(public_path('logo/'), $logo_login);
            $update['logo_login_setting'] = $logo_login;
        }
        if ($request->favicon_setting != ""){
            $request->favicon_setting->move(public_path('favicon/'), $favicon);
        }
        $setting->update($update);
        return redirect()->back()->with('Sukses', 'Berhasil Edit Konfigurasi Website');
    }

    /**
     * Ubah password admin yang sedang login.
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password'          => ['required'],
            'new_password'              => ['required', 'confirmed', Password::min(8)],
            'new_password_confirmation' => ['required'],
        ], [
            'current_password.required'          => 'Password saat ini wajib diisi.',
            'new_password.required'              => 'Password baru wajib diisi.',
            'new_password.confirmed'             => 'Konfirmasi password tidak cocok.',
            'new_password.min'                   => 'Password baru minimal 8 karakter.',
            'new_password_confirmation.required' => 'Konfirmasi password wajib diisi.',
        ]);

        $user = Auth::user();

        // Verifikasi password lama
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()
                ->withErrors(['current_password' => 'Password saat ini tidak sesuai.'])
                ->withInput()
                ->with('tab', 'password');
        }

        $user->forceFill([
            'password' => Hash::make($request->new_password),
        ])->save();

        return redirect()->route('setting.index')
            ->with('Sukses', 'Password berhasil diperbarui.')
            ->with('tab', 'password');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
