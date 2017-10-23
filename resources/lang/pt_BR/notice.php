<?php

$modules = [
    [
        'handler'  => 'priority',
        'title'    => 'Prioridade',
        'describe' => 'prioridade'
    ],
    [
        'handler'  => 'category',
        'title'    => 'Categoria',
        'describe' => 'categoria'
    ],
    [
        'handler'  => 'ticket',
        'title'    => 'Ticket',
        'describe' => 'ticket'
    ],
];

$trans = [];

foreach (json_decode(json_encode($modules)) as $item) {
    $trans[$item->handler] = [
        'success' => "{$item->title} :action com sucesso!",
        'error'   => "Erro ao :action {$item->describe}.",
    ];
}

// Custom
// $trans['example'] = [
//     'success' => 'Example :actiona com sucesso!',
//     'error'   => 'Erro ao :action example.'
// ];

return $trans;
