<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /*
        *Helper menggunakan HelperServiceProvider.php , semua file dengan foreach, (tambah/daftarkan provider di config app.php[autoload: App\Providers\HelperServiceProvider::class,])
        
        *dan saatu lagi dengan composer.json (tambahkan path di autoload d"files": [
            "app/Helpers/TanggalIndonesia.php",
            "app/Helpers/AngkaTerbilang.php"
        ])
     
     */
    public function register()
    {
        foreach (glob(app_path().'/Helpers/*.php') as $filename){
            require_once($filename);
        }

        // require_once app_path('Helpers/MyHelper.php');
    }

  
    public function boot()
    {
        //
    }
}
