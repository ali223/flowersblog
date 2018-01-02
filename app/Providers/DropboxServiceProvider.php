<?php

namespace App\Providers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client as GuzzleClient;
use League\Flysystem\Filesystem;
use Spatie\Dropbox\Client as DropboxClient;
use Spatie\FlysystemDropbox\DropboxAdapter;

class DropboxServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Storage::extend('dropbox', function ($app, $config) {

            $authorizationToken = $config['authorizationToken'];

            $guzzleClient = new GuzzleClient([
                'headers' => [
                    'Authorization' => "Bearer {$authorizationToken}",
                ],
                'verify' => $this->app->environment('local') ? false : true
            ]);

            $dropboxClient = new DropboxClient(
                $authorizationToken, 
                $guzzleClient
            );

            return new Filesystem(new DropboxAdapter($dropboxClient));

        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
