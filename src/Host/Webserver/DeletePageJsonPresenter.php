<?php


namespace Jokuf\Site\Host\Webserver;


use Jokuf\Site\Service\Boundary\DeletePagePresenterInterface;
use Jokuf\Site\Service\Model\DeletePageResponseDto;

class DeletePageJsonPresenter implements DeletePagePresenterInterface
{
    public function present(DeletePageResponseDto $response): void
    {
        fwrite(STDOUT, json_encode(['success' => $response->isSuccessful()]));
    }
}