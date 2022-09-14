<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;
//use Laravel\Passport\HasApiTokens;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    //use \HighIdeas\UsersOnline\Traits\UsersOnlineTrait;
    //use HasApiTokens, Billable;
    use HasApiTokens, HasFactory, Notifiable;

    protected $dates = ['trial_ends_at', 'subscription_ends_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'email', 'password','fullname','fathername','gender','religion','nickname','ss_id','date_of_birth',
        'address','age','phone','facebook','twitter','image','role','admin','leader','student_type','mailing','chat','timeline',
        'last_login_at',
        'last_login_ip'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','api_token'
    ];

    public $table='users';

    public function studentmarks()
    {
        return $this->hasMany('App\Studentmark');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    public  function answers(){
        return $this->hasMany('App\Answer');
    }
    public  function likes(){
        return $this->hasMany('App\Like');
    }
    public function student()
    {
        return $this->belongsTo('App\Student')
            ;
    }
    public function reviews()
    {
        return $this->hasMany('App\Review');
    }
    public function students()
    {
        return $this->hasMany('App\Student');
    }

    public function teachers()
    {
        return $this->hasMany('App\Teacher');
    }
    //post
    public function pcomments()
    {
        return $this->hasMany('App\Pcomment');
    }
    public  function pcommentreplies(){
        return $this->hasMany('App\Pcommenreply');
    }
    public  function plikes(){
        return $this->hasMany('App\Plike');
    }
    /**
     * A user can have many messages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class)->withPivot('group_id', 'user_id','hide')->wherePivot('hide','=',0)->withTimestamps()->orderBy('updated_at','desc');
    }
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
    public function results()
    {
        return $this->hasMany(Result::class);
    }
    public function events()
    {
        return $this->belongsToMany(Event::Class)
            ->withTimestamps();
    }
    public function quizanswers()
    {
        return $this->belongsToMany(Quizanswer::Class)
            ->withTimestamps();
    }

    public function items()
    {
        return $this->belongsToMany(Item::Class)
            ->withTimestamps();
    }
    public function orders()
    {
        return $this->hasMany(Order::Class);
    }
    public function teacher_reports()
    {
        return $this->hasMany('App\Teacher_report');
    }
    //
    //======================== functions to get friends attribute =========================

    // friendship that this user started
    protected function friendsOfThisUser()
    {
        return $this->belongsToMany(User::class, 'friendships', 'first_user', 'second_user')
            ->withPivot('status')
            ->wherePivot('status', 'confirmed');
    }

    // friendship that this user was asked for
    protected function thisUserFriendOf()
    {
        return $this->belongsToMany(User::class, 'friendships', 'second_user', 'first_user')
            ->withPivot('status')
            ->wherePivot('status', 'confirmed');
    }

    // accessor allowing you call $user->friends
    public function getFriendsAttribute()
    {
        if ( ! array_key_exists('friends', $this->relations)) $this->loadFriends();
        return $this->getRelation('friends');
    }

    protected function loadFriends()
    {
        if ( ! array_key_exists('friends', $this->relations))
        {
            $friends = $this->mergeFriends();
            $this->setRelation('friends', $friends);
        }
    }

    protected function mergeFriends()
    {
        if($temp = $this->friendsOfThisUser)
            return $temp->merge($this->thisUserFriendOf);
        else
            return $this->thisUserFriendOf;
    }
//======================== end functions to get friends attribute =========================

//====================== functions to get blocked_friends attribute ============================

    // friendship that this user started but now blocked
    protected function friendsOfThisUserBlocked()
    {
        return $this->belongsToMany(User::class, 'friendships', 'first_user', 'second_user')
            ->withPivot('status', 'acted_user')
            ->wherePivot('status', 'blocked')
            ->whereRaw('acted_user', 'first_user');
    }

    // friendship that this user was asked for but now blocked
    protected function thisUserFriendOfBlocked()
    {
        return $this->belongsToMany(User::class, 'friendships', 'second_user', 'first_user')
            ->withPivot('status', 'acted_user')
            ->wherePivot('status', 'blocked')
            ->whereRaw('acted_user', 'second_user');
    }

    // accessor allowing you call $user->blocked_friends
    public function getBlockedFriendsAttribute()
    {
        if ( ! array_key_exists('blocked_friends', $this->relations)) $this->loadBlockedFriends();
        return $this->getRelation('blocked_friends');
    }

    protected function loadBlockedFriends()
    {
        if ( ! array_key_exists('blocked_friends', $this->relations))
        {
            $friends = $this->mergeBlockedFriends();
            $this->setRelation('blocked_friends', $friends);
        }
    }

    protected function mergeBlockedFriends()
    {
        if($temp = $this->friendsOfThisUserBlocked)
            return $temp->merge($this->thisUserFriendOfBlocked);
        else
            return $this->thisUserFriendOfBlocked;
    }
// ======================================= end functions to get block_friends attribute =========
    public function friend_requests()
    {
        return $this->hasMany(Friendship::class, 'second_user')
            ->where('status', 'pending');
    }

}
