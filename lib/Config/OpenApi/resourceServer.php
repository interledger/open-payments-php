<?php

return [
    'openapi-file' => dirname(dirname(__DIR__)) .'/OpenApi/Specs/resource-server.yaml',
    'namespace' => 'OpenPayments\\OpenApi\\Generated\\ResourceServer',
    'directory' => dirname(dirname(__DIR__)) . '/OpenApi/Generated/ResourceServer',
    'date-format' => \DateTime::RFC3339,
];