# Locus Framework
![](assets/images/logo.png)
Locus is a mini framework for PHP. In other words, we can consider it as a project structure instead of a framework. Because Locus is just a combination of multiple packages of PHP.

The main aim of the Locus framework is to combine front-end preset with core PHP development. We used Laravel Mix in this framework. By default Locus comes with React preset. But you can create any preset as per your need. Hope we release other presets very soon.

## Introduction
### Installation
To use this framework you can use simply download this repository and extract you your project. In other hands, if you use git, you can clone it by using the below command.

``
git clone url
``

Once the project is installed, the file structure will look like as follows.

```
Locus Framework
|
└───assets
│   │___css
|   |   |___style.css
│   │___images
|   |   |___logo.png
|   |___js
|   |   |___index.js
│   |
└───Config
|   │___Utilities.php
|   │___Variables.php
|   |
|___Controllers
|   |___Controller.php
|   |___IndexController.php
|   |
|___Helpers
|   |___DB.php
|   |___File.php
|   |___Mail.php
|   |___Validation.php
|   |
|___src
|   |___components
|   |   |___HelloWorld.jsx
|   |___index.js
|   |
|___Storage
|   |
|___views
|   |___errors
|   |   |___404.php
|   |___mails
|   |   |___mail.php
|   |___welcome.php
|   |
|___.babelrc
|___.htaccess
|___composer.json
|___composer.lock
|___index.php
|___package-lock.json
|___package.json
|___README.md
|___webpack.mix.js
```

### Requirements
* PHP 7.0 (or) Above
* Composer
* Node JS / NPM

### Packages Included
* [Flight PHP](http://flightphp.com/)
* [Medoo Database Framework](https://medoo.in/)
* [Rakit/Validation](https://github.com/rakit/validation)
* [PHP Mailer](https://github.com/PHPMailer/PHPMailer)

## Routing
We used Flight PHP in this framework. So you can use Flight components in this framework. For routing we just used Flight router. You can define routes in index.php.

```php
Flight::route('GET /ROUTE_URL', function() {
    // Write your code here...
});
```

By default Flight doesn't comes with MVC structure. But in this framework we managed to create MVC like structure to manage routes.

```php
Flight::route('GET /ROUTE_URL', 'Controllers\\ControllerName::function');
```

By default we defined flight engine. So you can add route like

```php
$app->route('GET /', 'Controllers\\ControllerName::function);
```

## Controllers

A simple example of the controller given below.

```php
<?php

namespace Controllers;

class IndexController extends Controller
{
	public function index()
	{
		echo "Welcome To Locus";
	}
}
```

By default flight provides us render function to load the view files. All the view files stored inside **views** folder. We can use the flight render inside controller. To use filght components in controller, we must use the Flight in our controller as follows.

```php
<?php

namespace Controllers;

use Flight;

class IndexController extends Controller
{
    public function index()
    {
        Flight::render('welcome');
    }
}
```

## Dynamic Routing
By default flight supports dynamic routing. And we implemented the same feature in Locus too. We can define the dynamic routes as follows.

**index.php**
```
$app->route('GET /url/@name/@age', 'Controllers\\IndexController::getvalues);
```

**Controller**
```php
<?php

namespace Controllers;
use Flight;

class IndexController extends Controller
{
    public function getvalues($name, $age)
    {
        echo $name;
        echo "<br>";
        echo $age;
    }
}
```

## Helpers
The main intention of Locus is to merge frone-end preset with core php development. But even then we added some basic helpers to make the work easier.

### Mail Helper
We used **PHP Mailer** to send emails. We can use the Mail helper in our controller as follows.

```php
<?php

namespace Controllers;

use Helpers\Mail;

class IndexController extends Controller
{
    public function sendMail()
    {
        $mail = new Mail();
	    $mail->subject = "Second Test Mail";
		$mail->body = "mail.php";
		$mail->args = array(
            "name" => "Son Krillin San",
            "data" => "Second Test Mail Data"
		);
        $mail->from = array(
            "email" => "SENDER_EMAIL",
            "name" => "SENDER_NAME"
        );

        /* You can add any number of emails you want to send mail */

        $mail->addAddress("RECEIVER1_EMAIL", "RECEIVER1_NAME");
        $mail->addAddress("RECEIVER2_EMAIL", "RECEIVER2_NAME");

        if($mail->send())
        {
            echo "Mail has been sent";
        }
        else {
            echo "Mail not sent";
        }
    }
}
```

You can create email template as new PHP file in **mails** folder inside **views** folder. and you can define that template name as follows.

```php
$mail->body = "mail.php";
```

The above code will load the template from mails folder.

You can use dynamic data in email template as follows.

```php
$mail->args = array(
    "name" => "Son Krillin San",
    "data" => "Second Test Mail Data"
);
```

And you can use the above data in email template as follows.

```php
 echo $args['name'];
 echo $args['data'];
```

### DB Helper

We used **Medoo** database framework for database. We can use that helper as follows.

```php
<?php

namespace Controllers;

use Helpers\DB;

class IndexController extends Controller
{
    $con = DB::connect();
    $con->insert('TABLE NAME', [
        'column1 name' => 'column1 value',
        'column2 name' => "column2 value",
        'column3 name' => "column3 value",
        'column4 name' => 'column4 value'
    ]);

    echo "Database has been added";
}
```

We just assigned database connection to a string and used default [**Medoo**](https://medoo.in/) framework queries. For more details view [Documentation](https://medoo.in/).

### Validation Helper

We used [Rakit/Validation](https://github.com/rakit/validation) in this framework. You can use the Validation helper as follows.

```php
<?php

namespace Controllers;

use Flight;
use Helpers\Validation;

class IndexController extends Controller
{
    public function validate()
    {
        $request = Flight::request();
        $validation = Validation::make($request, [
            'name' => 'required',
            'age' => 'required'
        ]);

        if($validation !== true)
        {
            print_r($validation); // Print validation errors
        }
        else {
            //if validation passed
            
        }
    }
}
```

### File Helper

We added a File helper for file uploads. By defaultly uploaded files will be stored inside **Storage** folder. We can use File helper as follows.

```php
<?php

namecpace Controllers;

use Flight;
use Helpers\File;

class IndexController extends Controller
{
    $request = Flight::request();
    $file = new File($request->files['file_name']);
    $file->path = "uploads"; // file will be stored inside Storage/uploads/
    $file->name = "new_upload1"; //new name for uploaded file
    if($file->upload())
    {
        echo "File has been uploaded";
    }
    else {
        echo "Not uploaded";
    }
}
```

## Config

### Utilities

We can load assets by using asset() function. As follows.

```php
asset('css/style.css');
```
The above code will generate the complete url of style.css. asset() function triggered inside assets folder.

We can generate root url using url() function as follows.

```php
url('login'); // will generate http://root-url/login
url(); // will generate http://root-url
```

We can load files from storage using storage_path() function as follows.

```php

storage_path('uploads/file.jpg'); // will generate http://root-url/Storage/uploads/file.jpg
```

You can create your own functions as well. The **Utilities.php** file is located inside **Config** folder.

### Variables
Here we can define global variables. That variables will be used in any fie using constant() function. You can create variables as follows. **Variables.php** file is located inside **Config** folder.

```php
define("VARIABLE_NAME", "VARIABLE_VALUE");

// This will be retrieved as follows
constant("VARIABLE_NAME");
```

## Frontend Presets

By default **Locus** comes with React preset. But you can configure any preset as you wish. We are working on other presets too. Hope we release more presets very soon.

To use preset follow the commands as follows.

```
npm install /* Installs all the dependencies*/

npm run dev /* Run Webpack and make development build of the project*/

npm run watch /* Keep watching project for every small changes */

npm run prod /* Make development build*/
```