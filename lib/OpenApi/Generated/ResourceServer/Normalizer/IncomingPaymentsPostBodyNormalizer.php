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
    class IncomingPaymentsPostBodyNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
        {
            return $type === \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentsPostBody::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentsPostBody::class;
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentsPostBody();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('walletAddress', $data)) {
                $object->setWalletAddress($data['walletAddress']);
            }
            if (\array_key_exists('incomingAmount', $data)) {
                $object->setIncomingAmount($this->denormalizer->denormalize($data['incomingAmount'], \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentIncomingAmount::class, 'json', $context));
            }
            if (\array_key_exists('expiresAt', $data)) {
                $object->setExpiresAt(\DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['expiresAt']));
            }
            if (\array_key_exists('metadata', $data)) {
                $values = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
                foreach ($data['metadata'] as $key => $value) {
                    $values[$key] = $value;
                }
                $object->setMetadata($values);
            }
            return $object;
        }
        public function normalize(mixed $object, string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            $data['walletAddress'] = $object->getWalletAddress();
            if ($object->isInitialized('incomingAmount') && null !== $object->getIncomingAmount()) {
                $data['incomingAmount'] = $this->normalizer->normalize($object->getIncomingAmount(), 'json', $context);
            }
            if ($object->isInitialized('expiresAt') && null !== $object->getExpiresAt()) {
                $data['expiresAt'] = $object->getExpiresAt()?->format('Y-m-d\TH:i:sP');
            }
            if ($object->isInitialized('metadata') && null !== $object->getMetadata()) {
                $values = [];
                foreach ($object->getMetadata() as $key => $value) {
                    $values[$key] = $value;
                }
                $data['metadata'] = $values;
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentsPostBody::class => false];
        }
    }
} else {
    class IncomingPaymentsPostBodyNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization($data, $type, string $format = null, array $context = []): bool
        {
            return $type === \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentsPostBody::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentsPostBody::class;
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
            $object = new \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentsPostBody();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('walletAddress', $data)) {
                $object->setWalletAddress($data['walletAddress']);
            }
            if (\array_key_exists('incomingAmount', $data)) {
                $object->setIncomingAmount($this->denormalizer->denormalize($data['incomingAmount'], \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentIncomingAmount::class, 'json', $context));
            }
            if (\array_key_exists('expiresAt', $data)) {
                $object->setExpiresAt(\DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['expiresAt']));
            }
            if (\array_key_exists('metadata', $data)) {
                $values = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
                foreach ($data['metadata'] as $key => $value) {
                    $values[$key] = $value;
                }
                $object->setMetadata($values);
            }
            return $object;
        }
        /**
         * @return array|string|int|float|bool|\ArrayObject|null
         */
        public function normalize($object, $format = null, array $context = [])
        {
            $data = [];
            $data['walletAddress'] = $object->getWalletAddress();
            if ($object->isInitialized('incomingAmount') && null !== $object->getIncomingAmount()) {
                $data['incomingAmount'] = $this->normalizer->normalize($object->getIncomingAmount(), 'json', $context);
            }
            if ($object->isInitialized('expiresAt') && null !== $object->getExpiresAt()) {
                $data['expiresAt'] = $object->getExpiresAt()?->format('Y-m-d\TH:i:sP');
            }
            if ($object->isInitialized('metadata') && null !== $object->getMetadata()) {
                $values = [];
                foreach ($object->getMetadata() as $key => $value) {
                    $values[$key] = $value;
                }
                $data['metadata'] = $values;
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentsPostBody::class => false];
        }
    }
}