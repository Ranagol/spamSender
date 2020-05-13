<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $guarded = ['id'];


    /**
     * This function can extract clean email adresses from a random gibberish text.
     */
    public static function extract_emails_from(string $string): array
    {
        preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $string, $matches);
        return $matches[0];
    }

    public static function checkForDuplicateEmail(string $string) {
        $duplicate = Email::where('email', '=', $string);
        if ($duplicate) {
            return true;
        } else {
            return false;
        }
        
    }

    public static function checkForDuplicatesEmailS(string $string) {

    }
}
