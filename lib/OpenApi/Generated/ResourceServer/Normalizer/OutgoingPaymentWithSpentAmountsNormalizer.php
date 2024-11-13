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
    class OutgoingPaymentWithSpentAmountsNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
        {
            return $type === \OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPaymentWithSpentAmounts::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === \OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPaymentWithSpentAmounts::class;
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPaymentWithSpentAmounts();
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
            if (\array_key_exists('quoteId', $data)) {
                $object->setQuoteId($data['quoteId']);
                unset($data['quoteId']);
            }
            if (\array_key_exists('failed', $data)) {
                $object->setFailed($data['failed']);
                unset($data['failed']);
            }
            if (\array_key_exists('receiver', $data)) {
                $object->setReceiver($data['receiver']);
                unset($data['receiver']);
            }
            if (\array_key_exists('receiveAmount', $data)) {
                $object->setReceiveAmount($this->denormalizer->denormalize($data['receiveAmount'], \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentIncomingAmount::class, 'json', $context));
                unset($data['receiveAmount']);
            }
            if (\array_key_exists('debitAmount', $data)) {
                $object->setDebitAmount($this->denormalizer->denormalize($data['debitAmount'], \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentIncomingAmount::class, 'json', $context));
                unset($data['debitAmount']);
            }
            if (\array_key_exists('sentAmount', $data)) {
                $object->setSentAmount($this->denormalizer->denormalize($data['sentAmount'], \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentIncomingAmount::class, 'json', $context));
                unset($data['sentAmount']);
            }
            if (\array_key_exists('grantSpentDebitAmount', $data)) {
                $object->setGrantSpentDebitAmount($this->denormalizer->denormalize($data['grantSpentDebitAmount'], \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentIncomingAmount::class, 'json', $context));
                unset($data['grantSpentDebitAmount']);
            }
            if (\array_key_exists('grantSpentReceiveAmount', $data)) {
                $object->setGrantSpentReceiveAmount($this->denormalizer->denormalize($data['grantSpentReceiveAmount'], \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentIncomingAmount::class, 'json', $context));
                unset($data['grantSpentReceiveAmount']);
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
            foreach ($data as $key_1 => $value_1) {
                if (preg_match('/.*/', (string) $key_1)) {
                    $object[$key_1] = $value_1;
                }
            }
            return $object;
        }
        public function normalize(mixed $object, string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            if ($object->isInitialized('failed') && null !== $object->getFailed()) {
                $data['failed'] = $object->getFailed();
            }
            $data['receiver'] = $object->getReceiver();
            $data['receiveAmount'] = $this->normalizer->normalize($object->getReceiveAmount(), 'json', $context);
            $data['debitAmount'] = $this->normalizer->normalize($object->getDebitAmount(), 'json', $context);
            $data['sentAmount'] = $this->normalizer->normalize($object->getSentAmount(), 'json', $context);
            if ($object->isInitialized('grantSpentDebitAmount') && null !== $object->getGrantSpentDebitAmount()) {
                $data['grantSpentDebitAmount'] = $this->normalizer->normalize($object->getGrantSpentDebitAmount(), 'json', $context);
            }
            if ($object->isInitialized('grantSpentReceiveAmount') && null !== $object->getGrantSpentReceiveAmount()) {
                $data['grantSpentReceiveAmount'] = $this->normalizer->normalize($object->getGrantSpentReceiveAmount(), 'json', $context);
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
            foreach ($object as $key_1 => $value_1) {
                if (preg_match('/.*/', (string) $key_1)) {
                    $data[$key_1] = $value_1;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPaymentWithSpentAmounts::class => false];
        }
    }
} else {
    class OutgoingPaymentWithSpentAmountsNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization($data, $type, string $format = null, array $context = []): bool
        {
            return $type === \OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPaymentWithSpentAmounts::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === \OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPaymentWithSpentAmounts::class;
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
            $object = new \OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPaymentWithSpentAmounts();
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
            if (\array_key_exists('quoteId', $data)) {
                $object->setQuoteId($data['quoteId']);
                unset($data['quoteId']);
            }
            if (\array_key_exists('failed', $data)) {
                $object->setFailed($data['failed']);
                unset($data['failed']);
            }
            if (\array_key_exists('receiver', $data)) {
                $object->setReceiver($data['receiver']);
                unset($data['receiver']);
            }
            if (\array_key_exists('receiveAmount', $data)) {
                $object->setReceiveAmount($this->denormalizer->denormalize($data['receiveAmount'], \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentIncomingAmount::class, 'json', $context));
                unset($data['receiveAmount']);
            }
            if (\array_key_exists('debitAmount', $data)) {
                $object->setDebitAmount($this->denormalizer->denormalize($data['debitAmount'], \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentIncomingAmount::class, 'json', $context));
                unset($data['debitAmount']);
            }
            if (\array_key_exists('sentAmount', $data)) {
                $object->setSentAmount($this->denormalizer->denormalize($data['sentAmount'], \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentIncomingAmount::class, 'json', $context));
                unset($data['sentAmount']);
            }
            if (\array_key_exists('grantSpentDebitAmount', $data)) {
                $object->setGrantSpentDebitAmount($this->denormalizer->denormalize($data['grantSpentDebitAmount'], \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentIncomingAmount::class, 'json', $context));
                unset($data['grantSpentDebitAmount']);
            }
            if (\array_key_exists('grantSpentReceiveAmount', $data)) {
                $object->setGrantSpentReceiveAmount($this->denormalizer->denormalize($data['grantSpentReceiveAmount'], \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentIncomingAmount::class, 'json', $context));
                unset($data['grantSpentReceiveAmount']);
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
            foreach ($data as $key_1 => $value_1) {
                if (preg_match('/.*/', (string) $key_1)) {
                    $object[$key_1] = $value_1;
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
            if ($object->isInitialized('failed') && null !== $object->getFailed()) {
                $data['failed'] = $object->getFailed();
            }
            $data['receiver'] = $object->getReceiver();
            $data['receiveAmount'] = $this->normalizer->normalize($object->getReceiveAmount(), 'json', $context);
            $data['debitAmount'] = $this->normalizer->normalize($object->getDebitAmount(), 'json', $context);
            $data['sentAmount'] = $this->normalizer->normalize($object->getSentAmount(), 'json', $context);
            if ($object->isInitialized('grantSpentDebitAmount') && null !== $object->getGrantSpentDebitAmount()) {
                $data['grantSpentDebitAmount'] = $this->normalizer->normalize($object->getGrantSpentDebitAmount(), 'json', $context);
            }
            if ($object->isInitialized('grantSpentReceiveAmount') && null !== $object->getGrantSpentReceiveAmount()) {
                $data['grantSpentReceiveAmount'] = $this->normalizer->normalize($object->getGrantSpentReceiveAmount(), 'json', $context);
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
            foreach ($object as $key_1 => $value_1) {
                if (preg_match('/.*/', (string) $key_1)) {
                    $data[$key_1] = $value_1;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPaymentWithSpentAmounts::class => false];
        }
    }
}