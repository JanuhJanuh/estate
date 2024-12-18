<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mpay extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mpay_table';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transaction_id',
        'phone_number',
        'room_number',
        'tenant_id',
        'room_id',
        'amount',
        'balance',
        'status',
        'transaction_date',
        'confirmationId_code',
        'description',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'balance' => 'decimal:2',
        'transaction_date' => 'datetime',
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
     * Get the most recent payment for the tenant.
     *
     * @param int $tenantId
     * @return \App\Models\Mpay|null
     */
    public static function getMostRecentPayment($tenantId)
    {
        return self::forTenant($tenantId)
            ->latest('transaction_date')
            ->first();
    }

    /**
     * Update the balance for a tenant after a payment.
     *
     * @param int $tenantId
     * @param float $paymentAmount
     * @return bool
     */
    public static function updateBalance($tenantId, $paymentAmount)
    {
        $payment = self::forTenant($tenantId)->latest('transaction_date')->first();

        if ($payment) {
            $newBalance = $payment->balance + $paymentAmount;
            return $payment->update(['balance' => $newBalance]);
        }

        return false;
    }
}
