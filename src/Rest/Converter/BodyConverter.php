<?php

namespace SymfonyBoot\SymfonyBootBundle\Rest\Converter;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use SymfonyBoot\SymfonyBootBundle\Serializer\AcceptedFormats;
use SymfonyBoot\SymfonyBootBundle\Serializer\DefaultFormat;

class BodyConverter extends AbstractConverter
{

    protected AcceptedFormats $acceptedFormats;

    public function __construct(
        SerializerInterface $serializer,
        DefaultFormat $defaultFormat,
        AcceptedFormats $acceptedFormats
    ) {
        parent::__construct($serializer, $defaultFormat);
        $this->acceptedFormats = $acceptedFormats;
    }

    protected function getContent(Request $request): string
    {
        return $request->getContent();
    }

    protected function getFormat(Request $request): string
    {
        $format = $request->getContentType();

        return $this->acceptedFormats->isAcceptedFormat($format)
            ? $format
            : $this->defaultFormat->getFormat();
    }
}
