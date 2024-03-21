# Getting Started
here's some step for run the project (note: tested on php 8.1)

## How to run
1. Clone Repository
```
Git clone https://github.com/riskids/tech-test-detik.com.git
```

2. Install package
``` 
composer install 
```

3. Setup environment at env.php
```
$variables = [
    'DB_HOST' => 'localhost',
    'DB_USERNAME' => 'root',
    'DB_PASSWORD' => '',
    'DB_NAME' => 'test_detikcom',
    'DB_PORT' => 3306,
];
```

4. Create database<br/>
Crete MySql Database named test_detikcom

5. Migrate the table
```
./vendor/bin/phinx migrate -e development
```

6. Run server
```
php -S localhost:8000
```

7. Update transaction
```
php ./generate-ticket.php {event_id} {total_ticket}
```

## Documentation
- For API Documentation check on [Postman](https://documenter.getpostman.com/view/32017167/2sA35A74pd)

