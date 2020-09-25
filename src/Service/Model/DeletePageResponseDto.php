<?php


namespace Jokuf\Site\Service\Model;


class DeletePageResponseDto
{
    /**
     * @var bool
     */
    private $successful;

    public function __construct(bool $successful) {

        $this->successful = $successful;
    }

    /**
     * @return bool
     */
    public function isSuccessful(): bool
    {
        return $this->successful;
    }
}