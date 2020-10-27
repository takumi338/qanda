<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginTest extends TestCase
{

    use RefreshDatabase;

    public function testLogin()
{
    // ユーザーを１つ作成
    $user = factory(User::class)->create([
        'password'  => bcrypt('test1111')
    ]);
 
    // まだ、認証されていない
    $this->assertFalse(Auth::check());
 
    // ログインを実行
    $response = $this->post('login', [
        'email'    => $user->email,
        'password' => 'test1111'
    ]);
 
    // 認証されている
    $this->assertTrue(Auth::check());
 
    // ログイン後にホームページにリダイレクトされるのを確認
    $response->assertRedirect('/allposts');
}

    public function testLogout()
 {
     // ユーザーを１つ作成
     $user = factory(User::class)->create();
 
     // 認証済み、つまりログイン済みしたことにする
     $this->actingAs($user);
 
     // 認証されていることを確認
     $this->assertTrue(Auth::check());
 
     // ログアウトを実行
     $response = $this->post('logout');
 
     // 認証されていない
     $this->assertFalse(Auth::check());
 
     // Welcomeページにリダイレクトすることを確認
     $response->assertRedirect('/');
 }

}
