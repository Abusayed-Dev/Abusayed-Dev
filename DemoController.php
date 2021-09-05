<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;


class DemoController extends Controller
{


    
    function makeMigrationFile() {
       Artisan::call('make:migration my_table');
    }

    
    function runMigrationFile() {
        Artisan::call('migrate');
    }
    
     function appCacheClear() {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        return Artisan::call('view:clear');
     }




      function SetEnvValue($envKey,  $envValue) {
         $envFilePath = app()->environmentFilePath();
         $strEnv = file_get_contents($envFilePath);
         $strEnv.="\n";

         $keyStartPosition = strpos($strEnv, "{$envKey}=");
         $keyEndPosition = strpos($strEnv, "\n", $keyStartPosition);
         $oldLine = substr($strEnv, $keyStartPosition, $keyEndPosition-$keyStartPosition);

         if (!$keyStartPosition || !$keyEndPosition || !$oldLine) {
            $strEnv.="{$envKey}={$envValue}\n";
         } else {
            $strEnv = str_replace($oldLine, "{$envKey}={$envValue}", $strEnv);
         }

         $strEnv = substr($strEnv, 0, -1);
         $changeResult = file_put_contents($envFilePath, $strEnv);

         if (!$changeResult) {
            return false;
         } else {
            return true;
         }
      }



      function envConfig() {
         $this->SetEnvValue("DB_USERNAME", "root");

         $this->SetEnvValue("ON_SIGNAL_API_KEY", "ABUSAYED");
         $this->SetEnvValue("SMS_API_KEY", "rASDGSDAot");
         $this->SetEnvValue("SMS_API_USER", "544562R5RRER");
         $this->SetEnvValue("SMS_API_PASS", "1123");
      }


      function serverConfigCheck() {
         $php_version = phpversion();
         $bc_math     = extension_loaded('bcmath');
         $ctype       = extension_loaded('ctype');
         $file_info   = extension_loaded('fileinfo');
         $json        = extension_loaded('json');
         $mb_string   = extension_loaded('mbstring');
         $open_ssl    = extension_loaded('openssl');
         $pdo         = defined('pdo::ATTR_DRIVER_NAME');
         $toeknizer   = extension_loaded('tokenizer');
         $xml         = extension_loaded('xml');

         if ($php_version >= 7.3 && $bc_math == true &&  $ctype == true && $file_info == true && $json == true &&  $mb_string == true && $open_ssl == true && $open_ssl == true &&  $pdo == true && $toeknizer == true && $xml == true) {
            return "Laravel 8x Suppported";
         }
         else {
            return "Laravel 8x not Suppported";
         }
         
      }


}



