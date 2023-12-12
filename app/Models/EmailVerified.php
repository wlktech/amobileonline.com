<?php

namespace App\Models;

use App\Events\EmailVerifiedEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmailVerified extends Model
{
    use HasFactory;
    protected $table = 'email_verified';
    protected $fillable = ['name','email','code','expired'];

    protected static function booted()
    {
        static::created(function ($verified_mail) {
            event(new EmailVerifiedEvent($verified_mail));
        });
    }
}
