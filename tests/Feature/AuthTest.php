<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testRegister()
    {
        $response = $this->post('wx/auth/register', [
            'username' => 'test',
            'password' => '123456',
            'mobile' => '13111111111',
            'code' => '1234'
        ]);
        $response->assertStatus(200);
        $ret = $response->getOriginalContent();
        $this->assertEquals(0, $ret['errno']);
        $this->assertNotEmpty($ret['data']);
    }

    public function testRegisterMobile()
    {
        $response = $this->post('wx/auth/register', [
            'username' => 'test1',
            'password' => '123456',
            'mobile' => '131111111111',
            'code' => '1234'
        ]);
        $response->assertStatus(200);
        $ret = $response->getOriginalContent();
        $this->assertEquals(707, $ret['errno']);
    }

    public function testRegCaptcha()
    {
        $response = $this->post('wx/auth/regCaptcha', ['mobile' => '13222222222']);
        $response->assertJson(['errno' => 0, 'errmsg'=>'成功', 'data' => null]);
        $response = $this->post('wx/auth/regCaptcha', ['mobile' => '13222222222']);
        $response->assertJson(['errno' => 702, 'errmsg' => '验证码未超时一分钟，不能发送', 'data' => null]);

    }

}
