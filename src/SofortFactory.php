<?php

/*
 * This file is part of Laravel Sofort.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
     * @return \Sofort\Sofort
     */
    public function make(array $config)
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
    protected function getConfig(array $config)
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
     * @return \Sofort\Sofort
     */
    protected function getClient(array $auth)
    {
        return new Sofortueberweisung($auth['key']);
    }
}
