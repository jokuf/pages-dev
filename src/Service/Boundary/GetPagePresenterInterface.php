<?php


namespace Jokuf\Site\Service\Boundary;


use Jokuf\Site\Service\Model\ConcretePageResponseDto;

interface GetPagePresenterInterface
{
    public function present(ConcretePageResponseDto $response);
}