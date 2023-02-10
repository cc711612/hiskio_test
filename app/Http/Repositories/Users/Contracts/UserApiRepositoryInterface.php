<?php
/**
 * @Author: Roy
 * @DateTime: 2023/2/9 上午 11:00
 */

namespace App\Http\Repositories\Users\Contracts;

interface UserApiRepositoryInterface
{
    function getUserByEmail(string $email);
}
