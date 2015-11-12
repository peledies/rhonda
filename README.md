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