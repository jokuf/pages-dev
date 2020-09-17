<?php


namespace Jokuf\Site\Boundary;


use Jokuf\Site\DTO\CreatePageResponseDto;

interface UpdatePageResponseInterface

{
    public function present(CreatePageResponseDto $response): void;
}