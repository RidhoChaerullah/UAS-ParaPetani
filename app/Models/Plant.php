<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Plant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type', // <-- Tambahkan ini
        'user_id',
        'planted_at',
    ];

    protected $casts = [
        'planted_at' => 'datetime',
    ];

    // Fungsi untuk mendapatkan estimasi hari panen berdasarkan tipe
    public function getMaturityDays(): int
    {
        switch ($this->type) {
            case 'jagung':
                return 85;
            case 'padi':
            default:
                return 90;
        }
    }
}
