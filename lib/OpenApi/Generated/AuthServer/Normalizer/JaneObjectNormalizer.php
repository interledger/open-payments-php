<?php

namespace OpenPayments\OpenApi\Generated\AuthServer\Normalizer;

use OpenPayments\OpenApi\Generated\AuthServer\Runtime\Normalizer\CheckArray;
use OpenPayments\OpenApi\Generated\AuthServer\Runtime\Normalizer\ValidatorTrait;
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
            
            \OpenPayments\OpenApi\Generated\AuthServer\Model\AccessIncoming::class => \OpenPayments\OpenApi\Generated\AuthServer\Normalizer\AccessIncomingNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\AuthServer\Model\AccessOutgoing::class => \OpenPayments\OpenApi\Generated\AuthServer\Normalizer\AccessOutgoingNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\AuthServer\Model\AccessQuote::class => \OpenPayments\OpenApi\Generated\AuthServer\Normalizer\AccessQuoteNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\AuthServer\Model\AccessToken::class => \OpenPayments\OpenApi\Generated\AuthServer\Normalizer\AccessTokenNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\AuthServer\Model\_Continue::class => \OpenPayments\OpenApi\Generated\AuthServer\Normalizer\ContinueNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\AuthServer\Model\ContinueAccessToken::class => \OpenPayments\OpenApi\Generated\AuthServer\Normalizer\ContinueAccessTokenNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\AuthServer\Model\InteractRequest::class => \OpenPayments\OpenApi\Generated\AuthServer\Normalizer\InteractRequestNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\AuthServer\Model\InteractRequestFinish::class => \OpenPayments\OpenApi\Generated\AuthServer\Normalizer\InteractRequestFinishNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\AuthServer\Model\InteractResponse::class => \OpenPayments\OpenApi\Generated\AuthServer\Normalizer\InteractResponseNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\AuthServer\Model\LimitsOutgoing::class => \OpenPayments\OpenApi\Generated\AuthServer\Normalizer\LimitsOutgoingNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\AuthServer\Model\LimitsOutgoingDebitAmount::class => \OpenPayments\OpenApi\Generated\AuthServer\Normalizer\LimitsOutgoingDebitAmountNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\AuthServer\Model\PostBody::class => \OpenPayments\OpenApi\Generated\AuthServer\Normalizer\PostBodyNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\AuthServer\Model\PostBodyAccessToken::class => \OpenPayments\OpenApi\Generated\AuthServer\Normalizer\PostBodyAccessTokenNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\AuthServer\Model\ContinueIdPostBody::class => \OpenPayments\OpenApi\Generated\AuthServer\Normalizer\ContinueIdPostBodyNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\AuthServer\Model\ContinueIdPostResponse200::class => \OpenPayments\OpenApi\Generated\AuthServer\Normalizer\ContinueIdPostResponse200Normalizer::class,
            
            \OpenPayments\OpenApi\Generated\AuthServer\Model\TokenIdPostResponse200::class => \OpenPayments\OpenApi\Generated\AuthServer\Normalizer\TokenIdPostResponse200Normalizer::class,
            
            \Jane\Component\JsonSchemaRuntime\Reference::class => \OpenPayments\OpenApi\Generated\AuthServer\Runtime\Normalizer\ReferenceNormalizer::class,
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
                
                \OpenPayments\OpenApi\Generated\AuthServer\Model\AccessIncoming::class => false,
                \OpenPayments\OpenApi\Generated\AuthServer\Model\AccessOutgoing::class => false,
                \OpenPayments\OpenApi\Generated\AuthServer\Model\AccessQuote::class => false,
                \OpenPayments\OpenApi\Generated\AuthServer\Model\AccessToken::class => false,
                \OpenPayments\OpenApi\Generated\AuthServer\Model\_Continue::class => false,
                \OpenPayments\OpenApi\Generated\AuthServer\Model\ContinueAccessToken::class => false,
                \OpenPayments\OpenApi\Generated\AuthServer\Model\InteractRequest::class => false,
                \OpenPayments\OpenApi\Generated\AuthServer\Model\InteractRequestFinish::class => false,
                \OpenPayments\OpenApi\Generated\AuthServer\Model\InteractResponse::class => false,
                \OpenPayments\OpenApi\Generated\AuthServer\Model\LimitsOutgoing::class => false,
                \OpenPayments\OpenApi\Generated\AuthServer\Model\LimitsOutgoingDebitAmount::class => false,
                \OpenPayments\OpenApi\Generated\AuthServer\Model\PostBody::class => false,
                \OpenPayments\OpenApi\Generated\AuthServer\Model\PostBodyAccessToken::class => false,
                \OpenPayments\OpenApi\Generated\AuthServer\Model\ContinueIdPostBody::class => false,
                \OpenPayments\OpenApi\Generated\AuthServer\Model\ContinueIdPostResponse200::class => false,
                \OpenPayments\OpenApi\Generated\AuthServer\Model\TokenIdPostResponse200::class => false,
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
            
            \OpenPayments\OpenApi\Generated\AuthServer\Model\AccessIncoming::class => \OpenPayments\OpenApi\Generated\AuthServer\Normalizer\AccessIncomingNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\AuthServer\Model\AccessOutgoing::class => \OpenPayments\OpenApi\Generated\AuthServer\Normalizer\AccessOutgoingNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\AuthServer\Model\AccessQuote::class => \OpenPayments\OpenApi\Generated\AuthServer\Normalizer\AccessQuoteNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\AuthServer\Model\AccessToken::class => \OpenPayments\OpenApi\Generated\AuthServer\Normalizer\AccessTokenNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\AuthServer\Model\_Continue::class => \OpenPayments\OpenApi\Generated\AuthServer\Normalizer\ContinueNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\AuthServer\Model\ContinueAccessToken::class => \OpenPayments\OpenApi\Generated\AuthServer\Normalizer\ContinueAccessTokenNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\AuthServer\Model\InteractRequest::class => \OpenPayments\OpenApi\Generated\AuthServer\Normalizer\InteractRequestNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\AuthServer\Model\InteractRequestFinish::class => \OpenPayments\OpenApi\Generated\AuthServer\Normalizer\InteractRequestFinishNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\AuthServer\Model\InteractResponse::class => \OpenPayments\OpenApi\Generated\AuthServer\Normalizer\InteractResponseNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\AuthServer\Model\LimitsOutgoing::class => \OpenPayments\OpenApi\Generated\AuthServer\Normalizer\LimitsOutgoingNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\AuthServer\Model\LimitsOutgoingDebitAmount::class => \OpenPayments\OpenApi\Generated\AuthServer\Normalizer\LimitsOutgoingDebitAmountNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\AuthServer\Model\PostBody::class => \OpenPayments\OpenApi\Generated\AuthServer\Normalizer\PostBodyNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\AuthServer\Model\PostBodyAccessToken::class => \OpenPayments\OpenApi\Generated\AuthServer\Normalizer\PostBodyAccessTokenNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\AuthServer\Model\ContinueIdPostBody::class => \OpenPayments\OpenApi\Generated\AuthServer\Normalizer\ContinueIdPostBodyNormalizer::class,
            
            \OpenPayments\OpenApi\Generated\AuthServer\Model\ContinueIdPostResponse200::class => \OpenPayments\OpenApi\Generated\AuthServer\Normalizer\ContinueIdPostResponse200Normalizer::class,
            
            \OpenPayments\OpenApi\Generated\AuthServer\Model\TokenIdPostResponse200::class => \OpenPayments\OpenApi\Generated\AuthServer\Normalizer\TokenIdPostResponse200Normalizer::class,
            
            \Jane\Component\JsonSchemaRuntime\Reference::class => \OpenPayments\OpenApi\Generated\AuthServer\Runtime\Normalizer\ReferenceNormalizer::class,
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
                
                \OpenPayments\OpenApi\Generated\AuthServer\Model\AccessIncoming::class => false,
                \OpenPayments\OpenApi\Generated\AuthServer\Model\AccessOutgoing::class => false,
                \OpenPayments\OpenApi\Generated\AuthServer\Model\AccessQuote::class => false,
                \OpenPayments\OpenApi\Generated\AuthServer\Model\AccessToken::class => false,
                \OpenPayments\OpenApi\Generated\AuthServer\Model\_Continue::class => false,
                \OpenPayments\OpenApi\Generated\AuthServer\Model\ContinueAccessToken::class => false,
                \OpenPayments\OpenApi\Generated\AuthServer\Model\InteractRequest::class => false,
                \OpenPayments\OpenApi\Generated\AuthServer\Model\InteractRequestFinish::class => false,
                \OpenPayments\OpenApi\Generated\AuthServer\Model\InteractResponse::class => false,
                \OpenPayments\OpenApi\Generated\AuthServer\Model\LimitsOutgoing::class => false,
                \OpenPayments\OpenApi\Generated\AuthServer\Model\LimitsOutgoingDebitAmount::class => false,
                \OpenPayments\OpenApi\Generated\AuthServer\Model\PostBody::class => false,
                \OpenPayments\OpenApi\Generated\AuthServer\Model\PostBodyAccessToken::class => false,
                \OpenPayments\OpenApi\Generated\AuthServer\Model\ContinueIdPostBody::class => false,
                \OpenPayments\OpenApi\Generated\AuthServer\Model\ContinueIdPostResponse200::class => false,
                \OpenPayments\OpenApi\Generated\AuthServer\Model\TokenIdPostResponse200::class => false,
                \Jane\Component\JsonSchemaRuntime\Reference::class => false,
            ];
        }
    }
}