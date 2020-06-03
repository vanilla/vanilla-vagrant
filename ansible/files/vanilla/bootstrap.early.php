<?php

/** @var Gdn_Configuration $bte_config */
$bte_config = $dic->get(Gdn_Configuration::class);
$bte_config->saveToConfig('Cache.Enabled', false); # Toggle this to true/false to enable/disable caching.
$bte_config->saveToConfig('Cache.Method', 'memcached');
$bte_config->saveToConfig('Cache.Memcached.Store', ['localhost:11211']);

if ($bte_config->get('Cache.Enabled', false)) {
    if (class_exists('Memcached')) {
        $bte_config->saveToConfig('Cache.Memcached.Option.'.Memcached::OPT_COMPRESSION, true, false);
        $bte_config->saveToConfig('Cache.Memcached.Option.'.Memcached::OPT_DISTRIBUTION, Memcached::DISTRIBUTION_CONSISTENT, false);
        $bte_config->saveToConfig('Cache.Memcached.Option.'.Memcached::OPT_LIBKETAMA_COMPATIBLE, true, false);
        $bte_config->saveToConfig('Cache.Memcached.Option.'.Memcached::OPT_NO_BLOCK, true, false);
        $bte_config->saveToConfig('Cache.Memcached.Option.'.Memcached::OPT_TCP_NODELAY, true, false);
        $bte_config->saveToConfig('Cache.Memcached.Option.'.Memcached::OPT_CONNECT_TIMEOUT, 1000, false);
        $bte_config->saveToConfig('Cache.Memcached.Option.'.Memcached::OPT_SERVER_FAILURE_LIMIT, 2, false);
    } else {
        die('PHP is missing the Memcached extension.');
    }
}
