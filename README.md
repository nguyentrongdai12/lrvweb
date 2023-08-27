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
    "slugify": { // gọi hàm slugify
        "origin": "tenhangmuc", // tenhangmuc là tên của cột 'Tên hạng mục' trong database
        "forceUpdate": true // Tùy chỉnh luôn tự sinh ra slug khi cột tenhangmuc có sự thay đổi
    }
}
```

<h2>Chỉnh sửa footer</h2>
<p>1. Đường dẫn gốc file footer: D:\XAMPP\htdocs\lrvweb\vendor\tcg\voyager\resources\views\partials\app-footer.blade.php</p>
<p>2. Tạo đường dẫn mới trong project: D:\XAMPP\htdocs\lrvweb\resources\views\vendor\voyager\partials</p>
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
<p>1. Các file view của bread gốc voyager tại:  D:\XAMPP\htdocs\lrvweb\vendor\tcg\voyager\resources\views\bread </p>
<p>2. Tạo đường dẫn views của app theo đường dẫn: D:\XAMPP\htdocs\lrvweb\resources\views\vendor\voyager\bread</p>
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
<p>1. Các file view của bread gốc voyager tại:  D:\XAMPP\htdocs\lrvweb\vendor\tcg\voyager\resources\views\bread </p>
<p>2. Lấy tên của bread cần tạo custom view tại thanh địa chỉ</p>
<p>Ví dụ đường dẫn của danh mục chi: http://localhost/lrvweb/public/admin/danhmucchis -> tên bread của danh mục chi là: danhmucchis</p>
<p>3. Tạo đường dẫn views của danhmuchis theo đường dẫn: D:\XAMPP\htdocs\lrvweb\resources\views\vendor\voyager\Danhmucchis -> <i>(Viết hoa chữ cái đầu)</i></p>
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
<p>1. Sửa file config tại đường dẫn: D:\XAMPP\htdocs\lrvweb\config\voyager.php</p>

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

<p>3. Các file contorller sẽ được tạo tại đường dẫn: D:\XAMPP\htdocs\lrvweb\app\Http\Controllers\Voyager</p>
<p></p>

<h2>Tạo: custom action, Route, controller và liên kết xử lý xóa dữ liệu</h2>
<p>Điều kiện: nút xóa vĩnh viễn xuất hiện với Row đã xóa vào thùng rác</p>
<p>Nút xóa dẫn đến Route, Route dẫn đến controller và xử lý</p>
<ul>
    <li>Nút xóa: DeleteForever</li>
    <li>Route: deleteforever</li>
    <li>Controller: Cdbcontroller</li>
    <li>Function: deleteforever</li>
</ul>
<p>Bước 1: Tạo nút xóa</p>
<ul>
    <li>Tạo file: D:\XAMPP\htdocs\lrvweb\app\Actions\DeleteForever.php</li>
    <li>Nội dung:</li>
</ul>

```
class DeleteForever extends AbstractAction
{
    public function getTitle()
    {
        return 'Xóa';
    }
    public function getIcon()
    {
        return 'voyager-trash';
    }

    public function getPolicy()
    {
        return 'browse';
    }
    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-primary pull-right',
            'style' => 'margin-right:5px;',
            //'data-id' => $this->data->{$this->data->getKeyName()},
            //'id'      => 'destroy-'.$this->data->{$this->data->getKeyName()},
        ];
    }
    public function confirm()
    {
        return 'Are you sure you want to permanently delete this item?';
    }
    public function getDefaultRoute()
    {
       return route('deleteforever', ['table' => $this->dataType->slug, 'keyvalue' => $this->data->{$this->data->getKeyName()}] );
    }
    public function shouldActionDisplayOnRow($row)
    {   
        return $row->deleted_at != '';
    }
}
```

<p>Bước 2: Khai báo nút mới tạo tại: D:\XAMPP\htdocs\lrvweb\app\Providers\AppServiceProvider.php</p>
<p>Nội dung:</p>

```
    public function boot()
    {
        Voyager::replaceAction(DeleteAction::class, MyDeleteAction::class);
        Voyager::replaceAction(EditAction::class, MyEditAction::class);
    // Thêm mới nút Deleteforever
        Voyager::addAction(\App\Actions\DeleteForever::class); 
    }
```

<p>Bước 3: Tạo Route mới tại: D:\XAMPP\htdocs\lrvweb\routes\web.php</p>
<p>Nội dung:</p>

```
Route::group(['prefix' => 'admin'], function () {
   
    Voyager::routes(); 

    Route::get('deleteforever/{table}/{keyvalue}', 'App\Http\Controllers\Cdbcontroller@deleteforever')->name('deleteforever');
    
});
```

<p>Bước 4: Tạo 1 file Controller tại: D:\XAMPP\htdocs\lrvweb\app\Http\Controllers\Cdbcontroller.php</p>
<p>Nội dung:</p>

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
}
```

<p></p>
<p></p>
<p></p>
