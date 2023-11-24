<h1>Readme riêng của Đại</h1>
<h2>Tùy chọn thêm soft delete của bread</h2>
<p>Đường dẫn: App\Models\Tên model.php</p>
<p> Khai báo class SoftDelete: use Illuminate\Database\Eloquent\SoftDeletes;</p>
<p> Bật chức năng soft delete: </p>
<p> use SoftDeletes; protected $dates = ['deleted_at'];</p>
<h3>Code mẫu: </h3>

```
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Site extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
```

<h2>Tùy chỉnh trạng thái của nút checkbox bật tắt</h2>
<p>Kiểu dữ liệu của database: BIT</p>
<p>Kiểu dữ liệu đầu vào của BREAD: Checkbox</p>
<p>Tùy chỉnh chi tiết:</p>

```
{
    "on": "Hoạt động",
    "off": "Tạm ngưng",
    "checked": true
}
```
<h2>Tạo trường slug bằng slugify</h2>
<p>1. Xác định cột:</p>
<p> - Cột slug sẽ lấy dữ liệu của cột tên hạng mục để phân tích text ra slug</p>
<p>** Cột tên hạng mục có tên cột trong database: tenhangmuc</p>
<p>2. Thêm tùy biến cho cột slug trong BREAD</p>

```
{
    "slugify": {
        "origin": "tenhangmuc",
        "forceUpdate": true
    }
}
```

<h2>Chỉnh sửa footer</h2>
<p>1. Đường dẫn gốc file footer: ..\vendor\tcg\voyager\resources\views\partials\app-footer.blade.php</p>
<p>2. Tạo đường dẫn mới trong project: ..\resources\views\vendor\voyager\partials</p>
<p>3. Copy file app-footer.blade.php ở đường dẫn (1) vào đường dẫn (2)</p>
<p>Nội dung file app-footer-blade.php: </p>

```
<footer class="app-footer">
    <div class="site-footer-right">
        @if (rand(1,100) == 100)
            <i class="voyager-rum-1"></i> {{ __('voyager::theme.footer_copyright2') }}
        @else
            {!! __('voyager::theme.footer_copyright') !!} <a href="http://thecontrolgroup.com" target="_blank">The Control Group</a>
        @endif
        @php $version = Voyager::getVersion(); @endphp
        @if (!empty($version))
            - {{ $version }}
        @endif
    </div>
</footer>
```

<p>4. Chỉnh sửa nội dung file tùy ý</p>
<p><i>Lưu ý: Chỉ nên sửa file tại app, không nên sửa file gốc tại thư mục TCG</i></p>

<h2>Tạo view tùy chỉnh (toàn bộ bread)</h2>
<p>1. Các file view của bread gốc voyager tại:  ..\vendor\tcg\voyager\resources\views\bread </p>
<p>2. Tạo đường dẫn views của app theo đường dẫn: ..\resources\views\vendor\voyager\bread</p>
<p>3. Copy toàn bộ file từ đường dẫn (1) sang đường dẫn (2)</p>
<p>Danh sách file:</p>
<ul>
    <li>browse.blade.php <i>(Trang view của BREAD)</i></li>
    <li>edit-add.blade.php <i>(Trang chỉnh sửa - thêm)</i></li>
    <li>order.balde.php <i>(Trang sắp xếp)</i></li>
    <li>read.blade.php <i>(Trang xem chi tiết)</i></li>
</ul>
<p>Chỉnh sửa nội dung theo ý (Code html)</p>
<p><i>Lưu ý: Chỉ nên sửa file tại app, không nên sửa file gốc tại thư mục TCG</i></p>

<h2>Tạo view tùy chỉnh (cho từng bread)</h2>
<p>1. Các file view của bread gốc voyager tại:  ..\vendor\tcg\voyager\resources\views\bread </p>
<p>2. Lấy tên của bread cần tạo custom view tại thanh địa chỉ</p>
<p>Ví dụ đường dẫn của danh mục chi: http://localhost/lrvweb/public/admin/danhmucchis -> tên bread của danh mục chi là: danhmucchis</p>
<p>3. Tạo đường dẫn views của danhmuchis theo đường dẫn: ..\resources\views\vendor\voyager\Danhmucchis -> <i>(Viết hoa chữ cái đầu)</i></p>
<p>4. Copy file view cần custom từ đường dẫn (1) sang đường dẫn (3)</p>
<p>Danh sách file:</p>
<ul>
    <li>browse.blade.php <i>(Trang view của BREAD)</i></li>
    <li>edit-add.blade.php <i>(Trang chỉnh sửa - thêm)</i></li>
    <li>order.balde.php <i>(Trang sắp xếp)</i></li>
    <li>read.blade.php <i>(Trang xem chi tiết)</i></li>
</ul>
<p>Chỉnh sửa nội dung theo ý (Code html)</p>
<p><i>Lưu ý: Chỉ nên sửa file tại app, không nên sửa file gốc tại thư mục TCG</i></p>


<h2>Tùy chỉnh controller (tạo child controller)</h2>
<p>1. Sửa file config tại đường dẫn: ..\config\voyager.php</p>

```
 'controllers' => [
        'namespace' => 'App\\Http\\Controllers\\Voyager',
    ],
```

<p>2. Chạy lệnh: php artisan voyager:controllers</p>

```
 'controllers' => [
        'namespace' => 'App\\Http\\Controllers\\Voyager',
    ],
 ```

<p>3. Các file Controller sẽ được tạo tại đường dẫn: ..\app\Http\Controllers\Voyager</p>
<p></p>

<h2>Tạo nút xóa thùng rác</h2>

<h3>1. Tạo Controller:</h3>
<p>Tạo 1 file mới với tên Cdbcontroller.php tại đường dẫn: ..\app\Http\Controllers\Cdbcontroller.php</p>

```
<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Cdbcontroller extends Controller
{
    public function deleteforever($table, $keyvalue)
    {
        $data = DB::table($table)->where('id',$keyvalue)->delete();
        return redirect()->route('voyager.' . $table . '.index');  
    }

    public function deletetrash($table, $check)
    {
        if($check)
        {
            $data = DB::table($table)->where('deleted_at','!=','')->delete();
            return redirect()->route('voyager.' . $table . '.index');
        }          
    }
}

```

<h3>2. Tạo 1 route để điều hướng đến Controller vừa tạo</h3>
<p>Tạo route mới:</p>

```
Route::get('deletetrash/{table}/{check}', 'App\Http\Controllers\Cdbcontroller@deletetrash')->name('deletetrash'); 
```

<p>Tại file:  ..\routes\web.php</p>

```
Route::group(['prefix' => 'admin'], function () {   
    Voyager::routes(); 

    Route::get('deleteforever/{table}/{keyvalue}', 'App\Http\Controllers\Cdbcontroller@deleteforever')->name('deleteforever');
    Route::get('deletetrash/{table}/{check}', 'App\Http\Controllers\Cdbcontroller@deletetrash')->name('deletetrash');
});
```

<h3>3. Tạo nút xóa và modal</h3>
<p>- Nút xóa: Thêm đoạn code sau vào file: ..\resources\views\vendor\voyager\bread\browse.blade.php</p>

```
<!-- Thêm html của nút dọn thùng rác -->
        @if($usesSoftDeletes && $showSoftDeleted)
            <a href="javascript:void(0)" class="btn btn-sm btn-warning delete_trash_btn"><i class="voyager-trash"></i> Dọn thùng rác</a>
        @endif
```

<p>Thêm modal cảnh báo:</p>

```
<!-- modal của delete trash --> 
    <div class="modal modal-danger fade" tabindex="-1" id="delete_trash_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> Thông báo dọn sạch thùng rác</h4>
                </div>
                <div class="modal-footer">
                    <form action="#" id="delete_trash_form" method="GET">
                        
                        <input type="submit" class="btn btn-danger pull-right delete-confirm" value="{{ __('voyager::generic.delete_confirm') }}">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal --> 
```

<p>Script của modal:</p>

```
// script delete trash
        $('.delete_trash_btn').on('click', function () {
            $('#delete_trash_form')[0].action = '{{ route('deletetrash', ['table' => $dataType->slug, 'check' => True]) }}';
           $('#delete_trash_modal').modal('show');
        });
```

<p>route gán vào link cho các row ở browse</p>

```
<a href="{{ route('voyager.'.$dataType->slug.'.edit', $data->{$data->getKeyName()}) }}">
```

<h3>Cấu hình media và hình ảnh khi upload lên host (storage của voyager)</h3>
<p>File .env</p>
<p>Khai báo APP_URL không chứa public</p>

```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:UInBT/4W2O2QyOURb4tcKivUPJG5vT1nAbl/nOh0Aq8=
APP_DEBUG=true
APP_URL=http://localhost <- loại bỏ public ->
```

<p>File config/filesystem.php</p>
<p>Khai báo đường dẫn cho storage và url hiển thị hình ảnh, tại đây sử dụng luôn thư mục mặc định của voyager tại htttp://localhost/storage thay vì http://localhost/public/storage với storage trong public là shortcut hoặc symlink cho các trường hợp hosting không hỗ trợ tạo shortcut và symlink</p>

```
'public' => [
            'driver' => 'local',
            'root' => storage_path('/app/public'), <- Nơi lưu trữ ->
            'url' => env('APP_URL').'/storage/app/public', <- Hiển thị url ra ngoài html ->
            'visibility' => 'public',
            'throw' => false,
        ],
```

<h2>Hiển thị html trong mysql ra nội dung ngoài template</h2>
<p>Với nội dung html được lưu bằng tiny trong DB thì hiển thị ngoài view bằng {!! nội dung html !!}</p>

<h2>Truyền dữ liệu toàn cục cho toàn bộ view</h2>
<quote>Với cách truyền dữ liệu này, với các biến cần cpmpact vào nhiều view là liên tục, sử dụng provider để truyền dữ liệu, lúc này toàn bộ view sẽ được mặc định nhận được biến đã được cấu hình</quote>
<p>1. Thêm biến vào AppServiceProvider tại đường dẫn: app\Providers\AppServiceProvider (cũng có thể tạo riêng một provider tự tạo)</p>
<p> Sử dụng 2 lớp DB và View cho AppServiceProvider</p>
```
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
```

<p>2. Tại public function boot() tiến hành khởi tạo biến và truyền biến cho toàn bộ view</p>
```
    public function boot()
    {
        $contact = DB::table('contacts')->where('id','1')->first();
        View::share('contact', $contact);
    }
```

<p>Lúc này biến $contact sẽ được truyền vào toàn bộ view mỗi khi view được load thông qua url hoặc route mà không cần compact thông qua controller</p>
    
