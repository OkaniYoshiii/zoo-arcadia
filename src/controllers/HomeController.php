<?php

class HomeController {
    public function getVariables() : array  {
        $domains = [
            "Savane" => [
                "animals" => [
                    "Goerge" => "https://picsum.photos/500",
                    "Julie" => "https://picsum.photos/500",
                    "Timothée" => "https://picsum.photos/500",
                    "Nounours" => "https://picsum.photos/500",
                ],
                "description" => "<p>Environement propre aux régions chaudes, la savane regroupe de nombreux animaux comme  zèbres, les gnous, les éléphants, les girafes, les autruches, les gazelles et les buffles.</p><p>A Arcadia, nous avons fait notre maximum afin de recréer un environnement réprésentant le plus fidèlement possible l'état naturel de la savane. </p>"
            ],
            "Jungle" => [
                "animals" => [
                    "Patate" => "https://picsum.photos/500",
                    "Abeille" => "https://picsum.photos/500",
                    "Pingouin" => "https://picsum.photos/500",
                ],
                "description" => "<p>Environement propre aux régions chaudes, la savane regroupe de nombreux animaux comme  zèbres, les gnous, les éléphants, les girafes, les autruches, les gazelles et les buffles.</p><p>A Arcadia, nous avons fait notre maximum afin de recréer un environnement réprésentant le plus fidèlement possible l'état naturel de la savane. </p>"
            ],
            "Toundra" => [
                "animals" => [
                    "Patate" => "https://picsum.photos/500",
                    "Abeille" => "https://picsum.photos/500",
                    "Pingouin" => "https://picsum.photos/500",
                    "Mante" => "https://picsum.photos/500",
                ],
                "description" => "<p>Environement propre aux régions chaudes, la savane regroupe de nombreux animaux comme  zèbres, les gnous, les éléphants, les girafes, les autruches, les gazelles et les buffles.</p><p>A Arcadia, nous avons fait notre maximum afin de recréer un environnement réprésentant le plus fidèlement possible l'état naturel de la savane. </p>"
            ]
        ];
        
        $services = [
            "Restauration" => "https://picsum.photos/500",
            "Visite en petit train" => "https://picsum.photos/400",
            "Visite des habitats" => "https://picsum.photos/600"
        ];
        
        $feedbacks = [ 
            ["publish_date" => "05-02-2024", "user" => "Jean Marie Guillemot", "content" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore ratione qui neque soluta impedit, aspernatur illum? Amet fugiat, natus, asperiores enim harum laudantium veniam voluptatum, quaerat qui exercitationem distinctio sed."],
            ["publish_date" => "06-02-2022", "user" => "Baptiste LeGuillemet", "content" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore ratione qui neque soluta impedit, aspernatur illum? Amet fugiat, natus, asperiores enim harum laudantium veniam voluptatum, quaerat qui exercitationem distinctio sed."],
            ["publish_date" => "25-06-2021", "user" => "Pierre Patate", "content" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore ratione qui neque soluta impedit, aspernatur illum? Amet fugiat, natus, asperiores enim harum laudantium veniam voluptatum, quaerat qui exercitationem distinctio sed."]
        ];
        
        $pages = [
            "current" => 1,
            "total" => 1
        ];

        return ["domains" => $domains, "services" => $services, "feedbacks" => $feedbacks, "pages" => $pages];
    }
}