<?php

declare(strict_types=1);

$informations = [
    'id' => uniqid('', true),
    'name' => 'upload_' . uniqid('', true)
];

echo json_encode($informations);