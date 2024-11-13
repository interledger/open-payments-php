<?php

namespace OpenPayments\OpenApi\Generated\WalletAddressServer\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use OpenPayments\OpenApi\Generated\WalletAddressServer\Runtime\Normalizer\CheckArray;
use OpenPayments\OpenApi\Generated\WalletAddressServer\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\HttpKernel\Kernel;

if (!class_exists(Kernel::class) or (Kernel::MAJOR_VERSION >= 7 or Kernel::MAJOR_VERSION === 6 and Kernel::MINOR_VERSION === 4)) {
    class JsonWebKeyNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
        {
            return $type === \OpenPayments\OpenApi\Generated\WalletAddressServer\Model\JsonWebKey::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === \OpenPayments\OpenApi\Generated\WalletAddressServer\Model\JsonWebKey::class;
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \OpenPayments\OpenApi\Generated\WalletAddressServer\Model\JsonWebKey();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('kid', $data)) {
                $object->setKid($data['kid']);
                unset($data['kid']);
            }
            if (\array_key_exists('alg', $data)) {
                $object->setAlg($data['alg']);
                unset($data['alg']);
            }
            if (\array_key_exists('use', $data)) {
                $object->setUse($data['use']);
                unset($data['use']);
            }
            if (\array_key_exists('kty', $data)) {
                $object->setKty($data['kty']);
                unset($data['kty']);
            }
            if (\array_key_exists('crv', $data)) {
                $object->setCrv($data['crv']);
                unset($data['crv']);
            }
            if (\array_key_exists('x', $data)) {
                $object->setX($data['x']);
                unset($data['x']);
            }
            foreach ($data as $key => $value) {
                if (preg_match('/.*/', (string) $key)) {
                    $object[$key] = $value;
                }
            }
            return $object;
        }
        public function normalize(mixed $object, string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            $data['kid'] = $object->getKid();
            $data['alg'] = $object->getAlg();
            if ($object->isInitialized('use') && null !== $object->getUse()) {
                $data['use'] = $object->getUse();
            }
            $data['kty'] = $object->getKty();
            $data['crv'] = $object->getCrv();
            $data['x'] = $object->getX();
            foreach ($object as $key => $value) {
                if (preg_match('/.*/', (string) $key)) {
                    $data[$key] = $value;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\OpenPayments\OpenApi\Generated\WalletAddressServer\Model\JsonWebKey::class => false];
        }
    }
} else {
    class JsonWebKeyNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization($data, $type, string $format = null, array $context = []): bool
        {
            return $type === \OpenPayments\OpenApi\Generated\WalletAddressServer\Model\JsonWebKey::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === \OpenPayments\OpenApi\Generated\WalletAddressServer\Model\JsonWebKey::class;
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
            $object = new \OpenPayments\OpenApi\Generated\WalletAddressServer\Model\JsonWebKey();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('kid', $data)) {
                $object->setKid($data['kid']);
                unset($data['kid']);
            }
            if (\array_key_exists('alg', $data)) {
                $object->setAlg($data['alg']);
                unset($data['alg']);
            }
            if (\array_key_exists('use', $data)) {
                $object->setUse($data['use']);
                unset($data['use']);
            }
            if (\array_key_exists('kty', $data)) {
                $object->setKty($data['kty']);
                unset($data['kty']);
            }
            if (\array_key_exists('crv', $data)) {
                $object->setCrv($data['crv']);
                unset($data['crv']);
            }
            if (\array_key_exists('x', $data)) {
                $object->setX($data['x']);
                unset($data['x']);
            }
            foreach ($data as $key => $value) {
                if (preg_match('/.*/', (string) $key)) {
                    $object[$key] = $value;
                }
            }
            return $object;
        }
        /**
         * @return array|string|int|float|bool|\ArrayObject|null
         */
        public function normalize($object, $format = null, array $context = [])
        {
            $data = [];
            $data['kid'] = $object->getKid();
            $data['alg'] = $object->getAlg();
            if ($object->isInitialized('use') && null !== $object->getUse()) {
                $data['use'] = $object->getUse();
            }
            $data['kty'] = $object->getKty();
            $data['crv'] = $object->getCrv();
            $data['x'] = $object->getX();
            foreach ($object as $key => $value) {
                if (preg_match('/.*/', (string) $key)) {
                    $data[$key] = $value;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\OpenPayments\OpenApi\Generated\WalletAddressServer\Model\JsonWebKey::class => false];
        }
    }
}
