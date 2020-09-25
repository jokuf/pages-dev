<?php


namespace Jokuf\Site\Core\Interactor;


use Jokuf\Site\Service\Boundary\GetPagesPresenterInterface;
use Jokuf\Site\Service\Model\GetSinglePageBySlugDto;
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
     * @param GetSinglePageBySlugDto $request
     */
    public function handle(GetSinglePageBySlugDto $request): void
    {
        $response = new PageCollectionResponseDto();


    }
}