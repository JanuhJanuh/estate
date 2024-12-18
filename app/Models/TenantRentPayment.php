<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantRentPayment extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tenant_rent_payments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tenant_id',
        'room_id',
        'rent_paid',
        'rent_required',
        'payment_period_start',
        'payment_period_end',
        'next_payment_date',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'payment_period_start' => 'date',
        'payment_period_end' => 'date',
        'next_payment_date' => 'date',
        'rent_paid' => 'decimal:2',
        'rent_required' => 'decimal:2',
    ];

    /**
     * Relationship: Tenant
     *
     * Define a relationship with the Tenant model.
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    /**
     * Relationship: Room
     *
     * Define a relationship with the Room model.
     */
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    /**
     * Scope: Filter by Tenant
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $tenantId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForTenant($query, $tenantId)
    {
        return $query->where('tenant_id', $tenantId);
    }

    /**
     * Scope: Filter by Status
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Get the next rent payment due date.
     *
     * @param \App\Models\TenantRentPayment $payment
     * @return \Illuminate\Support\Carbon
     */
    public static function getNextPaymentDate($payment)
    {
        // Calculate the next payment date (you can customize the logic here)
        return $payment->payment_period_end->addMonth(); // Example: adding one month to the current period
    }
}
