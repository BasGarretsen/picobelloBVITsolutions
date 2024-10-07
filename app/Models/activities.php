<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class activities extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_name', 'description', 'end_time', 'is_archived'
       
    ];

    // Query scope om alleen niet-gearchiveerde activiteiten die ouder zijn dan een bepaalde datum te vinden
    public function scopeOlderThan($query, $days)
    {
        return $query->where('end_time', '<', now()->subDays($days))
                     ->where('is_archived', false);
    }
}
