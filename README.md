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
