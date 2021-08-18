<?php

declare(strict_types=1);

namespace App\Infrastructure\User\DTOs;

use App\Traits\DTOTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * ユーザDTOクラス
 */
class UserDTO extends Authenticatable
{
    use DTOTrait;
    use HasApiTokens;
    use Notifiable;
    use HasFactory;

    protected $table = "users";

    /**
     * DateTimeクラスに変換されるカラム
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

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
