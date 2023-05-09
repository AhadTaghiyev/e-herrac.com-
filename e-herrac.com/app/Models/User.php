<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia {
    use HasRoles;
    use InteractsWithMedia;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Scope the model query to certain roles only.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string|array|\Spatie\Permission\Contracts\Role|\Illuminate\Support\Collection $roles
     * @param string $guard
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithoutRole(Builder $query, $roles, $guard = null): Builder
    {
        if ($roles instanceof Collection) {
            $roles = $roles->all();
        }

        if (! is_array($roles)) {
            $roles = [$roles];
        }

        $roles = array_map(function ($role) use ($guard) {
            if ($role instanceof Role) {
                return $role;
            }

            $method = is_numeric($role) ? 'findById' : 'findByName';
            $guard = $guard ?: $this->getDefaultGuardName();

            return $this->getRoleClass()->{$method}($role, $guard);
        }, $roles);

        return $query->whereHas('roles', function (Builder $subQuery) use ($roles) {
            $subQuery->whereNotIn(config('permission.table_names.roles').'.id', \array_column($roles, 'id'));
        });
    }

    public function registerMediaCollections() : void
    {
        $this->addMediaCollection('photo')
        ->useFallbackUrl('/assets/admin/img/admin-logo-black.png')
        ->acceptsMimeTypes(['image/jpg', 'image/jpeg', 'image/png', 'image/gif', 'image/webp'])
        ->singleFile();
    }

    public function getPreloadedMedia($collectionName = 'default') {
        if($this->hasMedia($collectionName)) {
            return $this->getMedia($collectionName)->map(function ($item) {
                return [
                    'name' => $item->file_name,
                    'size' => $item->size,
                    'type' => $item->mime_type,
                    'file' => $item->getFullUrl(),
                    'data' => [
                        'listProps' => ['model_id' => $item->id]
                    ],
                ];
            })->toJson();
        }
    }
}
