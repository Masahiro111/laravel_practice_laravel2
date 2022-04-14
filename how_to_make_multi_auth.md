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

```config/auth.php
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
```

12,

```
```
