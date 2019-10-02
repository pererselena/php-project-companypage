<?php
/**
 * Supply the basis for the navbar as an array.
 */


return [
    // Use for styling the menu
    "wrapper" => null,
    "class" => "my-navbar rm-default rm-desktop",

    // Here comes the menu items
    "items" => [
        [
            "text" => "Hem",
            "url" => "",
            "title" => "Första sidan, börja här.",
        ],
        [
            "text" => "Om",
            "url" => "om",
            "title" => "Om denna webbplats.",
        ],
        [
            "text" => "Docs",
            "url" => "dokumentation",
            "title" => "Dokumentation av ramverk och liknande.",
        ],
        [
            "text" => "Produkter",
            "url" => "product",
            "title" => "Produkter",
        ],
        [
            "text" => "Content",
            "url" => "content",
            "title" => "Content",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Nyheter",
                        "url" => "content/blog",
                        "title" => "Nyheter",
                    ],
                    [
                        "text" => "Erbjudande",
                        "url" => "content/offer",
                        "title" => "Erbjudande",
                    ],
                ],
            ],
        ],
        [
            "text" => "Logga in",
            "url" => "login",
            "title" => "Logga in",
        ],
    ],
];
