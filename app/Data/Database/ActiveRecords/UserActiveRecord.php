<?php

namespace App\Data\Database\ActiveRecords;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class UserActiveRecord extends Model implements HasMedia
{
    use InteractsWithMedia;

    public $timestamps = false;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email'
    ];

    /**
     * @param string $name
     * @param string|null $email
     * @param string $avatar
     * @return $this
     * @throws Exception
     */
    public static function add(string $name, ?string $email, string $avatar): self
    {
        $user = new self;
        $user->name = $name;
        $user->email = $email;

        $user->addMediaFromUrl($avatar)
            ->setName('avatar')
            ->toMediaCollection('avatars', 'avatars');
        return $user;
    }
}
