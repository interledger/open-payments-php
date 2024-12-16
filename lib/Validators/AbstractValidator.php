<?php

namespace OpenPayments\Validators;

use JsonSchema\Validator;
use JsonSchema\Constraints\Constraint;
use RuntimeException;

abstract class AbstractValidator
{
    protected Validator $validator;

    public function __construct()
    {
        $this->validator = new Validator();
    }

    protected function loadSchema(string $schemaPath): object
    {
        $path = __DIR__ . "/$schemaPath";

        if (!file_exists($path)) {
            throw new RuntimeException("Schema file not found: $schemaPath");
        }

        $schemaJson = file_get_contents($path);
        return json_decode($schemaJson);
    }

    protected function validate(array $data, object $schema): void
    {
        //$data = json_encode($data, JSON_UNESCAPED_SLASHES);
        $data = json_decode(json_encode($data, JSON_UNESCAPED_SLASHES));
        $this->validator->validate($data, $schema, Constraint::CHECK_MODE_APPLY_DEFAULTS);

        if (!$this->validator->isValid()) {
          //echo "<pre>validate ->errors: ".print_r($this->validator->getErrors(), true)."</pre>";//die;
            $errors = array_map(fn ($error) => "{$error['property']}: {$error['message']}", $this->validator->getErrors());
            throw new RuntimeException('JSON validation failed: ' . implode(', ', $errors));
        }
    }
}
