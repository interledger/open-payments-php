<?php

namespace OpenPayments\OpenApi\Generated\AuthServer\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use OpenPayments\OpenApi\Generated\AuthServer\Runtime\Normalizer\CheckArray;
use OpenPayments\OpenApi\Generated\AuthServer\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\HttpKernel\Kernel;
if (!class_exists(Kernel::class) or (Kernel::MAJOR_VERSION >= 7 or Kernel::MAJOR_VERSION === 6 and Kernel::MINOR_VERSION === 4)) {
    class AccessTokenNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
        {
            return $type === \OpenPayments\OpenApi\Generated\AuthServer\Model\AccessToken::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === \OpenPayments\OpenApi\Generated\AuthServer\Model\AccessToken::class;
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \OpenPayments\OpenApi\Generated\AuthServer\Model\AccessToken();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('value', $data)) {
                $object->setValue($data['value']);
            }
            if (\array_key_exists('manage', $data)) {
                $object->setManage($data['manage']);
            }
            if (\array_key_exists('expires_in', $data)) {
                $object->setExpiresIn($data['expires_in']);
            }
            if (\array_key_exists('access', $data)) {
                $values = [];
                foreach ($data['access'] as $value) {
                    $values[] = $value;
                }
                $object->setAccess($values);
            }
            return $object;
        }
        public function normalize(mixed $object, string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            $data['value'] = $object->getValue();
            $data['manage'] = $object->getManage();
            if ($object->isInitialized('expiresIn') && null !== $object->getExpiresIn()) {
                $data['expires_in'] = $object->getExpiresIn();
            }
            $values = [];
            foreach ($object->getAccess() as $value) {
                $values[] = $value;
            }
            $data['access'] = $values;
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\OpenPayments\OpenApi\Generated\AuthServer\Model\AccessToken::class => false];
        }
    }
} else {
    class AccessTokenNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization($data, $type, string $format = null, array $context = []): bool
        {
            return $type === \OpenPayments\OpenApi\Generated\AuthServer\Model\AccessToken::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === \OpenPayments\OpenApi\Generated\AuthServer\Model\AccessToken::class;
        }
        /**
         * @return mixed
         */
        public function denormalize($data, $type, $format = null, array $context = [])
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \OpenPayments\OpenApi\Generated\AuthServer\Model\AccessToken();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('value', $data)) {
                $object->setValue($data['value']);
            }
            if (\array_key_exists('manage', $data)) {
                $object->setManage($data['manage']);
            }
            if (\array_key_exists('expires_in', $data)) {
                $object->setExpiresIn($data['expires_in']);
            }
            if (\array_key_exists('access', $data)) {
                $values = [];
                foreach ($data['access'] as $value) {
                    $values[] = $value;
                }
                $object->setAccess($values);
            }
            return $object;
        }
        /**
         * @return array|string|int|float|bool|\ArrayObject|null
         */
        public function normalize($object, $format = null, array $context = [])
        {
            $data = [];
            $data['value'] = $object->getValue();
            $data['manage'] = $object->getManage();
            if ($object->isInitialized('expiresIn') && null !== $object->getExpiresIn()) {
                $data['expires_in'] = $object->getExpiresIn();
            }
            $values = [];
            foreach ($object->getAccess() as $value) {
                $values[] = $value;
            }
            $data['access'] = $values;
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\OpenPayments\OpenApi\Generated\AuthServer\Model\AccessToken::class => false];
        }
    }
}