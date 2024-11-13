<?php

return [
    'openapi-file' => dirname(dirname(__DIR__)) .'/OpenApi/Specs/auth-server.yaml',
    'namespace' => 'OpenPayments\\OpenApi\\Generated\\AuthServer',
    'directory' => dirname(dirname(__DIR__)) . '/OpenApi/Generated/AuthServer',
    'date-format' => \DateTime::RFC3339,
];