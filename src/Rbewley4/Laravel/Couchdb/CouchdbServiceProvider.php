<?php namespace Rbewley4\Laravel\Couchdb;

class CouchdbServiceProvider extends \Illuminate\Support\ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Add a couchdb extension to the original database manager
        $this->app['db']->extend('couchdb', function($config)
        {
            return new CouchdbConnection($config);
        });
    }

}