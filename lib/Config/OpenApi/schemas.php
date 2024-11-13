<?php

return [
    'openapi-file' => dirname(dirname(__DIR__)) .'/OpenApi/Specs/schemas.yaml',
    'namespace' => 'OpenPayments\\OpenApi\\Generated\\Schemas',
    'directory' => dirname(dirname(__DIR__)) . '/OpenApi/Generated/Schemas',
    'date-format' => \DateTime::RFC3339,
];