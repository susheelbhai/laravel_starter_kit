<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Notifications\Auth\Partner\ResetPasswordNotification;
use App\Models\BaseModels\BaseExternalAuthenticatable;

class Partner extends BaseExternalAuthenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'profile_pic',
        'google_id',
        'facebook_id',
        'x_id',
        'linkedin_id',
        "github_id",
        'gitlab_id',
        'bitbucket_id',
        'slack_id',
        'apple_id',
        'amazon_id',
        'avatar',
    ];
    
    protected $appends = ['profile_pic', 'profile_pic_converted'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('profile_pic')
            ->singleFile();
    }

    public function getProfilePicAttribute()
    {
        $media = $this->getFirstMedia('profile_pic');
        return $media ? $media->getUrl() : $this->avatar;
    }

    public function getProfilePicConvertedAttribute(): array
    {
        $media = $this->getFirstMedia('profile_pic');
        if (!$media) {
            return [];
        }
        $urls = [];
        foreach ($media->getGeneratedConversions() as $conversionName => $isGenerated) {
            if ($isGenerated) {
                $urls[$conversionName] = $media->getUrl($conversionName);
            }
        }
        return $urls;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
    protected $guard_name = 'partner';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'google_id',
        'facebook_id',
        'x_id',
        'linkedin_id',
        "github_id",
        'gitlab_id',
        'bitbucket_id',
        'slack_id',
        'apple_id',
        'amazon_id',
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
        ];
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
