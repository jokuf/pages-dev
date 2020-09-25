<?php


namespace Jokuf\Site\Core\Interactor;


use Jokuf\Site\Service\Boundary\GetPagesPresenterInterface;
use Jokuf\Site\Service\Model\GetPageRequestDto;
use Jokuf\Site\Service\Model\PageCollectionResponseDto;
use Jokuf\Site\Service\Gateway\PageGatewayInterface;

class GetPagesCollection implements \Jokuf\Site\Service\Boundary\GetPagesRequestInterface
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