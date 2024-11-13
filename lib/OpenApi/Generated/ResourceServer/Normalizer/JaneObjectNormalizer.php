<?php

namespace OpenPayments\OpenApi\Generated\ResourceServer\Normalizer;

use OpenPayments\OpenApi\Generated\ResourceServer\Runtime\Normalizer\CheckArray;
use OpenPayments\OpenApi\Generated\ResourceServer\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\HttpKernel\Kernel;
if (!class_exists(Kernel::class) or (Kernel::MAJOR_VERSION >= 7 or Kernel::MAJOR_VERSION === 6 and Kernel::MINOR_VERSION === 4)) {
    class JaneObjectNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        protected $normalizers = [
            
            \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPayment::class => \OpenPayments\OpenApi\Generated\ResourceServer\Normalizer\IncomingPaymentNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentIncomingAmount::class => \OpenPayments\OpenApi\Generated\ResourceServer\Normalizer\IncomingPaymentIncomingAmountNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentWithMethods::class => \OpenPayments\OpenApi\Generated\ResourceServer\Normalizer\IncomingPaymentWithMethodsNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\ResourceServer\Model\PublicIncomingPayment::class => \OpenPayments\OpenApi\Generated\ResourceServer\Normalizer\PublicIncomingPaymentNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPayment::class => \OpenPayments\OpenApi\Generated\ResourceServer\Normalizer\OutgoingPaymentNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPaymentWithSpentAmounts::class => \OpenPayments\OpenApi\Generated\ResourceServer\Normalizer\OutgoingPaymentWithSpentAmountsNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\ResourceServer\Model\Quote::class => \OpenPayments\OpenApi\Generated\ResourceServer\Normalizer\QuoteNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\ResourceServer\Model\PageInfo::class => \OpenPayments\OpenApi\Generated\ResourceServer\Normalizer\PageInfoNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\ResourceServer\Model\IlpPaymentMethod::class => \OpenPayments\OpenApi\Generated\ResourceServer\Normalizer\IlpPaymentMethodNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentsGetResponse200::class => \OpenPayments\OpenApi\Generated\ResourceServer\Normalizer\IncomingPaymentsGetResponse200Normalizer::class,
            
            \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentsPostBody::class => \OpenPayments\OpenApi\Generated\ResourceServer\Normalizer\IncomingPaymentsPostBodyNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPaymentsGetResponse200::class => \OpenPayments\OpenApi\Generated\ResourceServer\Normalizer\OutgoingPaymentsGetResponse200Normalizer::class,
            
            \Jane\Component\JsonSchemaRuntime\Reference::class => \OpenPayments\OpenApi\Generated\ResourceServer\Runtime\Normalizer\ReferenceNormalizer::class,
        ], $normalizersCache = [];
        public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
        {
            return array_key_exists($type, $this->normalizers);
        }
        public function supportsNormalization($data, $format = null, array $context = []): bool
        {
            return is_object($data) && array_key_exists(get_class($data), $this->normalizers);
        }
        public function normalize(mixed $object, string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
        {
            $normalizerClass = $this->normalizers[get_class($object)];
            $normalizer = $this->getNormalizer($normalizerClass);
            return $normalizer->normalize($object, $format, $context);
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
        {
            $denormalizerClass = $this->normalizers[$type];
            $denormalizer = $this->getNormalizer($denormalizerClass);
            return $denormalizer->denormalize($data, $type, $format, $context);
        }
        private function getNormalizer(string $normalizerClass)
        {
            return $this->normalizersCache[$normalizerClass] ?? $this->initNormalizer($normalizerClass);
        }
        private function initNormalizer(string $normalizerClass)
        {
            $normalizer = new $normalizerClass();
            $normalizer->setNormalizer($this->normalizer);
            $normalizer->setDenormalizer($this->denormalizer);
            $this->normalizersCache[$normalizerClass] = $normalizer;
            return $normalizer;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [
                
                \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPayment::class => false,
                \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentIncomingAmount::class => false,
                \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentWithMethods::class => false,
                \OpenPayments\OpenApi\Generated\ResourceServer\Model\PublicIncomingPayment::class => false,
                \OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPayment::class => false,
                \OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPaymentWithSpentAmounts::class => false,
                \OpenPayments\OpenApi\Generated\ResourceServer\Model\Quote::class => false,
                \OpenPayments\OpenApi\Generated\ResourceServer\Model\PageInfo::class => false,
                \OpenPayments\OpenApi\Generated\ResourceServer\Model\IlpPaymentMethod::class => false,
                \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentsGetResponse200::class => false,
                \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentsPostBody::class => false,
                \OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPaymentsGetResponse200::class => false,
                \Jane\Component\JsonSchemaRuntime\Reference::class => false,
            ];
        }
    }
} else {
    class JaneObjectNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        protected $normalizers = [
            
            \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPayment::class => \OpenPayments\OpenApi\Generated\ResourceServer\Normalizer\IncomingPaymentNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentIncomingAmount::class => \OpenPayments\OpenApi\Generated\ResourceServer\Normalizer\IncomingPaymentIncomingAmountNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentWithMethods::class => \OpenPayments\OpenApi\Generated\ResourceServer\Normalizer\IncomingPaymentWithMethodsNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\ResourceServer\Model\PublicIncomingPayment::class => \OpenPayments\OpenApi\Generated\ResourceServer\Normalizer\PublicIncomingPaymentNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPayment::class => \OpenPayments\OpenApi\Generated\ResourceServer\Normalizer\OutgoingPaymentNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPaymentWithSpentAmounts::class => \OpenPayments\OpenApi\Generated\ResourceServer\Normalizer\OutgoingPaymentWithSpentAmountsNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\ResourceServer\Model\Quote::class => \OpenPayments\OpenApi\Generated\ResourceServer\Normalizer\QuoteNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\ResourceServer\Model\PageInfo::class => \OpenPayments\OpenApi\Generated\ResourceServer\Normalizer\PageInfoNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\ResourceServer\Model\IlpPaymentMethod::class => \OpenPayments\OpenApi\Generated\ResourceServer\Normalizer\IlpPaymentMethodNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentsGetResponse200::class => \OpenPayments\OpenApi\Generated\ResourceServer\Normalizer\IncomingPaymentsGetResponse200Normalizer::class,
            
            \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentsPostBody::class => \OpenPayments\OpenApi\Generated\ResourceServer\Normalizer\IncomingPaymentsPostBodyNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPaymentsGetResponse200::class => \OpenPayments\OpenApi\Generated\ResourceServer\Normalizer\OutgoingPaymentsGetResponse200Normalizer::class,
            
            \Jane\Component\JsonSchemaRuntime\Reference::class => \OpenPayments\OpenApi\Generated\ResourceServer\Runtime\Normalizer\ReferenceNormalizer::class,
        ], $normalizersCache = [];
        public function supportsDenormalization($data, $type, $format = null, array $context = []): bool
        {
            return array_key_exists($type, $this->normalizers);
        }
        public function supportsNormalization($data, $format = null, array $context = []): bool
        {
            return is_object($data) && array_key_exists(get_class($data), $this->normalizers);
        }
        /**
         * @return array|string|int|float|bool|\ArrayObject|null
         */
        public function normalize($object, $format = null, array $context = [])
        {
            $normalizerClass = $this->normalizers[get_class($object)];
            $normalizer = $this->getNormalizer($normalizerClass);
            return $normalizer->normalize($object, $format, $context);
        }
        /**
         * @return mixed
         */
        public function denormalize($data, $type, $format = null, array $context = [])
        {
            $denormalizerClass = $this->normalizers[$type];
            $denormalizer = $this->getNormalizer($denormalizerClass);
            return $denormalizer->denormalize($data, $type, $format, $context);
        }
        private function getNormalizer(string $normalizerClass)
        {
            return $this->normalizersCache[$normalizerClass] ?? $this->initNormalizer($normalizerClass);
        }
        private function initNormalizer(string $normalizerClass)
        {
            $normalizer = new $normalizerClass();
            $normalizer->setNormalizer($this->normalizer);
            $normalizer->setDenormalizer($this->denormalizer);
            $this->normalizersCache[$normalizerClass] = $normalizer;
            return $normalizer;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [
                
                \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPayment::class => false,
                \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentIncomingAmount::class => false,
                \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentWithMethods::class => false,
                \OpenPayments\OpenApi\Generated\ResourceServer\Model\PublicIncomingPayment::class => false,
                \OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPayment::class => false,
                \OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPaymentWithSpentAmounts::class => false,
                \OpenPayments\OpenApi\Generated\ResourceServer\Model\Quote::class => false,
                \OpenPayments\OpenApi\Generated\ResourceServer\Model\PageInfo::class => false,
                \OpenPayments\OpenApi\Generated\ResourceServer\Model\IlpPaymentMethod::class => false,
                \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentsGetResponse200::class => false,
                \OpenPayments\OpenApi\Generated\ResourceServer\Model\IncomingPaymentsPostBody::class => false,
                \OpenPayments\OpenApi\Generated\ResourceServer\Model\OutgoingPaymentsGetResponse200::class => false,
                \Jane\Component\JsonSchemaRuntime\Reference::class => false,
            ];
        }
    }
}