<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\FoundationProfile;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'campaignsCount' => Campaign::count(),
            'totalRaised' => Donation::sum('amount'),
            'foundationsCount' => FoundationProfile::count(),
            'todayDonations' => Donation::whereDate('created_at', today())->count(),
            'recentDonations' => Donation::with(['user', 'campaign'])->latest()->take(5)->get(),
            'topCampaigns' => Campaign::with('foundationProfile')->orderBy('collected_amount', 'desc')->take(5)->get(),
            'campaignsChart' => $this->getCampaignsChartData()
        ];

        return view('dashboard', $data);
    }

    protected function getCampaignsChartData()
    {
        $campaigns = Campaign::with('donations')->orderBy('created_at')->take(6)->get();

        return (object) [
            'labels' => $campaigns->pluck('title'),
            'data' => $campaigns->pluck('collected_amount')
        ];
    }
}