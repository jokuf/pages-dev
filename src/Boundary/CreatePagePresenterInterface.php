<?php


namespace Jokuf\Site\Boundary;


use Jokuf\Site\DTO\ConcretePageResponseDto;

interface CreatePagePresenterInterface
{
    public function present(ConcretePageResponseDto $response): void;
}