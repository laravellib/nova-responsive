<?php

namespace fixedheader;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class fixedheaderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $config = config('fixed-header', [
          'fixedSidebar' => true,
          'fixedNavbar'  => true,
        ]);

        Nova::serving(function (ServingNova $event) use ($config) {
            if ($config['fixedNavbar']) {
                Nova::style('nova-fixed-header-css', __DIR__.'/../resources/css/fixed-header.css');
                Nova::script('nova-dynamicNavbar-js', __DIR__.'/../resources/js/dynamicNavbar.js');
            }

            if ($config['fixedSidebar']) {
                Nova::style('nova-sidebar-css', __DIR__.'/../resources/css/fixed-sidebar.css');
                Nova::script('nova-dynamicSidebar-js', __DIR__.'/../resources/js/dynamicSidebar.js');
                Nova::style('nova-ps-css', __DIR__.'/../resources/css/perfectscrollbar.css');
                Nova::script('nova-ps-js', __DIR__.'/../resources/js/perfectscrollbar.js');
            }
        });

        $this->publishes([
            __DIR__.'/../config/fixedheader.php' => config_path('Fixedheader.php'),
        ], 'config');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
