<?php
return [
    
    'name' => [
        'label'         => 'Tên',
        'type'          => 'input',
        'required'      => true,
    ],
    'url' => [
        'label'         => 'Đường dẫn',
        'type'          => 'input',
        'required'      => true,
    ],
    'status' => [
        'label'         => 'Trạng thái',
        'type'          => 'checkbox',
        'required'      => false,
    ],
    'sequence' => [
        'label'         => 'Vị trí',
        'type'          => 'input',
        'required'      => true,
    ],
    'start_date' => [
        'label'         => 'Ngày bắt đầu trình bày',
        'type'          => 'datepicker',
        'required'      => true,
    ],
    'end_date' => [
        'label'         => 'Ngày kết thúc trình bày',
        'type'          => 'datepicker',
        'required'      => true,
    ],
    'description' => [
        'label'         => 'Miêu tả',
        'type'          => 'textarea',
        'required'      => false,
    ],
  
];
