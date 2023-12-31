<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\URL;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
	use HasApiTokens;

	use HasFactory;

	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
		'password'          => 'hashed',
	];

	public function setPasswordAttribute(string $password): void
	{
		$this->attributes['password'] = bcrypt($password);
	}

	public function generateVerificationUrl(string $email = null): string
	{
		$email = $email ?? $this->email;

		return URL::temporarySignedRoute(
			'verification.verify',
			now()->addWeek(),
			['id' => $this->id, 'hash' => sha1($email), 'email' => $email]
		);
	}

	public function sendPasswordResetNotification($token): void
	{
		$url = URL::temporarySignedRoute(
			'password.expiration',
			now()->addWeek(),
			['token' => $token, 'email' => $this->email]
		);

		$this->notify(new ResetPasswordNotification($url, $this->name, $this->email));
	}

	public function movies(): HasMany
	{
		return $this->hasMany(Movie::class);
	}

	public function notifications(): HasMany
	{
		return $this->hasMany(Notification::class, 'receiver_id');
	}

	public function unreadNotifications(): HasMany
	{
		return $this->hasMany(Notification::class, 'receiver_id')->where('read', false);
	}
}
