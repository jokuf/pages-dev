<?php


namespace Jokuf\Site\Boundary;


use Jokuf\Site\DTO\DeletePageRequestDto;
use Jokuf\Site\DTO\GetPageRequestDto;

interface DeletePageRequestInterface
{
    public function handle(DeletePageRequestDto $request): void;
}