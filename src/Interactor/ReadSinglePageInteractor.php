<?php


namespace Jokuf\Site\Interactor;


use Jokuf\Site\Boundary\GetPagePresenterInterface;
use Jokuf\Site\Boundary\GetPageRequestInterface;
use Jokuf\Site\DTO\ConcretePageResponseDto;
use Jokuf\Site\DTO\GetPageRequestDto;
use Jokuf\Site\Gateway\PageGatewayInterface;

class ReadSinglePageInteractor implements GetPageRequestInterface
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

    public function handle(GetPageRequestDto $request): void
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