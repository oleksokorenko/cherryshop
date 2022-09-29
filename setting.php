<?php
const FORM_FIELDS_CONDITIONS = [
    "order" => [
        "puchases" => [
            "required" => 1,
            "condition" => null,
            "name" => "Dane pro zakupy"
        ],
        "phone" => [
            "required" => 1,
            "condition" => "/^\+\d{12}$/",
            "name" => "Numer telephonu"
        ],
        "email" => [
            "required" => 1,
            "condition" => "/^[\w\D\-\_]{2,50}@[\w\D\-\_]{2,50}\.\w{2,5}$/ui",
            "name" => "Adres email"
        ], 
        "name" => [
            "required" => 1,
            "condition" => "/^[\w\s]{2,100}$/ui",
            "name" => "Imię"
        ],
        "address" => [
            "required" => 1,
            "condition" => "/^.{2,100}$/ui",
            "name" => "adres"
        ], 
        "comment" => [
            "required" => 1,
            "condition" => null,
            "name" => "Comentarij"
        ],
    ],
    "review" => [ 
        "email" => 1, 
        "name" => 0, 
        "comment" => 1,
    ]
];