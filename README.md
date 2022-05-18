## Requirements

This backend project is created with [Laravel](https://laravel.com/).

- [XAMPP](https://www.apachefriends.org/download.html).
- [Postman](https://www.postman.com/downloads/).
- [Visual Studio Code](https://code.visualstudio.com/download)
- [Composer](https://getcomposer.org/download/)

## Instructions

- Run XAMPP and start Apache and MySQL.
- On your browser, go to localhost and create a database named "parking-system".
- Open the project inside the Visual Studio Code.
- Rename ".env.example" to ".env" and change line 14 into "DB_DATABASE=parking-system"
- Open terminal inside the project and run "composer install". This command will install all the required packages needed for the project to run.
- Run "php artisan migrate". This command will update the "parking-system" database and migrate all the tables.
- Run "php artisan serve". This command will execute the project.
- Open Postman and send some [HTTP Request](https://learning.postman.com/docs/getting-started/sending-the-first-request/). For example, set Enter request URL to "http://localhost:8000/api/customers" and click "Send" button. It will display all the customers registered to the database.

## Additional Notes

You may refer to this files to know the required HTTP Request URL:
- parking-backend/app/Http/Controllers/CustomerController.php
- parking-backend/app/Http/Controllers/AuthController.php
- parking-backend/routes/api.php

## License and Disclosure
This project was created in compliance of the author's academic project requirements. This project can be used for any purposes and under MIT License.
