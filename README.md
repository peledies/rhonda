#Help me \Rhonda
Rhonda is a composer installable package that provides solutions to common PHP tasks.

##Install
```shell
  composer require peledies/rhonda:~1
  composer install
```

##Require in your project
Add the folowing to your composer.json file
```php
  "require": {
    "peledies/rhonda": "~1"
  }
```

#Classes and Methods

##\Rhonda\UUID
| Method  | Description |
| ------------- | ------------- |
| create()  | Create a new UUID  |
```php
  \Rhonda\UUID::create();
```
OR
```php
  $uuid = new \Rhonda\UUID();
  $uuid->create();
```


##\Rhonda\RequestBody
| Method  | Description |
| ------------- | ------------- |
| get()  | Get the provided request body  |
```php
  \Rhonda\RequestBody::get();
```
OR
```php
  $request_body = new \Rhonda\RequestBody();
  $request_body->get();
```


##\Rhonda\Success
| Method  | Description |
| ------------- | ------------- |
| create()  | create a uniform success message   |
```php
  echo \Rhonda\Success:: create();
```
OR
```php
  $msg = new \Rhonda\Success();
  echo $msg->create();
```


##\Rhonda\Error
| Method  | Description |
| ------------- | ------------- |
| handle()  | Fromat an exception for return. Also writes a pretty stack trace to the error log   |
| deprecation_warning(**message, alternate route**) | Adds a `Warning` header and changes the status code to `299` |
```php
  try{
    throw new Exception("Demo Error Exception");
  }catch(\Exception $e){
    echo \Rhonda\Error::handle($e);
  }
```
OR
```php
  try{
    throw new Exception("Demo Error Exception");
  }catch(\Exception $e){
    $error = new \Rhonda\Error();
    echo $error->handle($e);
  }
```


##\Rhonda\Config
| Method  | Description |
| ------------- | ------------- |
| load_file()  | Load a JSON file into memory as an object for later retrieval  |
| load_object()  | Load an object into memory for later retrieval  |
| get()  | Retrieve a configuration object from memory  |
Load Object to memory
```php
  $object = new stdClass();
  $object->thing_1 = 'something one';
  $object->thing_2 = 'something two';
  \Rhonda\Config::load_object('test_one', $object);
```
Load JSON file to memory
```php
  // File path is relative to your project root
  $config->load_file('test_two', 'path/to/file.json');
```
Retrieve a configuration object from memory
```php
\Rhonda\Config::get('test_one');
```


##\Rhonda\APIGateway
| Method  | Description |
| ------------- | ------------- |
| run()  | Run a request to an external URL  |


Make a request to an external address with custom headers and a request body
```php
try{
  $headers = array("Domain"=>"domain_1", "Authorization"=>"sometoken");
  $data = (object) array("handle"=>"demo_1", "password"=>"asdf");
  $api = new \Rhonda\APIGateway('POST','http://elguapo.eventlink.local/authenticateasdf/',$data, $headers);
  $data = $api->run();
}catch(\Exception $e){
  $error = new \Rhonda\Error();
  echo $error->handle($e);
}
```

##\Rhonda\Strings
| Method  | Description |
| ------------- | ------------- |
| **verify(** *type_string, test_string* **)**  | Return True/False  |
| **verify_or_error(** *type_string, test_string* **)** | Return True/False or throws exception |
| **normalize(** *string* **)** | Returns normalized string |

#### String Normalization
 * Removes non word characters
 * Converts the string to lowercse
 * Converts spaces and dashes to underscores
 * Trims trailing invalid characters

#### Verification Types

| Type  | Description |
| ------------- | ------------- |
| 'email'  | Verifies proper email structure  |
| 'username' | Tests that string only includes a-z 0-9 . - or _ |


**Test that a string is a valid email (without exception)**
```php
try{
  // PASS
  $string = 'test@test.com';
  \Rhonda\Strings:: validate('email',$string);

  // FAIL
  $string = 'test@test';
  \Rhonda\Strings:: validate('email',$string);

  // Catch will not be invoked
}catch(\Exception $e){
  echo \Rhonda\Error:: handle($e);
}
```

**Test that a string is a valid email (with exception)**
```php
try{
  // PASS
  $string = 'test@test.com';
  \Rhonda\Strings:: validate_or_error('email',$string);

  // FAIL
  $string = 'test@test';
  \Rhonda\Strings:: validate_or_error('email',$string);

  // Catch will be invoked
}catch(\Exception $e){
  echo \Rhonda\Error:: handle($e);
}
```

**Normalize a string**
```php
  $input = 'Some TEST-@#string-#$-!@';
  \Rhonda\Strings:: normalize($input);

  // Returns
  some_test_string
```

##\Rhonda\Headers
| Method  | Description |
| ------------- | ------------- |
| getallheaders()  | Return an Array of all request headers, works for Apache, PHP, and Nginx servers  |


Retrieve All request headers as an Array
```php
  $headers = \Rhonda\Headers:: getallheaders();
```
OR
```php
  $headers = new \Rhonda\Headers();
  $headers->getallheaders();
```

##\Rhonda\Mysql


| Method  | Description |
| ------------- | ------------- |
| real_escape(**String, Array, Object**)  | Escape the thing being passed in by utilizing mysqli and real_escape_string. These methods require a mysql connection so you will need to load a config file into the variable **DB**. real_escape uses **utf-8** as the charset.  When escaping an Array or Object, recursion is used and it will drill through the object/array and escape everything.  |

**Escape a String**
```php
$string = "that's all folks";
$string = \Rhonda\Mysql::real_escape($string);
```

**Escape an Object**
```php
$object = new \stdClass();
$object->thing = "it's for real";
$object = \Rhonda\Mysql::real_escape($object);
```

**Escape an Array**
```php
$array = array(
   "ray"=>"it's escaping arrays"
 , "ray2"=>"escape's this one too"
);
$array = \Rhonda\Mysql::real_escape($ray);
```

##\Rhonda\ServiceChain
| Method  | Description |
| ------------- | ------------- |
| register(`optional`)  | Register this application or micro service to the service chain.  |
| report(`Boolean`)  | Return a string (default) or an Array of the service chain if parameter is set to TRUE  |


If you are using ServiceChain, `register()` should be one of the first things you do in your application,
preferably immediately after the composer autoload.

The default behavior of register is to use your config object named `system` for a property named `host`.
`\Rhonda\ServiceChain:: register()` will automatically use that value for the service name.

(Prefered) Register this micro service to the service chain using a config file
```php
  require_once __DIR__ . '/../vendor/autoload.php';
  
  // Load your configuration file to memory
  \Rhonda\Config:: load_file('system', 'path/to/file.json');
  
  // Register your service name
  \Rhonda\ServiceChain:: register();
```

Register this micro service to the service chain using a parameter
```php
  require_once __DIR__ . '/../vendor/autoload.php';
  
  // Register your service name
  \Rhonda\ServiceChain:: register('Service-Name');
```

Get the current service chain state
```php  
  // "Returns: service1 => service2 => etc"
  \Rhonda\ServiceChain:: report();

  // "Returns: array("service1", "service2", "etc")
  \Rhonda\ServiceChain:: report(TRUE);
```