<?php 

use Interfaces\Controller;

class HabitatsController implements Controller
{
    public function getVariables(): array
    {
        $habitats = [
            [
                'name' => 'Savane',
                'img' => 'bg-savannah-bridge.jpg',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin rutrum ornare purus, at egestas massa rhoncus in. Suspendisse pulvinar nibh non laoreet volutpat. Vivamus libero mauris, lacinia ac rhoncus et, efficitur a nisl. Duis turpis nibh, porttitor in felis in, congue dignissim ex. Ut et nisi dapibus, lobortis ligula id, facilisis libero. Nunc arcu arcu, congue ac suscipit sit amet, elementum eget nibh. Nulla tristique cursus ipsum in bibendum. Donec molestie finibus sapien in egestas. Integer semper diam eget velit mattis, vel tincidunt purus semper. Mauris ut aliquam nibh. Duis libero felis, suscipit sed erat at, varius consectetur dui. Proin sollicitudin sed tortor id semper. Phasellus metus leo, aliquam in hendrerit eget, fringilla sit amet metus. Nunc mi risus, facilisis sed ornare a, posuere in mauris. In blandit massa tellus. Nulla maximus erat et eros viverra interdum.',
                'species' => [
                    [
                        'name' => 'Lion',
                        'animals' => [
                            [
                                'name' => 'Thomas'
                            ],
                            [
                                'name' => 'Patate'
                            ],
                            [
                                'name' => 'Hamburger'
                            ]
                        ]
                    ],
                    [
                        'name' => 'Hyene',
                        'animals' => [
                            [
                                'name' => 'Thomas'
                            ],
                            [
                                'name' => 'Patate'
                            ]
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Jungle',
                'img' => 'bg-jungle.jpg',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin rutrum ornare purus, at egestas massa rhoncus in. Suspendisse pulvinar nibh non laoreet volutpat. Vivamus libero mauris, lacinia ac rhoncus et, efficitur a nisl. Duis turpis nibh, porttitor in felis in, congue dignissim ex. Ut et nisi dapibus, lobortis ligula id, facilisis libero. Nunc arcu arcu, congue ac suscipit sit amet, elementum eget nibh. Nulla tristique cursus ipsum in bibendum. Donec molestie finibus sapien in egestas. Integer semper diam eget velit mattis, vel tincidunt purus semper. Mauris ut aliquam nibh. Duis libero felis, suscipit sed erat at, varius consectetur dui. Proin sollicitudin sed tortor id semper. Phasellus metus leo, aliquam in hendrerit eget, fringilla sit amet metus. Nunc mi risus, facilisis sed ornare a, posuere in mauris. In blandit massa tellus. Nulla maximus erat et eros viverra interdum.',
                'species' => [
                    [
                        'name' => 'Lion',
                        'animals' => [
                            [
                                'name' => 'Thomas'
                            ],
                            [
                                'name' => 'Patate'
                            ],
                            [
                                'name' => 'Hamburger'
                            ]
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Aquatique',
                'img' => 'bg-submarine.jpg',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin rutrum ornare purus, at egestas massa rhoncus in. Suspendisse pulvinar nibh non laoreet volutpat. Vivamus libero mauris, lacinia ac rhoncus et, efficitur a nisl. Duis turpis nibh, porttitor in felis in, congue dignissim ex. Ut et nisi dapibus, lobortis ligula id, facilisis libero. Nunc arcu arcu, congue ac suscipit sit amet, elementum eget nibh. Nulla tristique cursus ipsum in bibendum. Donec molestie finibus sapien in egestas. Integer semper diam eget velit mattis, vel tincidunt purus semper. Mauris ut aliquam nibh. Duis libero felis, suscipit sed erat at, varius consectetur dui. Proin sollicitudin sed tortor id semper. Phasellus metus leo, aliquam in hendrerit eget, fringilla sit amet metus. Nunc mi risus, facilisis sed ornare a, posuere in mauris. In blandit massa tellus. Nulla maximus erat et eros viverra interdum.',
                'species' => [
                    [
                        'name' => 'Lion',
                        'animals' => [
                            [
                                'name' => 'Thomas'
                            ],
                            [
                                'name' => 'Patate'
                            ],
                            [
                                'name' => 'Hamburger'
                            ]
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Arctique',
                'img' => 'bg-arctic.jpg',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin rutrum ornare purus, at egestas massa rhoncus in. Suspendisse pulvinar nibh non laoreet volutpat. Vivamus libero mauris, lacinia ac rhoncus et, efficitur a nisl. Duis turpis nibh, porttitor in felis in, congue dignissim ex. Ut et nisi dapibus, lobortis ligula id, facilisis libero. Nunc arcu arcu, congue ac suscipit sit amet, elementum eget nibh. Nulla tristique cursus ipsum in bibendum. Donec molestie finibus sapien in egestas. Integer semper diam eget velit mattis, vel tincidunt purus semper. Mauris ut aliquam nibh. Duis libero felis, suscipit sed erat at, varius consectetur dui. Proin sollicitudin sed tortor id semper. Phasellus metus leo, aliquam in hendrerit eget, fringilla sit amet metus. Nunc mi risus, facilisis sed ornare a, posuere in mauris. In blandit massa tellus. Nulla maximus erat et eros viverra interdum.',
                'species' => [
                    [
                        'name' => 'Lion',
                        'animals' => [
                            [
                                'name' => 'Thomas'
                            ],
                            [
                                'name' => 'Patate'
                            ],
                            [
                                'name' => 'Hamburger'
                            ]
                        ]
                    ]
                ]
            ]
        ];

        return ['habitats' => $habitats];
    }
}