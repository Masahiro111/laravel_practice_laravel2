# Laravel 9 How to make multi auth using Laravel Breeze

1, Laravel のインストール

```command
laravel new laravel_project
```

2, プロジェクトルートへ移動

```command
cd laravel_project
```

3, Laravel Breeze のインストール

```command
composer require laravel/breeze --dev
```

4, Laravel Breeze 関連ファイルのインストール

```command
php artisan breeze:install
```

5, npm で必要パッケージをインストール及びコンパイル

```command
npm install && npm run dev
```

6, モデルとマイグレーションファイル作成

```command
php artisan make:model Admin -m
```

7, Admin.php の内容追加

User.php をコピーして、Admin.phpに貼り付け。Admin.php の位す名を Admin に変更

```Admin.php:diff
// ...
class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    // ...
```

8, 作成されたマイグレーションファイルの内容追加

```2022_04_11_000000_create_admins_table.php:diff
// 列情報の内容は、users と一緒
public function up()
{
    Schema::create('admins', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        $table->rememberToken();
        $table->timestamps();
    });
}
```

9, マイグレーションの実行

```command
php artisan migrate
```

10, Guard の設定

config/auth.php

```php
// ...

'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],
    'admin' => [
        'driver' => 'session',
        'provider' => 'admins',
    ],
],

// ...

'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => App\Models\User::class,
    ],
    'admins' => [
        'driver' => 'eloquent',
        'model' => App\Models\Admin::class,
    ],
],

// ...

'passwords' => [
    'users' => [
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
        'throttle' => 60,
    ],
    'admins' => [
        'provider' => 'admins',
        'table' => 'password_resets',
        'expire' => 60,
        'throttle' => 60,
    ],
],

// ...
```

11, ルーティング設定

`routes/auth.php` をコピーして、新規に `routes/admin.php` を作成。`admin.php` 内の名前空間に、`admin` を追加。

```
routes
  | -  auth.php 
  | -  admin.php (new)
```

admin.php

```php
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
```

12, パラメータ 「admin」の追加

middleware の guest と auth にパラメータ admin を追加

admin.php

```php
Route::middleware('guest:admin')->group(function () {

    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.update');
});

Route::middleware('auth:admin')->group(function () {

    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
```

13, admin.php を ルート定義ファイルに追加

```php
require __DIR__.'/auth.php';

require __DIR__.'/admin.php';
```
