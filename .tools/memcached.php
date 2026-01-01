<?php

$memcached = new Memcached();
$memcached->addServer('127.0.0.1', 11211);

$name = 'testkey';
$ttl = 10;
$data = sha1(time());

$memcached->set($name, $data, $ttl);
echo date('His') . ': key "' . $name . '" set to "' . $data . '" with ttl ' . $ttl . PHP_EOL;

for ($i = 0; $i < ($ttl + 5); $i ++) {
  $res = $memcached->get($name);
  echo date('His') . ': key "' . $name . '" data is "' . $res . '" and that is ' . ($res == $data ? 'a match' : 'not a match') . PHP_EOL;
  sleep(1);
}

echo '<hr>';

/* OO API */
$memcache = new Memcache;
$memcache->addServer('127.0.0.1', 11211);
echo $memcache->getServerStatus('127.0.0.1', 11211);

echo '<hr>';

/* procedural API */
$memcache = memcache_connect('127.0.0.1', 11211);
echo memcache_get_server_status($memcache, '127.0.0.1', 11211);
