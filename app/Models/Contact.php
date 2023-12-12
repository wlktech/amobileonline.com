<?php

namespace App\Models;

use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'contacts';
    protected $fillable = ['name','phone','email','message'];

    protected static function booted()
    {
        static::created(function ($contact) {
            Mail::to('info@amobileonline.com')->send(new ContactMail($contact));
        });
    }
}
