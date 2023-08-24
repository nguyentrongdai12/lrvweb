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
