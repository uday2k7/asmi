<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\UserGenres;

class User extends Authenticatable implements JWTSubject
{
    const BOOL_YES = 'YES';
    const BOOL_NO = 'NO';

    public static array $bool = [
        self::BOOL_NO => 'No',
        self::BOOL_YES => 'Yes',
    ];

    CONST GENDER_MALE = 'Male';
    CONST GENDER_FEMALE = 'Female';
    CONST GENDER_OTHER = 'Other';

    public static array $genders = [
        self::GENDER_MALE,
        self::GENDER_FEMALE,
        self::GENDER_OTHER,
    ];

    CONST USER_TYPE_SUPERADMIN = 1;
    CONST USER_TYPE_ADMIN = 2;
    CONST USER_TYPE_TYPE1 = 4;

    public static array $userTypes = [
        self::USER_TYPE_SUPERADMIN =>'Super Admin',
        self::USER_TYPE_ADMIN =>'Admin',
        self::USER_TYPE_TYPE1 =>'Type One',
    ];

    CONST USER_EMAIL_NOT_VERIFIED = 0;
    CONST USER_EMAIL_VERIFIED = 1;

    CONST USER_MOBILE_NOT_VERIFIED = 0;
    CONST USER_MOBILE_VERIFIED = 1;

    protected $hidden = array('password');
    protected $fillable = [
        'password',
        'first_name',
        'last_name',
        'email',
        'mobile',
        'insta_id',
        'tiktok_id',
        'address',
        'date_of_birth',
        'gender',
        'genre_ids',
        'profile_pic',
        'latitude',
        'longitude',
        'coordinates',
        'fcm_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    /*
     * Get Full Data by id
     */
    public static function getPostById(int $id)
    {
        $result = self::find($id);
        if(!empty($result))
        {
            $result = $result->toArray();
            $result['genres'] = UserGenres::getUserGenres($id);
        }
        return $result;
    }

    /*
     * Get Full Data by id
     */
    public static function getPostByFcmToken(string $token)
    {
        $result = self::where('fcm_token',$token)->get()->toArray();
        if(!empty($result))
            return self::getPostById($result[0]['id']);
    }

    /*
     * Get full information of a user
     * todo: use above one and delete this one
     */
//    public static function getPostByIdT(int $id)
//    {
//        $userInfo = self::find($id);
//        if(!empty($userInfo))
//        {
//            $userInfo = getCleanObject($userInfo);
//            $userInfo->genres = UserGenres::getUserGenres($id);
//        }
//        return $userInfo;
//    }
}
