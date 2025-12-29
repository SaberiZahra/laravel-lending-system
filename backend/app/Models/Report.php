<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'reporter_id',
        'target_user_id',
        'target_item_id',
        'target_listing_id',
        'target_loan_id',
        'type',
        'description',
        'evidence_json',
        'status',
    ];

    protected $casts = [
        'evidence_json' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function targetUser()
    {
        return $this->belongsTo(User::class, 'target_user_id');
    }

    public function targetItem()
    {
        return $this->belongsTo(Item::class, 'target_item_id');
    }

    public function targetListing()
    {
        return $this->belongsTo(Listing::class, 'target_listing_id');
    }

    public function targetLoan()
    {
        return $this->belongsTo(Loan::class, 'target_loan_id');
    }
}
