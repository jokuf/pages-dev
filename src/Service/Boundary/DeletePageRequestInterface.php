<?php


namespace Jokuf\Site\Service\Boundary;


use Jokuf\Site\Service\Model\DeletePageRequestDto;
use Jokuf\Site\Service\Model\GetPageRequestDto;

interface DeletePageRequestInterface
{
    public function handle(DeletePageRequestDto $request): void;
}