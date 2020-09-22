<?php


namespace Jokuf\Site\Boundary;


use Jokuf\Site\DTO\DeletePageResponseDto;

interface DeletePagePresenterInterface
{
    public function present(DeletePageResponseDto $response): void;
}