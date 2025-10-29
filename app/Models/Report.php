<?php

namespace App\Models;

use App\Enums\ReportStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 * @property string $title
 * @property string $description
 * @property string $location
 * @property ReportStatus|string $status
 * @property string|null $admin_response
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read User $user
 * @property-read Category $category
 */
class Report extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'location',
        'status',
        'admin_response',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'status' => ReportStatus::class,
        ];
    }

    /**
     * Get the user that owns the report
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that owns the report
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Check if report is pending
     */
    public function isPending(): bool
    {
        return $this->status === ReportStatus::Pending || $this->status === ReportStatus::Pending->value;
    }

    /**
     * Check if report is in progress
     */
    public function isInProgress(): bool
    {
        return $this->status === ReportStatus::InProgress || $this->status === ReportStatus::InProgress->value;
    }

    /**
     * Check if report is completed
     */
    public function isCompleted(): bool
    {
        return $this->status === ReportStatus::Completed || $this->status === ReportStatus::Completed->value;
    }

    /**
     * Check if report is rejected
     */
    public function isRejected(): bool
    {
        return $this->status === ReportStatus::Rejected || $this->status === ReportStatus::Rejected->value;
    }

    /**
     * Get status badge color
     */
    public function getStatusBadgeColor(): string
    {
        if ($this->status instanceof ReportStatus) {
            return $this->status->badgeColor();
        }

        return ReportStatus::from($this->status)->badgeColor();
    }

    /**
     * Get status label
     */
    public function getStatusLabel(): string
    {
        if ($this->status instanceof ReportStatus) {
            return $this->status->label();
        }

        return ReportStatus::from($this->status)->label();
    }
}
