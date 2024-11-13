<?php

namespace OpenPayments\OpenApi\Generated\ResourceServer\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use OpenPayments\OpenApi\Generated\ResourceServer\Runtime\Normalizer\CheckArray;
use OpenPayments\OpenApi\Generated\ResourceServer\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\HttpKernel\Kernel;
if (!class_exists(Kernel::class) or (Kernel::MAJOR_VERSION >= 7 or Kernel::MAJOR_VERSION === 6 and Kernel::MINOR_VERSION === 4)) {
    class IlpPaymentMethodNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
        {
            return $type === \OpenPayments\OpenApi\Generated\ResourceServer\Model\IlpPaymentMethod::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === \OpenPayments\OpenApi\Generated\ResourceServer\Model\IlpPaymentMethod::class;
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \OpenPayments\OpenApi\Generated\ResourceServer\Model\IlpPaymentMethod();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('type', $data)) {
                $object->setType($data['type']);
            }
            if (\array_key_exists('ilpAddress', $data)) {
                $object->setIlpAddress($data['ilpAddress']);
            }
            if (\array_key_exists('sharedSecret', $data)) {
                $object->setSharedSecret($data['sharedSecret']);
            }
            return $object;
        }
        public function normalize(mixed $object, string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            $data['type'] = $object->getType();
            $data['ilpAddress'] = $object->getIlpAddress();
            $data['sharedSecret'] = $object->getSharedSecret();
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\OpenPayments\OpenApi\Generated\ResourceServer\Model\IlpPaymentMethod::class => false];
        }
    }
} else {
    class IlpPaymentMethodNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization($data, $type, string $format = null, array $context = []): bool
        {
            return $type === \OpenPayments\OpenApi\Generated\ResourceServer\Model\IlpPaymentMethod::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === \OpenPayments\OpenApi\Generated\ResourceServer\Model\IlpPaymentMethod::class;
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
            $object = new \OpenPayments\OpenApi\Generated\ResourceServer\Model\IlpPaymentMethod();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('type', $data)) {
                $object->setType($data['type']);
            }
            if (\array_key_exists('ilpAddress', $data)) {
                $object->setIlpAddress($data['ilpAddress']);
            }
            if (\array_key_exists('sharedSecret', $data)) {
                $object->setSharedSecret($data['sharedSecret']);
            }
            return $object;
        }
        /**
         * @return array|string|int|float|bool|\ArrayObject|null
         */
        public function normalize($object, $format = null, array $context = [])
        {
            $data = [];
            $data['type'] = $object->getType();
            $data['ilpAddress'] = $object->getIlpAddress();
            $data['sharedSecret'] = $object->getSharedSecret();
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\OpenPayments\OpenApi\Generated\ResourceServer\Model\IlpPaymentMethod::class => false];
        }
    }
}