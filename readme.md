## Control the work

[Control the work](https://www.controlthework.com/) is is a web application 
to control the checkins and checkouts in the workplace.

- Responsive.
- Multilingual.
- Easy to use.

## Installation

Access to the server folder:

```
$ cd /var/www/your-domain.com
```

Download the repo from GitHub into this folder:

```
$ git clone https://github.com/control-the-work/control-the-work .
```

Install the dependencies:

```
$ composer install --no-dev
```

Create the .env file where the application stores some important variables:

```
$ cp .env.example .env
```

Change the APP_URL in the .env file to adapt it to your installation:

```
APP_URL=http://controlthework.test
```

Change the database values in the .env file to adapt it to your installation:

```
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=control-the-work
DB_USERNAME=homestead
DB_PASSWORD=secret
```

Change the email values in the .env file to adapt it to your installation:
    
```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=no-reply@controlthework.com
```

Set a new application key:

```
$ php artisan key:generate
```

Execute the migration to create the tables and to populate it with some 
required data:

```
$ php artisan migrate --seed
```

If the database is not empty, please delete all the information if it is the
first installation. The next command deletes all the tables and the information
in the database:

```
$ php artisan migrate:fresh --seed
```

Execute the installer and answer to the questions: 

```
$ php artisan control-the-work:install 
```

You can execute the installer in English (en) or Spanish (es) using the 
"--language" parameter:

```
$ php artisan control-the-work:install --language=es
```

Be careful to point your Virtual Host (Apache) or your Server Block (NGINX) 
to the "public" folder.

**Virtual Host (Apache)**
```
<VirtualHost *:80>
    DocumentRoot "/var/www/your-domain.com/public"
    ServerName www.your-domain.com
    # Other directives here
</VirtualHost>
```
**Server Block (NGINX)**
```
server {
    listen 80;
    listen 443 ssl http2;
    server_name www.your-domain.com;
    root "/var/www/your-domain.com/public";
    # Other directives here    
    }
```

That's all folks!

## Security Vulnerabilities

If you discover a security vulnerability within "Control the work", please 
send an e-mail to Jesús Amieiro via 
[hello@controlthework.com](mailto:hello@controlthework.com). 
All security vulnerabilities will be promptly addressed.

## License

"Control the Work" is open-source software licensed under the 
[AGPL license](https://opensource.org/licenses/AGPL-3.0).

## Components

This project uses this components:

- [Tabler, a Bootstrap 4 template](https://github.com/tabler/tabler)
- [Laravel](https://laravel.com/)
- [Feather icons](https://github.com/feathericons/feather)
- [User icons](https://www.iconfinder.com/iconsets/ios-7-icons) 
- [Country List](https://github.com/umpirsky/country-list)