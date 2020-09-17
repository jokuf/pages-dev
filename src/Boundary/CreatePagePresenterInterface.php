<?php


namespace Jokuf\Site\Boundary;


use Jokuf\Site\DTO\CreatePageResponseDto;

interface CreatePagePresenterInterface
{
    public function present(CreatePageResponseDto $response): void;
}