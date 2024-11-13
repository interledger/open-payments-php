<?php

namespace OpenPayments\OpenApi\Generated\AuthServer\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use OpenPayments\OpenApi\Generated\AuthServer\Runtime\Normalizer\CheckArray;
use OpenPayments\OpenApi\Generated\AuthServer\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\HttpKernel\Kernel;
if (!class_exists(Kernel::class) or (Kernel::MAJOR_VERSION >= 7 or Kernel::MAJOR_VERSION === 6 and Kernel::MINOR_VERSION === 4)) {
    class PostBodyNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
        {
            return $type === \OpenPayments\OpenApi\Generated\AuthServer\Model\PostBody::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === \OpenPayments\OpenApi\Generated\AuthServer\Model\PostBody::class;
        }
        public function denormalize(mixed $data, string $type, string $format = null, array $context = []): mixed
        {
            if (isset($data['$ref'])) {
                return new Reference($data['$ref'], $context['document-origin']);
            }
            if (isset($data['$recursiveRef'])) {
                return new Reference($data['$recursiveRef'], $context['document-origin']);
            }
            $object = new \OpenPayments\OpenApi\Generated\AuthServer\Model\PostBody();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('access_token', $data)) {
                $object->setAccessToken($this->denormalizer->denormalize($data['access_token'], \OpenPayments\OpenApi\Generated\AuthServer\Model\PostBodyAccessToken::class, 'json', $context));
                unset($data['access_token']);
            }
            if (\array_key_exists('client', $data)) {
                $object->setClient($data['client']);
                unset($data['client']);
            }
            if (\array_key_exists('interact', $data)) {
                $object->setInteract($this->denormalizer->denormalize($data['interact'], \OpenPayments\OpenApi\Generated\AuthServer\Model\InteractRequest::class, 'json', $context));
                unset($data['interact']);
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
            $data['access_token'] = $this->normalizer->normalize($object->getAccessToken(), 'json', $context);
            $data['client'] = $object->getClient();
            if ($object->isInitialized('interact') && null !== $object->getInteract()) {
                $data['interact'] = $this->normalizer->normalize($object->getInteract(), 'json', $context);
            }
            foreach ($object as $key => $value) {
                if (preg_match('/.*/', (string) $key)) {
                    $data[$key] = $value;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\OpenPayments\OpenApi\Generated\AuthServer\Model\PostBody::class => false];
        }
    }
} else {
    class PostBodyNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
    {
        use DenormalizerAwareTrait;
        use NormalizerAwareTrait;
        use CheckArray;
        use ValidatorTrait;
        public function supportsDenormalization($data, $type, string $format = null, array $context = []): bool
        {
            return $type === \OpenPayments\OpenApi\Generated\AuthServer\Model\PostBody::class;
        }
        public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
        {
            return is_object($data) && get_class($data) === \OpenPayments\OpenApi\Generated\AuthServer\Model\PostBody::class;
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
            $object = new \OpenPayments\OpenApi\Generated\AuthServer\Model\PostBody();
            if (null === $data || false === \is_array($data)) {
                return $object;
            }
            if (\array_key_exists('access_token', $data)) {
                $object->setAccessToken($this->denormalizer->denormalize($data['access_token'], \OpenPayments\OpenApi\Generated\AuthServer\Model\PostBodyAccessToken::class, 'json', $context));
                unset($data['access_token']);
            }
            if (\array_key_exists('client', $data)) {
                $object->setClient($data['client']);
                unset($data['client']);
            }
            if (\array_key_exists('interact', $data)) {
                $object->setInteract($this->denormalizer->denormalize($data['interact'], \OpenPayments\OpenApi\Generated\AuthServer\Model\InteractRequest::class, 'json', $context));
                unset($data['interact']);
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
            $data['access_token'] = $this->normalizer->normalize($object->getAccessToken(), 'json', $context);
            $data['client'] = $object->getClient();
            if ($object->isInitialized('interact') && null !== $object->getInteract()) {
                $data['interact'] = $this->normalizer->normalize($object->getInteract(), 'json', $context);
            }
            foreach ($object as $key => $value) {
                if (preg_match('/.*/', (string) $key)) {
                    $data[$key] = $value;
                }
            }
            return $data;
        }
        public function getSupportedTypes(?string $format = null): array
        {
            return [\OpenPayments\OpenApi\Generated\AuthServer\Model\PostBody::class => false];
        }
    }
}