<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tour extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'travel_id',
        'name',
        'starting_date',
        'ending_date',
        'price',
    ];

    protected $casts = [
        'price' => 'integer',
    ];

    const PER_PAGE = 10;

    public function travel(): BelongsTo
    {
        return $this->belongsTo(Travel::class);
    }

    public function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => number_format($value / 100, 2),
            set: fn ($value) => $value * 100
        );
    }

    public function startingDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('Y-m-d'),
        );
    }

    public function endingDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('Y-m-d'),
        );
    }
}
