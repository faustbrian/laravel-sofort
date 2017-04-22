<?php



declare(strict_types=1);

namespace BrianFaust\Sofort\Facades;

use Illuminate\Support\Facades\Facade;

class Sofort extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'sofort';
    }
}
