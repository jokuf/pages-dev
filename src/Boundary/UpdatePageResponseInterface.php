<?php


namespace Jokuf\Site\Boundary;


use Jokuf\Site\DTO\CreatePageRequestDto;

interface UpdatePageResponseInterface

{
    public function present(CreatePageRequestDto $pageDTO): void;
}