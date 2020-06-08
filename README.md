# ZF2 / ExtJS4 example (Library App)


# Install

  - composer install
  - import sql (sql.sql)

# Settings

This text you see here is *actually* written in Markdown! To get a feel for Markdown's syntax, type some text into the left window and watch the results in the right.

You have to create local settings file to connect to PostgreSQL db:
``` SH
.../app/config/autoload/doctrine.local.php
```

```
<?php

return array(
    'doctrine' => array(
        'connection' => array(
            // default connection name
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOPgSql\Driver',
                'params' => array(
                    'host' => 'localhost',
                    'port' => '5432',
                    'user' => 'USER',
                    'password' => 'PASSWORD',
                    'dbname' => 'DB_NAME'
                )
            )
        )
    )
);
```