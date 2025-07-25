<?php

namespace App\Http\Controllers;

use App\Models\FoundationProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoundationProfileController extends Controller
{
    public function index()
    {
        $foundationProfiles = FoundationProfile::with('user', 'campaigns')
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('foundationProfiles.index', compact('foundationProfiles'));
    }

    public function create()
    {
        $users = User::doesntHave('foundationProfile')->get(); // Solo usuarios sin perfil
        return view('foundationProfiles.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:foundation_profiles,user_id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $validated;

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('foundation_logos', 'public');
            $data['logo'] = $path;
        }

        FoundationProfile::create($data);

        return redirect()->route('foundation-profiles.index') // ✅ Nombre correcto de la ruta
            ->with('success', 'Perfil de fundación creado exitosamente');
    }

    public function show($id)
    {
        $foundationProfile = FoundationProfile::with('user', 'campaigns')->findOrFail($id);
        return view('foundationProfiles.show', compact('foundationProfile'));
    }

    public function edit($id)
    {
        $foundationProfile = FoundationProfile::findOrFail($id);
        $users = User::all(); // Puedes filtrar si deseas evitar duplicados
        return view('foundationProfiles.edit', compact('foundationProfile', 'users'));
    }

    public function update(Request $request, $id)
    {
        $foundationProfile = FoundationProfile::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:foundation_profiles,user_id,' . $foundationProfile->id,
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $validated;

        if ($request->hasFile('logo')) {
            if ($foundationProfile->logo) {
                Storage::disk('public')->delete($foundationProfile->logo);
            }
            $path = $request->file('logo')->store('foundation_logos', 'public');
            $data['logo'] = $path;
        }

        $foundationProfile->update($data);

        return redirect()->route('foundation-profiles.show', $foundationProfile->id)
            ->with('success', 'Perfil de fundación actualizado exitosamente');
    }

    public function destroy($id)
    {
        $foundationProfile = FoundationProfile::findOrFail($id);

        if ($foundationProfile->logo) {
            Storage::disk('public')->delete($foundationProfile->logo);
        }

        $foundationProfile->delete();

        return redirect()->route('foundation-profiles.index')
            ->with('success', 'Perfil de fundación eliminado exitosamente');
    }
}
