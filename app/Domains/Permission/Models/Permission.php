<?php

namespace App\Domains\Permission\Models;

use App\Domains\Role\Models\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'display_name',
    'description',
    'group',
    'is_active',
  ];

  protected function casts(): array
  {
    return [
      'is_active' => 'boolean',
    ];
  }

  public function roles(): BelongsToMany
  {
    return $this->belongsToMany(Role::class, 'role_permissions');
  }
}
