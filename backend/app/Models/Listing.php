<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'item_id',
        'title',
        'description',
        'daily_fee',
        'deposit_amount',
        'available_from',
        'available_until',
        'status',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
