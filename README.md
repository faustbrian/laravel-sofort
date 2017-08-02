# Laravel Sofort

> A [Sofort](https://sofort.com) bridge for Laravel.

## Installation

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```bash
$ composer require faustbrian/laravel-sofort
```

## Configuration

Laravel Sofort requires connection configuration. To get started, you'll need to publish all vendor assets:

```bash
$ php artisan vendor:publish --provider="BrianFaust\Sofort\SofortServiceProvider"
```

This will create a `config/sofort.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

#### Default Connection Name

This option `default` is where you may specify which of the connections below you wish to use as your default connection for all work. Of course, you may use many connections at once using the manager class. The default value for this setting is `main`.

#### Sofort Connections

This option `connections` is where each of the connections are setup for your application. Example configuration has been included, but you may add as many connections as you would like.

## Usage

#### SofortManager

This is the class of most interest. It is bound to the ioc container as `sofort` and can be accessed using the `Facades\Sofort` facade. This class implements the ManagerInterface by extending AbstractManager. The interface and abstract class are both part of [Graham Campbell's](https://github.com/GrahamCampbell) [Laravel Manager](https://github.com/GrahamCampbell/Laravel-Manager) package, so you may want to go and checkout the docs for how to use the manager class over at that repository. Note that the connection class returned will always be an instance of `Sofort\Sofort`.

#### Facades\Sofort

This facade will dynamically pass static method calls to the `sofort` object in the ioc container which by default is the `SofortManager` class.

#### SofortServiceProvider

This class contains no public methods of interest. This class should be added to the providers array in `config/app.php`. This class will setup ioc bindings.

### Examples

Here you can see an example of just how simple this package is to use. Out of the box, the default adapter is `main`. After you enter your authentication details in the config file, it will just work:

```php
// You can alias this in config/app.php.
use BrianFaust\Sofort\Facades\Sofort;

Sofort::setAmount(10.21);
// We're done here - how easy was that, it just works!
```

The Sofort manager will behave like it is a `Sofort\Sofort`. If you want to call specific connections, you can do that with the connection method:

```php
use BrianFaust\Sofort\Facades\Sofort;

// Writing this…
Sofort::connection('main')->setAmount(10.21);

// …is identical to writing this
Sofort::setAmount(10.21);

// and is also identical to writing this.
Sofort::connection()->setAmount(10.21);

// This is because the main connection is configured to be the default.
Sofort::getDefaultConnection(); // This will return main.

// We can change the default connection.
Sofort::setDefaultConnection('alternative'); // The default is now alternative.
```

If you prefer to use dependency injection over facades like me, then you can inject the manager:

```php
use BrianFaust\Sofort\SofortManager;

class Foo
{
    protected $sofort;

    public function __construct(SofortManager $sofort)
    {
        $this->sofort = $sofort;
    }

    public function bar()
    {
        $this->sofort->setAmount(10.21);
    }
}

App::make('Foo')->bar();
```

## Documentation

There are other classes in this package that are not documented here. This is because the package is a Laravel wrapper of [the official Sofort package](https://github.com/sofort/sofortlib-php).

## Testing

``` bash
$ phpunit
```

## Security

If you discover a security vulnerability within this package, please send an e-mail to Brian Faust at hello@brianfaust.me. All security vulnerabilities will be promptly addressed.

## Credits

- [Brian Faust](https://github.com/faustbrian)
- [All Contributors](../../contributors)

## License

[MIT](LICENSE) © [Brian Faust](https://brianfaust.me)
