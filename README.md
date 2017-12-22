# Inspirational Blog - Installation Guide

* Clone the repository, as mentioned below:-

* To clone the repository with HTTPS, use the following command.
```
git clone https://github.com/ali223/inspirationalblog.git
```

* To clone the repository with SSH, use the following command.
```
git clone git@github.com:ali223/inspirationalblog.git
```

* After cloning the repository, run `cd inspirationalblog`

* Then run `composer install`

* Copy `.env.example` file to `.env`

* Create a new MySQL database named `inspirationalblogdb`

* Open `.env` file and set the following environment variables to the values according to your local MySQL installation. Here, I have specified some example values, so change them as required.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inspirationalblogdb
DB_USERNAME=root
DB_PASSWORD=
```

* Run `php artisan key:generate` 

* To create the database tables with the seed data, run the following:-
 ```php artisan migrate --seed```

* Now to start the local development web server, run `php artisan serve`

* Now, you can view the website in your web browser. Open the web browser and enter `http://localhost:8000/` in the address bar.
