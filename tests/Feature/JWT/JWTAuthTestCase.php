<?php
/**
 * @Author: Roy
 * @DateTime: 2023/2/12 上午 10:55
 */

namespace Tests\Feature\JWT;

use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTAuthTestCase extends TestCase
{
    protected $guard = 'api';

    public function actingAs($user, $driver = 'api')
    {
        $token = JWTAuth::fromUser($user);
        $this->withHeader('Authorization', "Bearer {$token}");
        parent::actingAs($user);

        return $this;
    }
}
