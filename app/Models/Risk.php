<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Risk extends Model
{
    protected $fillable = [
        'title','owner','description','cause','likelihood','impact','status'
    ];

    // Skor inherent (likelihood x impact)
    public function getInherentScoreAttribute(): int
    {
        return (int) ($this->likelihood * $this->impact);
    }

    // Level sederhana dari skor
    public function getLevelAttribute(): string
    {
        $s = $this->inherent_score;
        return $s >= 15 ? 'High' : ($s >= 6 ? 'Medium' : 'Low');
    }
}
