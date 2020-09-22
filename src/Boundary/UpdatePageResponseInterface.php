<?php


namespace Jokuf\Site\Boundary;


use Jokuf\Site\DTO\ConcretePageResponseDto;

interface UpdatePageResponseInterface

{
    public function present(ConcretePageResponseDto $response): void;
}