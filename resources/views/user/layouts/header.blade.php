
@php
    $menu = [
        ['name' => 'Home', 'href'=>route('home')],
        [
            'name' => 'Category',
            'href'=>'#',
            'menu2'=>[
                [
                    'name' => 'Category 1',
                    'href' => '#',
                    'menu3' => [
                        ['name' => 'Subcategoty 1 ', 'href' => '#'],
                        ['name' => 'Subcategoty 2 ', 'href' => '#'],
                    ]
                ],
                [
                    'name' => 'Category 2',
                    'href' => '#',
                    'menu3' => [
                        ['name' => 'Subcategoty 1 ', 'href' => '#'],
                        ['name' => 'Subcategoty 2 ', 'href' => '#'],
                    ]
                ],
                ['name' => 'All Category', 'href'=>route('home')],
            ]
        ],
        ['name' => 'About Us', 'href'=>route('about')],
        ['name' => 'Contact', 'href'=>route('contact')],

    ]
@endphp
<x-user.layout.header :menu="$menu" />
