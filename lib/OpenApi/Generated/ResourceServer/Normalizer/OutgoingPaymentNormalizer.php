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
    class OutgoingPaymentNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
        {
            return $type === \OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPayment::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === \OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPayment::class;
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPayment();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('id', $data)) {
                $object->setId($data['id']);
            }
            if (\array_key_exists('walletAddress', $data)) {
                $object->setWalletAddress($data['walletAddress']);
            }
            if (\array_key_exists('quoteId', $data)) {
                $object->setQuoteId($data['quoteId']);
            }
            if (\array_key_exists('failed', $data)) {
                $object->setFailed($data['failed']);
            }
            if (\array_key_exists('receiver', $data)) {
                $object->setReceiver($data['receiver']);
            }
            if (\array_key_exists('receiveAmount', $data)) {
                $object->setReceiveAmount($this->denormalizer->denormalize($data['receiveAmount'], \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentIncomingAmount::class, 'json', $context));
            }
            if (\array_key_exists('debitAmount', $data)) {
                $object->setDebitAmount($this->denormalizer->denormalize($data['debitAmount'], \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentIncomingAmount::class, 'json', $context));
            }
            if (\array_key_exists('sentAmount', $data)) {
                $object->setSentAmount($this->denormalizer->denormalize($data['sentAmount'], \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentIncomingAmount::class, 'json', $context));
            }
            if (\array_key_exists('metadata', $data)) {
                $values = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
                foreach ($data['metadata'] as $key => $value) {
                    $values[$key] = $value;
                }
                $object->setMetadata($values);
            }
            if (\array_key_exists('createdAt', $data)) {
                $object->setCreatedAt(\DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['createdAt']));
            }
            if (\array_key_exists('updatedAt', $data)) {
                $object->setUpdatedAt(\DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['updatedAt']));
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
            if ($object->isInitialized('metadata') && null !== $object->getMetadata()) {
                $values = [];
                foreach ($object->getMetadata() as $key => $value) {
                    $values[$key] = $value;
                }
                $data['metadata'] = $values;
            }
            $data['createdAt'] = $object->getCreatedAt()?->format('Y-m-d\TH:i:sP');
            $data['updatedAt'] = $object->getUpdatedAt()?->format('Y-m-d\TH:i:sP');
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPayment::class => false];
        }
    }
} else {
    class OutgoingPaymentNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization($data, $type, string $format = null, array $context = []): bool
        {
            return $type === \OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPayment::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === \OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPayment::class;
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
            $object = new \OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPayment();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('id', $data)) {
                $object->setId($data['id']);
            }
            if (\array_key_exists('walletAddress', $data)) {
                $object->setWalletAddress($data['walletAddress']);
            }
            if (\array_key_exists('quoteId', $data)) {
                $object->setQuoteId($data['quoteId']);
            }
            if (\array_key_exists('failed', $data)) {
                $object->setFailed($data['failed']);
            }
            if (\array_key_exists('receiver', $data)) {
                $object->setReceiver($data['receiver']);
            }
            if (\array_key_exists('receiveAmount', $data)) {
                $object->setReceiveAmount($this->denormalizer->denormalize($data['receiveAmount'], \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentIncomingAmount::class, 'json', $context));
            }
            if (\array_key_exists('debitAmount', $data)) {
                $object->setDebitAmount($this->denormalizer->denormalize($data['debitAmount'], \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentIncomingAmount::class, 'json', $context));
            }
            if (\array_key_exists('sentAmount', $data)) {
                $object->setSentAmount($this->denormalizer->denormalize($data['sentAmount'], \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentIncomingAmount::class, 'json', $context));
            }
            if (\array_key_exists('metadata', $data)) {
                $values = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
                foreach ($data['metadata'] as $key => $value) {
                    $values[$key] = $value;
                }
                $object->setMetadata($values);
            }
            if (\array_key_exists('createdAt', $data)) {
                $object->setCreatedAt(\DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['createdAt']));
            }
            if (\array_key_exists('updatedAt', $data)) {
                $object->setUpdatedAt(\DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['updatedAt']));
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
            if ($object->isInitialized('metadata') && null !== $object->getMetadata()) {
                $values = [];
                foreach ($object->getMetadata() as $key => $value) {
                    $values[$key] = $value;
                }
                $data['metadata'] = $values;
            }
            $data['createdAt'] = $object->getCreatedAt()?->format('Y-m-d\TH:i:sP');
            $data['updatedAt'] = $object->getUpdatedAt()?->format('Y-m-d\TH:i:sP');
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPayment::class => false];
        }
    }
}