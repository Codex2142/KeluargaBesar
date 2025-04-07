<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FamilyMember extends Model
{
    protected $table = 'family_members';

    protected $fillable = [
        'name',
        'gender',
        'partner_id',
        'parent_id'
    ];

    // Relasi ke pasangan
    public function partner(): BelongsTo
    {
        return $this->belongsTo(FamilyMember::class, 'partner_id');
    }

    // Relasi ke orangtua
    public function parent(): BelongsTo
    {
        return $this->belongsTo(FamilyMember::class, 'parent_id');
    }

    // Relasi ke anak-anak
    public function children()
    {
        return $this->hasMany(FamilyMember::class, 'parent_id');
    }

}
