<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Models\BaseModels\BaseExternalAuthenticatable;

class User extends BaseExternalAuthenticatable
{
    use HasFactory, Notifiable;
    protected $appends = ['profile_pic', 'profile_pic_converted'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('profile_pic')
            ->singleFile();
    }

    public function getProfilePicAttribute(): string
    {
        $media = $this->getFirstMedia('profile_pic');
        return $media ? $media->getUrl() : '/dummy.png';
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
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'profile_pic',
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
}
