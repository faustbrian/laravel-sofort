<?php

/*
 * This file is part of Laravel Sofort.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace BrianFaust\Sofort;

use InvalidArgumentException;
use Sofort\SofortLib\Sofortueberweisung;

class SofortFactory
{
    /**
     * Make a new Sofort client.
     *
     * @param array $config
     *
     * @return \Sofort\SofortLib\Sofortueberweisung
     */
    public function make(array $config): Sofortueberweisung
    {
        $config = $this->getConfig($config);

        return $this->getClient($config);
    }

    /**
     * Get the configuration data.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return array
     */
    protected function getConfig(array $config): array
    {
        $keys = ['key'];

        foreach ($keys as $key) {
            if (!array_key_exists($key, $config)) {
                throw new InvalidArgumentException("Missing configuration key [$key].");
            }
        }

        return array_only($config, ['key']);
    }

    /**
     * Get the Sofort client.
     *
     * @param array $auth
     *
     * @return \Sofort\SofortLib\Sofortueberweisung
     */
    protected function getClient(array $auth): Sofortueberweisung
    {
        return new Sofortueberweisung($auth['key']);
    }
}
