<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Events\Dispatcher;   
use TCG\Voyager\Facades\Voyager;

use TCG\Voyager\Actions\DeleteAction;
use App\Actions\DeleteAction as MyDeleteAction;

use TCG\Voyager\Actions\EditAction;
use App\Actions\EditAction as MyEditAction;

use TCG\Voyager\Actions\ViewAction;
use App\Actions\ViewAction as MyViewAction;

use TCG\Voyager\Actions\RestoreAction;
use App\Actions\RestoreAction as MyRestoreAction;




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
        Voyager::replaceAction(DeleteAction::class, MyDeleteAction::class); // Thay đổi nút delete
        Voyager::replaceAction(EditAction::class, MyEditAction::class); // Thay đổi nút sửa
        Voyager::replaceAction(ViewAction::class, MyViewAction::class); // Thay đổi nút xem
        Voyager::replaceAction(RestoreAction::class, MyRestoreAction::class); // Thay đổi nút khôi phục
        Voyager::addAction(\App\Actions\DeleteForever::class); // Thêm nút xóa tại từng dòng
        //Voyager::addAction(\App\Actions\Deleteall::class); // Thêm nút dọn thùng rác
    }
}
