<?php

namespace Sylain\CyberTrail;

use Illuminate\Support\ServiceProvider;

class CyberTrailServiceProvider extends ServiceProvider {

	/**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {

        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        $this->loadViewsFrom(__DIR__.'/views', 'CyberTrail');

	    $this->publishes([
	        __DIR__.'/public' => public_path('/CyberTrail'),
	    ], 'public');

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}