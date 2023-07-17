<?php

namespace App\Rules;

use Closure;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;
class email_rule implements Rule
{
    public function __construct()
    {
        
    }

    public function passes($attribute, $value){
        return Str::endsWith($value,'@strathmore.edu');
    }

    public function message()
    {
        return "This is not a valid Strathmore University Email";
    }
}
