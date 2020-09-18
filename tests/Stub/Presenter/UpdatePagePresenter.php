<?php


namespace Jokuf\Site\Tests\Stub\Presenter;


use Jokuf\Site\DTO\CreatePageResponseDto;

class UpdatePagePresenter implements \Jokuf\Site\Boundary\UpdatePageResponseInterface
{
    /** @var CreatePageResponseDto */
    public $value;

    public function present(CreatePageResponseDto $response): void
    {
        $this->value = $response;
    }
}