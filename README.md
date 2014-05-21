# laravel-couchdb

CouchDB database driver for Laravel 4

## Dependencies

*laravel-couchdb* uses [doctrine/couchdb-client](https://github.com/doctrine/couchdb-client).
This package will be automatically downloaded for you via composer.

## Installation

Add the package to your `composer.json` and run `composer update`.

```json
{
    "require": {
        "rbewley4/laravel-couchdb": "dev-master"
    }
}
```

Add the service provider in `app/config/app.php`:

```php
'Rbewley4\Laravel\Couchdb\CouchdbServiceProvider',
```

The service provider will register a couchdb database extension with the original database manager.
There is no need to register additional facades or objects. When using couchdb connections, Laravel
will automatically provide you with the corresponding couchdb objects.

## Configuration

Change your default database connection name in `app/config/database.php`:

```php
'default' => 'couchdb',
```

And add a new couchdb connection:

```php
'couchdb' => array(
    'driver'   => 'couchdb',
    'type'     => 'socket',
    'host'     => 'localhost',
    'ip'       => null,
    'port'     => 5984,
    'dbname'   => 'database',
    'user'     => 'username',
    'password' => 'password',
    'logging'  => false,
),
```


## Eloquent, Query Builder, Schema Builder

Sorry, we do not support these components at this time.

## Examples

*laravel-couchdb* provides you with direct access to a CouchDBClient object,
and expects you to use it for all CouchDB interaction.

For more information on CouchDBClient, see [doctrine/couchdb-client](https://github.com/doctrine/couchdb-client).

**Get handle to CouchDBClient**

```php
/**
 * @var \Rbewley4\Laravel\Couchdb\CouchdbConnection
 */
$connection = DB::connection('couchdb');

/**
 * @var \Doctrine\CouchDB\CouchDBClient
 */
$couchdb = $connection->getCouchDB();
```
> **Note**:
> you can invoke methods on CouchDBClient by invoking them on CouchdbConnection. This is accomplished
> via the use of magic methods.

**Create/Update/Find Document**

Here we demonstrate three different operations that you can perform on CouchDB, and we show three different
ways that you can invoke these methods:

```php
$connection = DB::connection('couchdb');
$couchdb = $connection->getCouchDB();

list($id, $rev) = $connection->postDocument(array('foo' => 'bar'));
$couchdb->putDocument(array('foo' => 'baz'), $id, $rev);
$doc = DB::connection('couchdb')->findDocument($id);
```

Note that all three methods can be called on $connection or $couchdb.