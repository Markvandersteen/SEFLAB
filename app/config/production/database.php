<?php

return array(

    'connections' => array(

        'mysql' => array(
            'host'      => $_ENV['db_host'],
            'database'  => $_ENV['db_database'],
            'username'  => $_ENV['db_username'],
            'password'  => $_ENV['db_password']
        )
    )

);