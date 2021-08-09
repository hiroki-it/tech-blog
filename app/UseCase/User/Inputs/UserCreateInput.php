<?php

declare(strict_types=1);

namespace App\UseCase\User\Inputs;

use App\UseCase\CreateInput;

class UserCreateInput extends CreateInput
{
    /**
     * ユーザ名
     *
     * @var string
     */
    private string $name;

    /**
     * ユーザメールアドレス
     *
     * @var string
     */
    private string $emailAddress;

    /**
     * ユーザ電話番号
     *
     * @var string
     */
    private string $phoneNumber;

    /**
     * ユーザ電話番号
     *
     * @var string
     */
    private string $password;

    /**
     * コンストラクタインジェクション
     *
     * @param array $validated
     */
    public function __construct(array $validated)
    {
        $this->name = $validated['name'];
        $this->emailAddress = $validated['emailAddress'];
        $this->phoneNumber = $validated['phoneNumber'];
        $this->password = $validated['password'];
    }
}
