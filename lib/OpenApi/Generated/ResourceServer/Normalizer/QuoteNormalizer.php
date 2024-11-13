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
    class QuoteNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
        {
            return $type === \OpenPayments\OpenApi\Generated\ResourceServer\Model\Quote::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === \OpenPayments\OpenApi\Generated\ResourceServer\Model\Quote::class;
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \OpenPayments\OpenApi\Generated\ResourceServer\Model\Quote();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('id', $data)) {
                $object->setId($data['id']);
            }
            if (\array_key_exists('walletAddress', $data)) {
                $object->setWalletAddress($data['walletAddress']);
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
            if (\array_key_exists('method', $data)) {
                $object->setMethod($data['method']);
            }
            if (\array_key_exists('expiresAt', $data)) {
                $object->setExpiresAt($data['expiresAt']);
            }
            if (\array_key_exists('createdAt', $data)) {
                $object->setCreatedAt(\DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['createdAt']));
            }
            return $object;
        }
        public function normalize(mixed $object, string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $data = [];
            $data['receiver'] = $object->getReceiver();
            $data['receiveAmount'] = $this->normalizer->normalize($object->getReceiveAmount(), 'json', $context);
            $data['debitAmount'] = $this->normalizer->normalize($object->getDebitAmount(), 'json', $context);
            $data['method'] = $object->getMethod();
            $data['createdAt'] = $object->getCreatedAt()?->format('Y-m-d\TH:i:sP');
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\OpenPayments\OpenApi\Generated\ResourceServer\Model\Quote::class => false];
        }
    }
} else {
    class QuoteNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization($data, $type, string $format = null, array $context = []): bool
        {
            return $type === \OpenPayments\OpenApi\Generated\ResourceServer\Model\Quote::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === \OpenPayments\OpenApi\Generated\ResourceServer\Model\Quote::class;
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
            $object = new \OpenPayments\OpenApi\Generated\ResourceServer\Model\Quote();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('id', $data)) {
                $object->setId($data['id']);
            }
            if (\array_key_exists('walletAddress', $data)) {
                $object->setWalletAddress($data['walletAddress']);
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
            if (\array_key_exists('method', $data)) {
                $object->setMethod($data['method']);
            }
            if (\array_key_exists('expiresAt', $data)) {
                $object->setExpiresAt($data['expiresAt']);
            }
            if (\array_key_exists('createdAt', $data)) {
                $object->setCreatedAt(\DateTime::createFromFormat('Y-m-d\TH:i:sP', $data['createdAt']));
            }
            return $object;
        }
        /**
         * @return array|string|int|float|bool|\ArrayObject|null
         */
        public function normalize($object, $format = null, array $context = [])
        {
            $data = [];
            $data['receiver'] = $object->getReceiver();
            $data['receiveAmount'] = $this->normalizer->normalize($object->getReceiveAmount(), 'json', $context);
            $data['debitAmount'] = $this->normalizer->normalize($object->getDebitAmount(), 'json', $context);
            $data['method'] = $object->getMethod();
            $data['createdAt'] = $object->getCreatedAt()?->format('Y-m-d\TH:i:sP');
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\OpenPayments\OpenApi\Generated\ResourceServer\Model\Quote::class => false];
        }
    }
}