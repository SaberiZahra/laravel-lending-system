<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Item;
use App\Models\Listing;
use App\Models\Loan;

class Report extends Model
{
    use HasFactory;

    /* ===================== CONSTANTS ===================== */

    // Status values
    public const STATUS_PENDING  = 'pending';
    public const STATUS_RESOLVED = 'resolved';
    public const STATUS_REJECTED = 'rejected';

    // Report types
    public const TYPE_USER    = 'user';
    public const TYPE_ITEM    = 'item';
    public const TYPE_LISTING = 'listing';
    public const TYPE_LOAN    = 'loan';

    /* ===================== FILLABLE ===================== */

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

    /* ===================== CASTS ===================== */

    protected $casts = [
        'evidence_json' => 'array',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
    ];

    /* ===================== DEFAULTS ===================== */

    protected $attributes = [
        'status' => self::STATUS_PENDING,
    ];

    /* ===================== RELATIONS ===================== */

    // User who submitted the report
    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    // Target user (if report is about a user)
    public function targetUser()
    {
        return $this->belongsTo(User::class, 'target_user_id');
    }

    // Target item
    public function targetItem()
    {
        return $this->belongsTo(Item::class, 'target_item_id');
    }

    // Target listing
    public function targetListing()
    {
        return $this->belongsTo(Listing::class, 'target_listing_id');
    }

    // Target loan
    public function targetLoan()
    {
        return $this->belongsTo(Loan::class, 'target_loan_id');
    }

    /* ===================== SCOPES ===================== */

    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeResolved($query)
    {
        return $query->where('status', self::STATUS_RESOLVED);
    }

    /* ===================== HELPERS ===================== */

    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isResolved(): bool
    {
        return $this->status === self::STATUS_RESOLVED;
    }

    public function targetType(): string
    {
        return $this->type;
    }

    public function target()
    {
        return match ($this->type) {
            self::TYPE_USER    => $this->targetUser,
            self::TYPE_ITEM    => $this->targetItem,
            self::TYPE_LISTING => $this->targetListing,
            self::TYPE_LOAN    => $this->targetLoan,
            default            => null,
        };
    }
}
