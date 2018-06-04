<?php

declare(strict_types=1);

$replicas = $argv[1];
if ($replicas < 1) {
    $replicas = 1;
}

$dockerService = $argv[2];
$dockerServiceBasePort = $argv[3];

shell_exec("docker-compose scale {$dockerService}={$replicas}");
$portsRaw = explode(PHP_EOL, trim(shell_exec('docker inspect --format="{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}" $(docker ps -a --filter="name=' . $dockerService . '" -q)'), PHP_EOL));

$content = implode(PHP_EOL, array_map(function($address) use ($dockerServiceBasePort) { return "{$address} {$dockerServiceBasePort}"; }, $portsRaw));

$dtabs = [
    'web_asset' => 'assets',
    'web_metadata' => 'metadatas',
    'web_upload' => 'uploads',
];

define('DS', DIRECTORY_SEPARATOR);

$dtab = realpath(__DIR__) . DS . 'docker' . DS . 'linkerd-namerd' . DS . 'disco' . DS . 'apis' . DS . $dtabs[$dockerService];

if ($replicas === 1 || empty($content)) {
    $content = trim("{$dockerService} {$dockerServiceBasePort}" . PHP_EOL . $content, PHP_EOL);
}

file_put_contents($dtab, $content);