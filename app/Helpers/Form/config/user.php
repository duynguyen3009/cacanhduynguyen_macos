<?php
return [
    //         $table->string('phone_number');
    //         $table->integer('role');
    //         $table->integer('status');
    //         $table->integer('sequence');
    
    'email' => [
        'label'         => 'Email',
        'type'          => 'input',
        'required'      => true,
    ],
    'password' => [
        'label'         => 'Mật khẩu',
        'type'          => 'input',
        'required'      => true,
    ],
    'first_name' => [
        'label'         => 'Họ',
        'type'          => 'input',
        'required'      => false,
    ],
    'last_name' => [
        'label'         => 'Tên',
        'type'          => 'input',
        'required'      => false,
    ],
    'city' => [
        'label'         => 'Thành phố',
        'type'          => 'select2',
        'required'      => true,
    ],
    'phone_number' => [
        'label'         => 'Số điện thoại',
        'type'          => 'input',
        'required'      => true,
    ],
    'role' => [
        'label'         => 'Quyền',
        'type'          => 'select2',
        'required'      => true,
    ],
    'sequence' => [
        'label'         => 'Vị trí',
        'type'          => 'input',
        'required'      => true,
    ],
    'status' => [
        'label'         => 'Trạng thái',
        'type'          => 'checkbox',
        'required'      => false,
    ],
];
