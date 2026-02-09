<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'google_id',
        'avatar',
        'otp_code',
        'otp_expires_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'otp_code',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'otp_expires_at' => 'datetime',
        ];
    }

    /**
     * Generate a new OTP code for this user.
     * OTP expires in 5 minutes.
     */
    public function generateOtp(): string
    {
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $this->update([
            'otp_code' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(5),
        ]);

        return $otp;
    }

    /**
     * Verify if the given OTP is valid and not expired.
     */
    public function verifyOtp(string $code): bool
    {
        if ($this->otp_code !== $code) {
            return false;
        }

        if ($this->otp_expires_at === null || $this->otp_expires_at->isPast()) {
            return false;
        }

        // Clear OTP after successful verification
        $this->update([
            'otp_code' => null,
            'otp_expires_at' => null,
        ]);

        return true;
    }

    /**
     * Check if user registered via OAuth (no password).
     */
    public function isOAuthUser(): bool
    {
        return !empty($this->google_id);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
