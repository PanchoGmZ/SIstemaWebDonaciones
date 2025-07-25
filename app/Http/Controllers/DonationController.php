<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Campaign;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::with(['user', 'campaign'])
                             ->orderBy('created_at', 'desc')
                             ->paginate(10);

        return view('donations.index', compact('donations'));
    }

    public function create()
    {
        $users = User::all();
        $campaigns = Campaign::all();

        return view('donations.create', compact('users', 'campaigns'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'campaign_id' => 'required|exists:campaigns,id',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $campaign = Campaign::findOrFail($validated['campaign_id']);

        $donation = Donation::create($validated);

        // Actualizar monto recolectado
        $campaign->collected_amount += $validated['amount'];
        $campaign->save();

        return redirect()->route('donations.index')
                         ->with('success', 'Donación creada exitosamente');
    }

    public function show($id)
    {
        $donation = Donation::with(['user', 'campaign'])->findOrFail($id);

        return view('donations.show', compact('donation'));
    }

    public function edit($id)
    {
        $donation = Donation::findOrFail($id);
        $users = User::all();
        $campaigns = Campaign::all();

        return view('donations.edit', compact('donation', 'users', 'campaigns'));
    }

    public function update(Request $request, $id)
    {
        $donation = Donation::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'campaign_id' => 'required|exists:campaigns,id',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $oldAmount = $donation->amount;
        $oldCampaignId = $donation->campaign_id;

        $donation->update($validated);

        // Ajustar monto en campañas
        if ($oldCampaignId == $validated['campaign_id']) {
            $campaign = Campaign::findOrFail($oldCampaignId);
            $difference = $validated['amount'] - $oldAmount;
            $campaign->collected_amount += $difference;
            $campaign->save();
        } else {
            // Si cambió de campaña
            $oldCampaign = Campaign::findOrFail($oldCampaignId);
            $oldCampaign->collected_amount -= $oldAmount;
            $oldCampaign->save();

            $newCampaign = Campaign::findOrFail($validated['campaign_id']);
            $newCampaign->collected_amount += $validated['amount'];
            $newCampaign->save();
        }

        return redirect()->route('donations.show', $donation->id)
                         ->with('success', 'Donación actualizada exitosamente');
    }

    public function destroy($id)
    {
        $donation = Donation::findOrFail($id);

        $campaign = Campaign::find($donation->campaign_id);
        if ($campaign) {
            $campaign->collected_amount -= $donation->amount;
            $campaign->save();
        }

        $donation->delete();

        return redirect()->route('donations.index')
                         ->with('success', 'Donación eliminada exitosamente');
    }
}
