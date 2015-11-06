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

