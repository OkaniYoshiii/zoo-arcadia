<?php 

class ServicesController 
{
    public function getVariables(): array
    {
        $services = [
            "Restauration" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tempora ipsa ut, est, tempore necessitatibus odio fuga asperiores dolore blanditiis pariatur expedita consectetur veniam aliquam, maiores perspiciatis? Velit quo nemo deserunt?Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi totam delectus, fugiat laborum aut nesciunt temporibus quo, autem minus dicta, ratione at nemo suscipit quas sit. Ipsum commodi alias perferendis.Exercitationem veritatis quasi numquam tempore ad enim fugiat dolorem ratione ut nam dolore quaerat hic impedit inventore omnis minima, saepe quis in commodi facere! Dolorum et eum commodi! Impedit, eius.",
            "Visite en petit train" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tempora ipsa ut, est, tempore necessitatibus odio fuga asperiores dolore blanditiis pariatur expedita consectetur veniam aliquam, maiores perspiciatis? Velit quo nemo deserunt?Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi totam delectus, fugiat laborum aut nesciunt temporibus quo, autem minus dicta, ratione at nemo suscipit quas sit. Ipsum commodi alias perferendis.Exercitationem veritatis quasi numquam tempore ad enim fugiat dolorem ratione ut nam dolore quaerat hic impedit inventore omnis minima, saepe quis in commodi facere! Dolorum et eum commodi! Impedit, eius.",
            "Visite des habitats" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tempora ipsa ut, est, tempore necessitatibus odio fuga asperiores dolore blanditiis pariatur expedita consectetur veniam aliquam, maiores perspiciatis? Velit quo nemo deserunt?Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi totam delectus, fugiat laborum aut nesciunt temporibus quo, autem minus dicta, ratione at nemo suscipit quas sit. Ipsum commodi alias perferendis.Exercitationem veritatis quasi numquam tempore ad enim fugiat dolorem ratione ut nam dolore quaerat hic impedit inventore omnis minima, saepe quis in commodi facere! Dolorum et eum commodi! Impedit, eius."
        ];

        return ["services" => $services];
    }
}