<?php


namespace Jokuf\Site\Service\Boundary;


use Jokuf\Site\Service\Model\ConcretePageResponseDto;

interface CreatePagePresenterInterface
{
    public function present(ConcretePageResponseDto $response): void;
}