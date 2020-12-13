<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class HashCheck implements Rule{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(){
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value){
        if( ! Hash::check( $value ,Auth::user()->password ) )
        {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(){
        return 'The given current password and your actual current password must match !';
    }
}
