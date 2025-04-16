<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FamilyMember extends Model
{
    protected $table = 'family_members';

    protected $fillable = [
        'name',
        'gender',
        'DOB',
        'description',
        'from',
        'photo',
        'partner_id',
        'parent_id',
        'user_id'
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

    // ke user one to one
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
