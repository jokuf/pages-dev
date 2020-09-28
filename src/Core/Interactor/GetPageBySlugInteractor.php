<?php


namespace Jokuf\Site\Core\Interactor;


use Jokuf\Site\Service\Boundary\GetPagePresenterInterface;
use Jokuf\Site\Service\Boundary\GetPageRequestInterface;
use Jokuf\Site\Service\Model\ConcretePageResponseDto;
use Jokuf\Site\Service\Model\GetPageRequestDto;
use Jokuf\Site\Service\Gateway\PageGatewayInterface;

class GetPageBySlugInteractor implements GetPageRequestInterface
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
        if (false !== ($parsedSlug = parse_url($request->getSlug()))) {
            $path = $parsedSlug['path'];
            if ($pageData = $this->gateway->getBySlug($path)) {
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