<?php


namespace Jokuf\Site\Service\Boundary;


use Jokuf\Site\Service\Model\DeletePageResponseDto;

interface DeletePagePresenterInterface
{
    public function present(DeletePageResponseDto $response): void;
}