### Restaurant Stock Management (Coding Challenge)

- This project is created based on version 9.

####Installatoin

* Clone the github repo to your machine.
* Create a new database and update your .env varaibales as follows:
  * DB_CONNECTION=mysql
 * DB_HOST=localhost
 * DB_PORT=3306
 * DB_DATABASE=DB_NAME
 * DB_USERNAME=DB_USER
 * DB_PASSWORD=DB_PASSWORD
 * QUEUE_CONNECTION=database
* Open your terminal and run the following commands:
 * `php artisan migrate`
 * `php artisan db:seed`

####Running Tests
* To run application tests open your terminal and run the following  `php artisan test`
* If you have Postman installed:
 * Import the collection file `coding-challenge.postman_collection.json`
 * Create new environment and add one variable `base_url`
 * Serve the application by running `php artisan serve`
 * Copy application url from the terminal `e.g. http://127.0.0.1:8000`
 * Update Postman base_url env variable with that url
 * Open `New Order` request and click send 
