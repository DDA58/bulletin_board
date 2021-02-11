<?php


namespace App\Providers;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;

class QueriesLogServiceProvider extends ServiceProvider
{
    public function boot() {
        if(!config('app.debug'))
            return;

        DB::listen(function($query) {
            Log::channel('queries_log')->info(
                $query->sql,
                $query->bindings,
                $query->time
            );
        });
    }
}
