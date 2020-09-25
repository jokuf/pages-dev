<?php


namespace Jokuf\Site\Core\Interactor;


use Jokuf\Site\Service\Boundary\GetPagePresenterInterface;
use Jokuf\Site\Service\Boundary\GetPageRequestInterface;
use Jokuf\Site\Service\Model\ConcretePageResponseDto;
use Jokuf\Site\Service\Model\GetSinglePageBySlugDto;
use Jokuf\Site\Service\Gateway\PageGatewayInterface;

class GetSinglePageInteractor implements GetPageRequestInterface
{
    /**
     * @var PageGatewayInterface
     */
    private $gateway;

    /**
     * @var GetPagePresenterInterface
     */
    private $presenter;

    public function __construct(PageGatewayInterface $gateway, GetPagePresenterInterface $presenter)
    {
        $this->gateway = $gateway;
        $this->presenter = $presenter;
    }

    public function handle(GetSinglePageBySlugDto $request): void
    {
        if (1 === preg_match('#^[a-z0-9-/]+$#', $request->getSlug())) {
            if ($pageData = $this->gateway->getBySlug($request->getSlug())) {
                $this->presenter->present(
                    new ConcretePageResponseDto(
                        $pageData->getSlug(),
                        $pageData->getName(),
                        $pageData->getTitle(),
                        $pageData->getContent(),
                        $pageData->getTags(),
                        $pageData->getLevel(),
                        $pageData->isLocked(),
                        $pageData->getTemplate()
                    )
                );

                return;
            }
        }

        throw new \InvalidArgumentException("Page not found");
    }
}