<?php


namespace Jokuf\Site\Service\Boundary;


use Jokuf\Site\Service\Model\ConcretePageResponseDto;

interface UpdatePagePresenterInterface
{
    public function present(ConcretePageResponseDto $response): void;
}