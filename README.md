# Happy Home

1. Drag and drop into XAMPP
2. SQL data domain language in **"happyhome/resources"** Choose either localhost or server
3. Change the following settings below

### SETTINGS ON LOCALHOST
- Database Settings under "happyhome/app/config/config.php"
```sh
  // DB Params
  define("DB_HOST", "[DATABASEHOSTADDRESS");
  define("DB_USER", "[USERNAME]");
  define("DB_PASS", "[PASSWORD]");
  define("DB_NAME", "[DATABASENAME]");

  // App Root
  define('APPROOT', dirname(dirname(__FILE__)));
  // URL Root
  define('URLROOT', 'http://localhost/happyhome');
  // Site Name
  define('SITENAME', 'HappyHome');
```
- .htaccess under public "happyhome/public/.htacess"
```sh
<IfModule mod_rewrite.c>
  Options -Multiviews
  RewriteEngine On
  RewriteBase /happyhome/public
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteRule  ^(.+)$ index.php?url=$1 [QSA,L]
</IfModule>
```



### SETTINGS ON SERVER

- Database Settings under "happyhome/app/config/config.php"
```sh
  <?php
  // DB Params
  // DB Params
  define("DB_HOST", "[DATABASEHOSTADDRESS");
  define("DB_USER", "[USERNAME]");
  define("DB_PASS", "[PASSWORD]");
  define("DB_NAME", "[DATABASENAME]");

  // App Root
  define('APPROOT', dirname(dirname(__FILE__)));
  // URL Root
  define('URLROOT', 'https://[WEBSITE ADDRESS]');
  // Site Name
  define('SITENAME', 'HappyHome');
  
```
-  .htaccess under public "happyhome/public/.htacess"
```sh
<IfModule mod_rewrite.c>
  Options -Multiviews
  RewriteEngine On
  RewriteBase /public
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteRule  ^(.+)$ index.php?url=$1 [QSA,L]
</IfModule>
```

### GLOBAL SETTINGS API KEY
- Google Map Api 

Include  **"happyhome/app/view/house_register.php"**
```sh
<script src="https://maps.googleapis.com/maps/api/js?key=[API KEY]&libraries=places&callback=initAutocomplete" async defer></script>
```

- reCAPTCHA Api

Include **"happyhome/app/view/login.php"** and **happyhome/app/view/register.php"** reCAPTCHA's Site Key
```sh
    <div class="g-recaptcha" data-sitekey="[SITE KEY]"></div>
```
Include **"happyhome/app/controller/Users"** reCAPTCHA Site Key under **"CheckCaptcha Function"**
```sh
$fields = array(
              'secret' => '[SECRETKEY]',
              'response' => $userResponse
          );
```