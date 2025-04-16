<?php

namespace OpenPayments\Traits;

trait ArraySerializableTrait
{
    /**
     * Convert the current object to an array.
     */
    public function toArray(): array
    {
        $array = [];
        foreach (get_object_vars($this) as $property => $value) {
            if (is_object($value) && method_exists($value, 'toArray')) {
                $array[$property] = $value->toArray(); // Recursively call toArray on nested DTOs
            } elseif (is_array($value)) {
                $array[$property] = array_map(function ($item) {
                    return is_object($item) && method_exists($item, 'toArray')
                        ? $item->toArray()
                        : $item;
                }, $value);
            } else {
                $array[$property] = $value;
            }
        }

        return $array;
    }
}
