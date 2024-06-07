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
                        'name' => 'Gnou',
                        'animals' => [
                            [
                                'id' => 845,
                                'name' => 'Thomas',
                                'imgs' => ['img-wildebeest.jpg'],
                                'state' => 'healthy',
                                'foods' => [
                                    'Orge' => '30g',
                                    'Céréales' => '1kg'
                                ],
                                'last_visit_date' => '05/29/2021',
                                'veterynary_review' => 'Elle va super bien cette grosse bébête !'

                            ],
                            [
                                'id' => 56,
                                'name' => 'Thomas',
                                'imgs' => ['img-wildebeest.jpg'],
                                'state' => 'healthy',
                                'foods' => [
                                    'Orge' => '30g',
                                    'Céréales' => '1kg'
                                ],
                                'last_visit_date' => '05/29/2021',
                                'veterynary_review' => 'Elle va super bien cette grosse bébête !'
                            ],
                            [
                                'id' => 46165,
                                'name' => 'Thomas',
                                'imgs' => ['img-wildebeest.jpg'],
                                'state' => 'healthy',
                                'foods' => [
                                    'Orge' => '30g',
                                    'Céréales' => '1kg'
                                ],
                                'last_visit_date' => '05/29/2021',
                                'veterynary_review' => 'Elle va super bien cette grosse bébête !'
                            ]
                        ]
                    ],
                    [
                        'name' => 'Hyene',
                        'animals' => [
                            [
                                'id' => 7852,
                                'name' => 'Thomas',
                                'imgs' => ['img-hyena.jpg'],
                                'state' => 'healthy',
                                'foods' => [
                                    'Orge' => '30g',
                                    'Céréales' => '1kg'
                                ],
                                'last_visit_date' => '05/29/2021',
                                'veterynary_review' => 'Elle va super bien cette grosse bébête !'
                            ],
                            [
                                'id' => 154,
                                'name' => 'Thomas',
                                'imgs' => ['img-hyena.jpg'],
                                'state' => 'healthy',
                                'foods' => [
                                    'Orge' => '30g',
                                    'Céréales' => '1kg'
                                ],
                                'last_visit_date' => '05/29/2021',
                                'veterynary_review' => 'Elle va super bien cette grosse bébête !'
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
                                'id' => 3654,
                                'name' => 'Thomas',
                                'imgs' => ['img-giraffe.jpg'],
                                'state' => 'healthy',
                                'foods' => [
                                    'Orge' => '30g',
                                    'Céréales' => '1kg'
                                ],
                                'last_visit_date' => '05/29/2021',
                                'veterynary_review' => 'Elle va super bien cette grosse bébête !'
                            ],
                            [
                                'id' => 8463,
                                'name' => 'Thomas',
                                'imgs' => ['img-giraffe.jpg'],
                                'state' => 'healthy',
                                'foods' => [
                                    'Orge' => '30g',
                                    'Céréales' => '1kg'
                                ],
                                'last_visit_date' => '05/29/2021',
                                'veterynary_review' => 'Elle va super bien cette grosse bébête !'
                            ],
                            [
                                'id' => 64452,
                                'name' => 'Thomas',
                                'imgs' => ['img-giraffe.jpg'],
                                'state' => 'healthy',
                                'foods' => [
                                    'Orge' => '30g',
                                    'Céréales' => '1kg'
                                ],
                                'last_visit_date' => '05/29/2021',
                                'veterynary_review' => 'Elle va super bien cette grosse bébête !'
                            ]
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Marais',
                'img' => 'bg-swamp.jpg',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin rutrum ornare purus, at egestas massa rhoncus in. Suspendisse pulvinar nibh non laoreet volutpat. Vivamus libero mauris, lacinia ac rhoncus et, efficitur a nisl. Duis turpis nibh, porttitor in felis in, congue dignissim ex. Ut et nisi dapibus, lobortis ligula id, facilisis libero. Nunc arcu arcu, congue ac suscipit sit amet, elementum eget nibh. Nulla tristique cursus ipsum in bibendum. Donec molestie finibus sapien in egestas. Integer semper diam eget velit mattis, vel tincidunt purus semper. Mauris ut aliquam nibh. Duis libero felis, suscipit sed erat at, varius consectetur dui. Proin sollicitudin sed tortor id semper. Phasellus metus leo, aliquam in hendrerit eget, fringilla sit amet metus. Nunc mi risus, facilisis sed ornare a, posuere in mauris. In blandit massa tellus. Nulla maximus erat et eros viverra interdum.',
                'species' => [
                    [
                        'name' => 'Lion',
                        'animals' => [
                            [
                                'id' => 15448,
                                'name' => 'Thomas',
                                'imgs' => ['img-giraffe.jpg'],
                                'state' => 'healthy',
                                'foods' => [
                                    'Orge' => '30g',
                                    'Céréales' => '1kg'
                                ],
                                'last_visit_date' => '05/29/2021',
                                'veterynary_review' => 'Elle va super bien cette grosse bébête !'
                            ],
                            [
                                'id' => 4785,
                                'name' => 'Thomas',
                                'imgs' => ['img-giraffe.jpg'],
                                'state' => 'healthy',
                                'foods' => [
                                    'Orge' => '30g',
                                    'Céréales' => '1kg'
                                ],
                                'last_visit_date' => '05/29/2021',
                                'veterynary_review' => 'Elle va super bien cette grosse bébête !'
                            ],
                            [
                                'id' => 965478,
                                'name' => 'Thomas',
                                'imgs' => ['img-giraffe.jpg'],
                                'state' => 'healthy',
                                'foods' => [
                                    'Orge' => '30g',
                                    'Céréales' => '1kg'
                                ],
                                'last_visit_date' => '05/29/2021',
                                'veterynary_review' => 'Elle va super bien cette grosse bébête !'
                            ],
                        ]
                    ]
                ]
            ]
        ];

        return ['habitats' => $habitats];
    }
}