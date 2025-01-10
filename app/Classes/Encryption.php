<?php

namespace App\Classes;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\Encryption\EncryptException;
use Illuminate\Support\Facades\Crypt;

class Encryption{

  public static function encrypt(int|string $id): string|null
  {
      try {
          $id = Crypt::encrypt($id);
      } catch (EncryptException $e) {
          return null;
      }
      return $id;
  }

  public static function decrypt(string $id): string|int|null
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return null;
        }
        return $id;
    }
}