<?php
return [
    "router" => [
        '/' => '../views/main.php',
        '/about' => '../views/about.php',
        '/create' => '../views/create.php',
        '/edit' => '../views/edit.php',
        '/create/newuser' => '../create_user.php',
        '/edit/user' => '../edit_user.php'
    ],

    "database" => [
        "host" => "localhost",
        "database" => "profiles",
        "charset" => "utf8",
        "username" => "root",
        "password" => ""
    ]
];