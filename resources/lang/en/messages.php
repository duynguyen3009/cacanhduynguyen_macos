<?php
return [
    // validation
    'required'          => ':attribute không được để trống !',
    'url'               => ':attribute không đúng định dạng !',
    'integer'           => ':attribute phải là số nguyên !',
    'numeric'           => ':attribute phải là số !',
    'date'              => ':attribute không đúng định dạng !',
    'after_or_equal'    => ':attribute không được sớm hơn ngày bắt đầu !',
    'image'             => ':attribute không phải là hình ảnh !',
    'image_max'         => ':attribute quá lớn <= 10000kb !',
    'digits10'         => ':attribute phải đủ 10 số',
    'email'         => ':attribute không đúng định dạng',

    // another
    'update_success'            => "Cập nhật :attribute thành công!",
    'insert_success'            => "Bạn đã thêm :attribute thành công!",
    'delete_recored_success'    => "Xóa thành công id: :id",
    'delete_recored_fail'       => "Xóa thất bại id: :id",
    'login_fail'                => "Tên đăng nhập hoặc mật khẩu chưa đúng!",
];