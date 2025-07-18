<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'foundation_profile_id', 'category_id', 'title',
        'description', 'goal_amount', 'collected_amount', 'deadline'
    ];

    public function foundationProfile()
    {
        return $this->belongsTo(FoundationProfile::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}
