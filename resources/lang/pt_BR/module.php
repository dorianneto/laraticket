<?php

$modules = [
    [
        'handler'  => 'priority',
        'title'    => 'Prioridades',
        'describe' => 'prioridade',
        'genre'    => 'f'
    ],
    [
        'handler'  => 'category',
        'title'    => 'Categorias',
        'describe' => 'categoria',
        'genre'    => 'f'
    ],
    [
        'handler'  => 'ticket',
        'title'    => 'Tickets',
        'describe' => 'ticket',
        'genre'    => 'm'
    ],
];

$trans = [];

foreach (json_decode(json_encode($modules)) as $item) {
    $add  = ($item->genre == 'f' ? 'Nova' : 'Novo');
    $from = ($item->genre == 'f' ? 'da' : 'do');

    $trans[$item->handler] = [
        'title'         => $item->title,
        'add'           => "$add {$item->describe}",
        'add_title'     => "$add {$item->describe}",
        'add_subtitle'  => "Cadastro de " . strtolower($add) . " {$item->describe}",
        'edit_title'    => "Editar {$item->describe}",
        'edit_subtitle' => "Edição dos dados $from {$item->describe}",
        'show_title'    => "Visualizar {$item->describe}",
        'show_subtitle' => "Visualizar informações $from {$item->describe}"
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