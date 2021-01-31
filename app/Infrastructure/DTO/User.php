<?php

declare(strict_types=1);

namespace App\Infrastructure\DTO;

use App\Traits\DTOTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * ユーザDTOクラス
 */
class User extends Authenticatable
{
    use DTOTrait, HasApiTokens, Notifiable;

    /**
     * 更新可能なカラム
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * 読み出し不可能なカラム
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * データ型を変換されるカラム
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
