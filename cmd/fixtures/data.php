<?php

$scheduleHours = [
    [
        'hour' => '8h-9h'
    ],
    [
        'hour' => '9h-10h'
    ],
    [
        'hour' => '10h-11h'
    ],
    [
        'hour' => '11h-12h'
    ],
    [
        'hour' => '12h-13h'
    ],
    [
        'hour' => '13h-14h'
    ],
    [
        'hour' => '14h-15h'
    ],
    [
        'hour' => '15h-16h'
    ],
    [
        'hour' => '16h-17h'
    ],
];

$weekDays = [
    [
        'day' => 'Lundi'
    ],
    [
        'day' => 'Mardi'
    ],
    [
        'day' => 'Mercredi'
    ],
    [
        'day' => 'Jeudi'
    ],
    [
        'day' => 'Vendredi'
    ],
    [
        'day' => 'Samedi'
    ],
    [
        'day' => 'Dimanche'
    ],
];

$schedules = [];
foreach($weekDays as $dayIndex => $weekDay)
{
    foreach($scheduleHours as $hourIndex => $scheduleHour)
    {
        $schedules[] = ['week_day_id' => $dayIndex + 1, 'schedule_hour_id' => $hourIndex + 1, 'is_opened' => (rand(0, 1) > 0.5)];
    }
}

$roles = [
    [
        'name' => 'ROLE_ADMIN',
    ],
    [
        'name' => 'ROLE_EMPLOYEE',
    ],
    [
        'name' => 'ROLE_VETERINARIAN',
    ],
];

$users = [
    [
        'username' => 'admin@test.com',
        'pwd' => 'admin',
        'firstname' => 'José',
        'lastname' => '',
        'role_id' => 1,
    ],
    [
        'username' => 'employee@test.com',
        'pwd' => 'employee',
        'firstname' => 'Damien',
        'lastname' => 'Dupont',
        'role_id' => 2,
    ],
    [
        'username' => 'veterinarian@test.com',
        'pwd' => 'veterinarian',
        'firstname' => 'Michelle',
        'lastname' => 'Crossing',
        'role_id' => 3,
    ],
];

$habitats = [
    [
        'name' => 'Savane',
        'description' => 'bonjour',
        'veterinarian_comments' => 'bonjour',
    ],
    [
        'name' => 'Jungle',
        'description' => 'bonjour',
        'veterinarian_comments' => 'bonjour',
    ],
    [
        'name' => 'Marais',
        'description' => 'bonjour',
        'veterinarian_comments' => 'bonjour',
    ],
];

$habitatImages = [
    [
        'name' => IMG_DIR . '/bg-savannah-bridge.webp',
        'habitat_id' => 1,
    ],
    [
        'name' => IMG_DIR . '/bg-jungle.webp',
        'habitat_id' => 2,
    ],
    [
        'name' => IMG_DIR . '/bg-africa.webp',
        'habitat_id' => 3,
    ],
];

$foodTypes = [
    [
        'name' => 'Céréales',
    ],
    [
        'name' => 'Orge',
    ],
    [
        'name' => 'Blé',
    ],
    [
        'name' => 'Viande',
    ],
    [
        'name' => 'Patate',
    ],
];

$breeds = [
    [
        'name' => 'Lion',
    ],
    [
        'name' => 'Zèbre',
    ],
    [
        'name' => 'Hyene',
    ],
    [
        'name' => 'Elephant',
    ],
    [
        'name' => 'Tigre',
    ],
];

$animals = [
    [
        'firstname' => 'Pierre',
        'state' => 'Malade',
        'breed_id' => 1,
        'habitat_id' => 1,
    ],
    [
        'firstname' => 'Mathieu',
        'state' => 'Sain',
        'breed_id' => 2,
        'habitat_id' => 2,
    ],
    [
        'firstname' => 'Patate',
        'state' => 'Blessé',
        'breed_id' => 3,
        'habitat_id' => 1,
    ],
    [
        'firstname' => 'Pomme',
        'state' => 'Sain',
        'breed_id' => 1,
        'habitat_id' => 3,
    ]
];

$foodUnits = [
    [
        'name' => 'mg',
    ],
    [
        'name' => 'g',
    ],
    [
        'name' => 'kg',
    ],
];

$veterinarianReports = [
    [
        'date' => date('Y-m-d', strtotime('2022-05-23')),
        'detail' => 'Prise de sang et tests oculaires. Aucun soucis à signaler.',
        'food_quantity' => 30,
        'food_unit_id' => 2, 
        'user_id' => 3,
        'food_type_id' => 2,
        'animal_id' => 1,
    ],
];

$animalImages = [
    [
        'name' => 'img-elephant.webp',
        'animal_id' => 1,
    ],
    [
        'name' => 'img-giraffa-1.webp',
        'animal_id' => 2,
    ],
    [
        'name' => 'img-giraffa-2.webp',
        'animal_id' => 3,
    ],
    [
        'name' => 'img-giraffa-3.webp',
        'animal_id' => 2,
    ],
    [
        'name' => 'img-gorilla.webp',
        'animal_id' => 4,
    ],
];

$employeeReports = [
    [
        'date' => date('Y-m-d', strtotime('2022-05-23')),
        'food_quantity' => 30,
        'food_type_id' => 2,
        'food_unit_id' => 1,
        'animal_id' => 1,
    ]
];