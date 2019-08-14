<?php

namespace Bishopm\Churchsite\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Contracts\Events\Dispatcher;
use Form;

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
        Form::component('bsText', 'churchsite::components.text', ['name', 'label' => '', 'placeholder' => '', 'value' => null, 'attributes' => []]);
        Form::component('bsPassword', 'churchsite::components.password', ['name', 'label' => '', 'placeholder' => '', 'value' => null, 'attributes' => []]);
        Form::component('bsTextarea', 'churchsite::components.textarea', ['name', 'label' => '', 'placeholder' => '', 'value' => null, 'attributes' => []]);
        Form::component('bsThumbnail', 'churchsite::components.thumbnail', ['source', 'width' => '100', 'label' => '']);
        Form::component('bsImgpreview', 'churchsite::components.imgpreview', ['source', 'width' => '200', 'label' => '']);
        Form::component('bsHidden', 'churchsite::components.hidden', ['name', 'value' => null]);
        Form::component('bsSelect', 'churchsite::components.select', ['name', 'label' => '', 'options' => [], 'value' => null, 'attributes' => []]);
        Form::component('pgHeader', 'churchsite::components.pgHeader', ['pgtitle', 'prevtitle', 'prevroute']);
        Form::component('pgButtons', 'churchsite::components.pgButtons', ['actionLabel', 'cancelRoute']);
        Form::component('bsFile', 'churchsite::components.file', ['name', 'attributes' => []]);
        config(['jwt.ttl' => 525600]);
        config(['jwt.refresh_ttl' => 525600]);
        config(['auth.providers.users.model'=>'Bishopm\Churchsite\Models\User']);
        config(['adminlte.title' => 'ChurchNet']);
        config(['adminlte.logo' => '<b>Church</b>Net']);
        config(['adminlte.logo_mini' => '<b>C</b>N']);
        config(['adminlte.skin' => 'blue']);
        config(['adminlte.dashboard_url' => 'admin']);
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
    }
}
