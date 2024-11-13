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
    class IncomingPaymentWithMethodsNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
        {
            return $type === \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentWithMethods::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentWithMethods::class;
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentWithMethods();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('id', $data)) {
                $object->setId($data['id']);
                unset($data['id']);
            }
            if (\array_key_exists('walletAddress', $data)) {
                $object->setWalletAddress($data['walletAddress']);
                unset($data['walletAddress']);
            }
            if (\array_key_exists('completed', $data)) {
                $object->setCompleted($data['completed']);
                unset($data['completed']);
            }
            if (\array_key_exists('incomingAmount', $data)) {
                $object->setIncomingAmount($this->denormalizer->denormalize($data['incomingAmount'], \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentIncomingAmount::class, 'json', $context));
                unset($data['incomingAmount']);
            }
            if (\array_key_exists('receivedAmount', $data)) {
                $object->setReceivedAmount($this->denormalizer->denormalize($data['receivedAmount'], \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentIncomingAmount::class, 'json', $context));
                unset($data['receivedAmount']);
            }
            if (\array_key_exists('expiresAt', $data)) {
                $object->setExpiresAt(\DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['expiresAt']));
                unset($data['expiresAt']);
            }
            if (\array_key_exists('metadata', $data)) {
                $values = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
                foreach ($data['metadata'] as $key => $value) {
                    $values[$key] = $value;
                }
                $object->setMetadata($values);
                unset($data['metadata']);
            }
            if (\array_key_exists('createdAt', $data)) {
                $object->setCreatedAt(\DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['createdAt']));
                unset($data['createdAt']);
            }
            if (\array_key_exists('updatedAt', $data)) {
                $object->setUpdatedAt(\DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['updatedAt']));
                unset($data['updatedAt']);
            }
            if (\array_key_exists('methods', $data)) {
                $values_1 = [];
                foreach ($data['methods'] as $value_1) {
                    $value_2 = $value_1;
                    if (is_array($value_1) and (isset($value_1['type']) and $value_1['type'] == 'ilp') and isset($value_1['ilpAddress']) and isset($value_1['sharedSecret'])) {
                        $value_2 = $this->denormalizer->denormalize($value_1, \OpenPayments\OpenApi\Generated\ResourceServer\Model\IlpPaymentMethod::class, 'json', $context);
                    }
                    $values_1[] = $value_2;
                }
                $object->setMethods($values_1);
                unset($data['methods']);
            }
            foreach ($data as $key_1 => $value_3) {
                if (preg_match('/.*/', (string) $key_1)) {
                    $object[$key_1] = $value_3;
                }
            }
            return $object;
        }
        public function normalize(mixed $object, string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            $data['completed'] = $object->getCompleted();
            if ($object->isInitialized('incomingAmount') && null !== $object->getIncomingAmount()) {
                $data['incomingAmount'] = $this->normalizer->normalize($object->getIncomingAmount(), 'json', $context);
            }
            $data['receivedAmount'] = $this->normalizer->normalize($object->getReceivedAmount(), 'json', $context);
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
            $data['createdAt'] = $object->getCreatedAt()?->format('Y-m-d\TH:i:sP');
            $data['updatedAt'] = $object->getUpdatedAt()?->format('Y-m-d\TH:i:sP');
            $values_1 = [];
            foreach ($object->getMethods() as $value_1) {
                $value_2 = $value_1;
                if (is_object($value_1)) {
                    $value_2 = $this->normalizer->normalize($value_1, 'json', $context);
                }
                $values_1[] = $value_2;
            }
            $data['methods'] = $values_1;
            foreach ($object as $key_1 => $value_3) {
                if (preg_match('/.*/', (string) $key_1)) {
                    $data[$key_1] = $value_3;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentWithMethods::class => false];
        }
    }
} else {
    class IncomingPaymentWithMethodsNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization($data, $type, string $format = null, array $context = []): bool
        {
            return $type === \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentWithMethods::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentWithMethods::class;
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
            $object = new \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentWithMethods();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('id', $data)) {
                $object->setId($data['id']);
                unset($data['id']);
            }
            if (\array_key_exists('walletAddress', $data)) {
                $object->setWalletAddress($data['walletAddress']);
                unset($data['walletAddress']);
            }
            if (\array_key_exists('completed', $data)) {
                $object->setCompleted($data['completed']);
                unset($data['completed']);
            }
            if (\array_key_exists('incomingAmount', $data)) {
                $object->setIncomingAmount($this->denormalizer->denormalize($data['incomingAmount'], \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentIncomingAmount::class, 'json', $context));
                unset($data['incomingAmount']);
            }
            if (\array_key_exists('receivedAmount', $data)) {
                $object->setReceivedAmount($this->denormalizer->denormalize($data['receivedAmount'], \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentIncomingAmount::class, 'json', $context));
                unset($data['receivedAmount']);
            }
            if (\array_key_exists('expiresAt', $data)) {
                $object->setExpiresAt(\DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['expiresAt']));
                unset($data['expiresAt']);
            }
            if (\array_key_exists('metadata', $data)) {
                $values = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
                foreach ($data['metadata'] as $key => $value) {
                    $values[$key] = $value;
                }
                $object->setMetadata($values);
                unset($data['metadata']);
            }
            if (\array_key_exists('createdAt', $data)) {
                $object->setCreatedAt(\DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['createdAt']));
                unset($data['createdAt']);
            }
            if (\array_key_exists('updatedAt', $data)) {
                $object->setUpdatedAt(\DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['updatedAt']));
                unset($data['updatedAt']);
            }
            if (\array_key_exists('methods', $data)) {
                $values_1 = [];
                foreach ($data['methods'] as $value_1) {
                    $value_2 = $value_1;
                    if (is_array($value_1) and (isset($value_1['type']) and $value_1['type'] == 'ilp') and isset($value_1['ilpAddress']) and isset($value_1['sharedSecret'])) {
                        $value_2 = $this->denormalizer->denormalize($value_1, \OpenPayments\OpenApi\Generated\ResourceServer\Model\IlpPaymentMethod::class, 'json', $context);
                    }
                    $values_1[] = $value_2;
                }
                $object->setMethods($values_1);
                unset($data['methods']);
            }
            foreach ($data as $key_1 => $value_3) {
                if (preg_match('/.*/', (string) $key_1)) {
                    $object[$key_1] = $value_3;
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
            $data['completed'] = $object->getCompleted();
            if ($object->isInitialized('incomingAmount') && null !== $object->getIncomingAmount()) {
                $data['incomingAmount'] = $this->normalizer->normalize($object->getIncomingAmount(), 'json', $context);
            }
            $data['receivedAmount'] = $this->normalizer->normalize($object->getReceivedAmount(), 'json', $context);
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
            $data['createdAt'] = $object->getCreatedAt()?->format('Y-m-d\TH:i:sP');
            $data['updatedAt'] = $object->getUpdatedAt()?->format('Y-m-d\TH:i:sP');
            $values_1 = [];
            foreach ($object->getMethods() as $value_1) {
                $value_2 = $value_1;
                if (is_object($value_1)) {
                    $value_2 = $this->normalizer->normalize($value_1, 'json', $context);
                }
                $values_1[] = $value_2;
            }
            $data['methods'] = $values_1;
            foreach ($object as $key_1 => $value_3) {
                if (preg_match('/.*/', (string) $key_1)) {
                    $data[$key_1] = $value_3;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentWithMethods::class => false];
        }
    }
}