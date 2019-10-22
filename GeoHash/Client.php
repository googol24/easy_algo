<?php

// 自动加载
spl_autoload_register(function ($class) {
    if (is_file($class . '.php')) {
        require_once __DIR__ . '/' . "$class.php";
    }
});

// GeoHash算法调用对象
$geoService = new GeoHash();

$latitude  = 39.133462;
$longitude = 117.315575;


$geoHash = $geoService->encode($latitude, $longitude);

echo "坐标点（北纬{$latitude}°，东经{$longitude}°）的geo hash值为：" . $geoHash . PHP_EOL;

$hash = 'wwgqts48gn0c';
$coordinate = $geoService->decode($hash);
echo "hash值'{$hash}'对应的坐标点为：（北纬{$coordinate['latitude']}°，东经{$coordinate['longitude']}°）" . PHP_EOL;