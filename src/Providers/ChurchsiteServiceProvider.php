<?php

namespace Bishopm\Churchsite\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Contracts\Events\Dispatcher;

class ChurchsiteServiceProvider extends ServiceProvider
{
    protected $commands = [
        'Bishopm\Churchsite\Console\InstallChurchsiteCommand'
    ];

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        Schema::defaultStringLength(255);
        require __DIR__.'/../Http/web.routes.php';
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'churchsite');
        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');
        $this->publishes([__DIR__.'/../Assets' => public_path('vendor/bishopm')], 'public');
        config(['auth.providers.users.model'=>'Bishopm\Churchsite\Models\User']);
        config(['queue.default'=>'database']);
        // Form::component('bsText', 'churchsite::components.text', ['name', 'label' => '', 'placeholder' => '', 'value' => null, 'attributes' => []]);
        config(['jwt.ttl' => 525600]);
        config(['jwt.refresh_ttl' => 525600]);
        config(['auth.providers.users.model'=>'Bishopm\Churchsite\Models\User']);
        config(['jwt.user' => 'Bishopm\Churchsite\Models\User']);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
        $this->app->register('Bishopm\Churchsite\Providers\ScheduleServiceProvider');
        AliasLoader::getInstance()->alias("JWTFactory", 'Tymon\JWTAuth\Facades\JWTFactory');
        AliasLoader::getInstance()->alias("JWTAuth", 'Tymon\JWTAuth\Facades\JWTAuth');
        AliasLoader::getInstance()->alias("Form", 'Collective\Html\FormFacade');
        AliasLoader::getInstance()->alias("HTML", 'Collective\Html\HtmlFacade');
        $this->app['router']->aliasMiddleware('handlecors', 'Barryvdh\Cors\HandleCors');
        $this->app['router']->aliasMiddleware('jwt.auth', 'Tymon\JWTAuth\Middleware\GetUserFromToken');
        $this->registerBindings();
    }
}
