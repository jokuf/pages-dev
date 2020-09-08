<?php


namespace Jokuf\Site\Tests\Stub\Presenter;


use Jokuf\Site\Boundary\ICreatePageResponse;
use Jokuf\Site\DTO\PageDTO;

class DummyCreatePageResponse implements ICreatePageResponse
{

    public function present(PageDTO $pageDTO): void
    {
        // TODO: Implement present() method.
    }
}