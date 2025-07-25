<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\FoundationProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Rutas para Usuarios
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/', [UserController::class, 'store'])->name('users.store');
    Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/{id}/donations', [UserController::class, 'donations'])->name('users.donations');
    Route::get('/{id}/foundation-profile', [UserController::class, 'foundationProfile'])->name('users.foundationProfile');
});

// Rutas para Campañas
Route::prefix('campaigns')->group(function () {
    Route::get('/', [CampaignController::class, 'index'])->name('campaigns.index');
    Route::get('/create', [CampaignController::class, 'create'])->name('campaigns.create');
    Route::post('/', [CampaignController::class, 'store'])->name('campaigns.store');
    Route::get('/{id}', [CampaignController::class, 'show'])->name('campaigns.show');
    Route::get('/{id}/edit', [CampaignController::class, 'edit'])->name('campaigns.edit');
    Route::put('/{id}', [CampaignController::class, 'update'])->name('campaigns.update');
    Route::delete('/{id}', [CampaignController::class, 'destroy'])->name('campaigns.destroy');
    Route::get('/foundation/{foundationProfileId}', [CampaignController::class, 'getByFoundation'])->name('campaigns.byFoundation');
    Route::get('/category/{categoryId}', [CampaignController::class, 'getByCategory'])->name('campaigns.byCategory');
    Route::get('/active', [CampaignController::class, 'getActiveCampaigns'])->name('campaigns.active');
    Route::post('/{campaignId}/update-amount', [CampaignController::class, 'updateCollectedAmount'])->name('campaigns.updateAmount');
});

// Rutas para Categorías
Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/{id}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('/{id}/campaigns', [CategoryController::class, 'campaigns'])->name('categories.campaigns');
});

// Rutas para Donaciones
Route::prefix('donations')->group(function () {
    Route::get('/', [DonationController::class, 'index'])->name('donations.index');
    Route::get('/create', [DonationController::class, 'create'])->name('donations.create');
    Route::post('/', [DonationController::class, 'store'])->name('donations.store');
    Route::get('/{id}', [DonationController::class, 'show'])->name('donations.show');
    Route::get('/{id}/edit', [DonationController::class, 'edit'])->name('donations.edit');
    Route::put('/{id}', [DonationController::class, 'update'])->name('donations.update');
    Route::delete('/{id}', [DonationController::class, 'destroy'])->name('donations.destroy');
    Route::get('/user/{userId}', [DonationController::class, 'getByUser'])->name('donations.byUser');
    Route::get('/campaign/{campaignId}', [DonationController::class, 'getByCampaign'])->name('donations.byCampaign');
});

// Rutas para Perfiles de Fundación
Route::prefix('foundation-profiles')->group(function () {
    Route::get('/', [FoundationProfileController::class, 'index'])->name('foundation-profiles.index');
    Route::get('/create', [FoundationProfileController::class, 'create'])->name('foundation-profiles.create');
    Route::post('/', [FoundationProfileController::class, 'store'])->name('foundation-profiles.store');
    Route::get('/{id}', [FoundationProfileController::class, 'show'])->name('foundation-profiles.show');
    Route::get('/{id}/edit', [FoundationProfileController::class, 'edit'])->name('foundation-profiles.edit');
    Route::put('/{id}', [FoundationProfileController::class, 'update'])->name('foundation-profiles.update');
    Route::delete('/{id}', [FoundationProfileController::class, 'destroy'])->name('foundation-profiles.destroy');
    Route::get('/user/{userId}', [FoundationProfileController::class, 'getByUser'])->name('foundation-profiles.byUser');
    Route::get('/{id}/campaigns', [FoundationProfileController::class, 'getCampaigns'])->name('foundation-profiles.campaigns');
});