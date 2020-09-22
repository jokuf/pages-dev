<?php


namespace Jokuf\Site\Boundary;


use Jokuf\Site\DTO\ConcretePageResponseDto;

interface GetPagePresenterInterface
{
    public function present(ConcretePageResponseDto $response);
}