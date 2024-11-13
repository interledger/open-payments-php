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
    class WalletAddressNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
        {
            return $type === \OpenPayments\OpenApi\Generated\WalletAddressServer\Model\WalletAddress::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === \OpenPayments\OpenApi\Generated\WalletAddressServer\Model\WalletAddress::class;
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \OpenPayments\OpenApi\Generated\WalletAddressServer\Model\WalletAddress();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('id', $data)) {
                $object->setId($data['id']);
                unset($data['id']);
            }
            if (\array_key_exists('publicName', $data)) {
                $object->setPublicName($data['publicName']);
                unset($data['publicName']);
            }
            if (\array_key_exists('assetCode', $data)) {
                $object->setAssetCode($data['assetCode']);
                unset($data['assetCode']);
            }
            if (\array_key_exists('assetScale', $data)) {
                $object->setAssetScale($data['assetScale']);
                unset($data['assetScale']);
            }
            if (\array_key_exists('authServer', $data)) {
                $object->setAuthServer($data['authServer']);
                unset($data['authServer']);
            }
            if (\array_key_exists('resourceServer', $data)) {
                $object->setResourceServer($data['resourceServer']);
                unset($data['resourceServer']);
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
            $data['assetCode'] = $object->getAssetCode();
            $data['assetScale'] = $object->getAssetScale();
            foreach ($object as $key => $value) {
                if (preg_match('/.*/', (string) $key)) {
                    $data[$key] = $value;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\OpenPayments\OpenApi\Generated\WalletAddressServer\Model\WalletAddress::class => false];
        }
    }
} else {
    class WalletAddressNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization($data, $type, string $format = null, array $context = []): bool
        {
            return $type === \OpenPayments\OpenApi\Generated\WalletAddressServer\Model\WalletAddress::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === \OpenPayments\OpenApi\Generated\WalletAddressServer\Model\WalletAddress::class;
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
            $object = new \OpenPayments\OpenApi\Generated\WalletAddressServer\Model\WalletAddress();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('id', $data)) {
                $object->setId($data['id']);
                unset($data['id']);
            }
            if (\array_key_exists('publicName', $data)) {
                $object->setPublicName($data['publicName']);
                unset($data['publicName']);
            }
            if (\array_key_exists('assetCode', $data)) {
                $object->setAssetCode($data['assetCode']);
                unset($data['assetCode']);
            }
            if (\array_key_exists('assetScale', $data)) {
                $object->setAssetScale($data['assetScale']);
                unset($data['assetScale']);
            }
            if (\array_key_exists('authServer', $data)) {
                $object->setAuthServer($data['authServer']);
                unset($data['authServer']);
            }
            if (\array_key_exists('resourceServer', $data)) {
                $object->setResourceServer($data['resourceServer']);
                unset($data['resourceServer']);
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
            $data['assetCode'] = $object->getAssetCode();
            $data['assetScale'] = $object->getAssetScale();
            foreach ($object as $key => $value) {
                if (preg_match('/.*/', (string) $key)) {
                    $data[$key] = $value;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\OpenPayments\OpenApi\Generated\WalletAddressServer\Model\WalletAddress::class => false];
        }
    }
}
