<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Events\Dispatcher;   
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Actions\DeleteAction;
use App\Actions\DeleteAction as MyDeleteAction;
use TCG\Voyager\Actions\EditAction;
use App\Actions\EditAction as MyEditAction;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Voyager::replaceAction(DeleteAction::class, MyDeleteAction::class);
        Voyager::replaceAction(EditAction::class, MyEditAction::class);
        Voyager::addAction(\App\Actions\DeleteForever::class);
    }
}
