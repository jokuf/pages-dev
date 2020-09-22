<?php


namespace Jokuf\Site\Interactor;


use Jokuf\Site\Boundary\GetPagesPresenterInterface;
use Jokuf\Site\DTO\GetPageRequestDto;
use Jokuf\Site\DTO\PageCollectionResponseDto;
use Jokuf\Site\Gateway\PageGatewayInterface;

class GetPagesCollection implements \Jokuf\Site\Boundary\GetPagesRequestInterface
{
    /**
     * @var PageGatewayInterface
     */
    private $gateway;
    /**
     * @var GetPagesPresenterInterface
     */
    private $presenter;

    public function __construct(PageGatewayInterface $gateway, GetPagesPresenterInterface $presenter)
    {
        $this->gateway = $gateway;
        $this->presenter = $presenter;
    }

    /**
     * @param GetPageRequestDto $request
     */
    public function handle(GetPageRequestDto $request): void
    {
        $response = new PageCollectionResponseDto();


    }
}