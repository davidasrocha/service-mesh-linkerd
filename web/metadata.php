<?php

declare(strict_types=1);

$informations = [
    'id' => uniqid('', true),
    'name' => 'metadata_' . uniqid('', true)
];

echo json_encode($informations);