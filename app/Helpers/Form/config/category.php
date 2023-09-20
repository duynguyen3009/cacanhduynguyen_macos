<?php
return [
    
    'name' => [
        'label'         => 'Tên',
        'type'          => 'input',
        'required'      => true,
    ],
    'parent' => [
        'label'         => 'Danh mục cha hoặc con',
        'type'          => 'select2',
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
];
