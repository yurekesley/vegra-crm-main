<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class DirectiveServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('dateortext', function ($expression) {
            return "<?php echo ($expression) != null && ($expression) != new DateTime('1970-01-01') ? ($expression)->format('m/Y') : '--' ?>";
        });
    }
}
