<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\FoundationProfile;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::with(['foundationProfile', 'category'])
                           ->orderBy('created_at', 'desc')
                           ->paginate(10);
        
        return view('campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        $foundations = FoundationProfile::all();
        $categories = Category::all();
        return view('campaigns.create', compact('foundations', 'categories'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'foundation_profile_id' => 'required|exists:foundation_profiles,id',
        'category_id' => 'required|exists:categories,id',
        'title' => 'required|string|min:3|max:255',
        'description' => 'required|string|min:10',
        'goal_amount' => 'required|numeric|min:0',
        'deadline' => 'required|date|after:today',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $request->except('image');
    $data['collected_amount'] = 0;

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('campaigns', 'public');
        $data['image_url'] = $path;
    }

    Campaign::create($data);

    return redirect()->route('campaigns.index')
                   ->with('success', 'Campaña creada exitosamente');
}

    public function show($id)
    {
        $campaign = Campaign::with(['foundationProfile', 'category', 'donations'])
                          ->findOrFail($id);

        return view('campaigns.show', compact('campaign'));
    }

    public function edit($id)
    {
        $campaign = Campaign::findOrFail($id);
        $foundations = FoundationProfile::all();
        $categories = Category::all();
        
        return view('campaigns.edit', compact('campaign', 'foundations', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'foundation_profile_id' => 'required|exists:foundation_profiles,id',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:10',
            'goal_amount' => 'required|numeric|min:0',
            'deadline' => 'required|date|after:today',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $campaign = Campaign::findOrFail($id);
        $data = $validated;

        // Manejo de la imagen
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($campaign->image_url) {
                Storage::disk('public')->delete($campaign->image_url);
            }
            $path = $request->file('image')->store('campaigns', 'public');
            $data['image_url'] = $path;
        }

        $campaign->update($data);

        return redirect()->route('campaigns.show', $campaign->id)
                       ->with('success', 'Campaña actualizada exitosamente');
    }

    public function destroy($id)
    {
        $campaign = Campaign::findOrFail($id);
        
        // Eliminar imagen asociada si existe
        if ($campaign->image_url) {
            Storage::disk('public')->delete($campaign->image_url);
        }
        
        $campaign->delete();

        return redirect()->route('campaigns.index')
                       ->with('success', 'Campaña eliminada exitosamente');
    }
}