<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Macro responses instead custom solution
        Response::macro('success', function ($data){
            return response()->json(['success' => true, 'data' => $data], \Illuminate\Http\Response::HTTP_OK);
        });

        // Macro responses instead custom solution
        Response::macro('error', function ($error, $error_code){
            return response()->json(['success' => false, 'data' => $error], $error_code);
        });
    }
}
