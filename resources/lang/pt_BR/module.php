<?php

$modules = [
    [
        'handler'  => 'priority',
        'title'    => 'Prioridades',
        'describe' => 'prioridade'
    ],
    [
        'handler'  => 'category',
        'title'    => 'Categorias',
        'describe' => 'categoria'
    ],
];

$trans = [];

foreach (json_decode(json_encode($modules)) as $item) {
    $trans[$item->handler] = [
        'title'         => $item->title,
        'add'           => "Nova {$item->describe}",
        'add_title'     => "Nova {$item->describe}",
        'add_subtitle'  => "Cadastro de nova {$item->describe}",
        'edit_title'    => "Editar {$item->describe}",
        'edit_subtitle' => "Edição dos dados da {$item->describe}",
        'show_title'    => "Visualizar {$item->describe}",
        'show_subtitle' => "Visualizar informações da {$item->describe}"
    ];
}

// Custom
// $trans['example'] = [
//     'title'         => "Examples",
//     'add'           => "Nova example",
//     'add_title'     => "Nova example",
//     'add_subtitle'  => "Cadastro de nova example",
//     'edit_title'    => "Editar example",
//     'edit_subtitle' => "Edição dos dados da example",
//     'show_title'    => "Visualizar example",
//     'show_subtitle' => "Visualizar informações da example"
// ];

return $trans;