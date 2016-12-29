<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Registers bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Http\Repositories\Subscriber\SubscriberRepositoryInterface',
            'App\Http\Repositories\Subscriber\SubscriberRepository'
        );
        $this->app->bind(
            'App\Http\Repositories\Contract\ContractRepositoryInterface',
            'App\Http\Repositories\Contract\ContractRepository'
        );
        $this->app->bind(
            'App\Http\Repositories\Setting\SettingRepositoryInterface',
            'App\Http\Repositories\Setting\SettingRepository'
        );
    }
}
