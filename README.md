# Php against Humanity

## What is <i>Php against Humanity</i>?

PaH is a clone of the Cards against Humanity&trade; card game. 
It is written as a web app and uses [Codeigniter 4](https://codeigniter.com/) and [Bootstrap 4](https://getbootstrap.com/) as well as [Font Awesome Free 5](https://github.com/FortAwesome/Font-Awesome).

## Installation
### Server Requirements
1. Apache Webserver with rewrite and php modules
2. PHP version 7.2 or higher is required, with the following extensions installed and enabled: 
    - [intl](http://php.net/manual/en/intl.requirements.php)
    - [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
    - json (enabled by default - don't turn it off)
    - xml (enabled by default - don't turn it off)
    - [mbstring](http://php.net/manual/en/mbstring.installation.php)
    - [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
 
3. MySQL or compatible database server

<i>The server was developed and tested on a Raspberry Pi 3B. </i>

### Installation steps
1. Download the [master branch's zip package](https://github.com/pietrobe03/php-against-humanity/archive/master.zip). (Alternatively you can clone this repo.)
2. Extract the package's contents to your web server directory (e.g. ```/var/www/html/cah```).
3. Create a mysql database for the game.
4. Import ```install/base.sql``` to the database. This will create the table structure and store all the cards in the db.
5. Copy or rename file ```.env_example``` to ```.env```.
6. Edit ```.env``` and fill in the missing data.

If everything is configured correctly, you should now be able to play the game.

## Special Thanks
Special thanks for testing and bug reporting to:
M.B., M.E., B.G., S.L., J.S.,L.S., A.W.

Developed by R.J.P.
