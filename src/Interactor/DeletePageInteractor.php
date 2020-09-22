<?php


namespace Jokuf\Site\Interactor;


use Jokuf\Site\Boundary\DeletePagePresenterInterface;
use Jokuf\Site\Boundary\DeletePageRequestInterface;
use Jokuf\Site\DTO\DeletePageRequestDto;
use Jokuf\Site\DTO\DeletePageResponseDto;
use Jokuf\Site\DTO\GetPageRequestDto;
use Jokuf\Site\Entity\Page;
use Jokuf\Site\Gateway\PageGatewayInterface;

class DeletePageInteractor implements DeletePageRequestInterface
{
    /**
     * @var PageGatewayInterface
     */
    private $gateway;
    /**
     * @var DeletePagePresenterInterface
     */
    private $presenter;

    public function __construct(PageGatewayInterface $gateway, DeletePagePresenterInterface $presenter)
    {
        $this->gateway = $gateway;
        $this->presenter = $presenter;
    }

    public function handle(DeletePageRequestDto $request): void
    {
        $response = new DeletePageResponseDto(false);

        if (1 === preg_match('#^[a-z0-9-/]+$#', $request->getSlug())) {
            $data = $this->gateway->getBySlug($request->getSlug());

            if (null !== $data) {
                $page = new Page(
                    $data->getSlug(),
                    null,
                    $data->getName(),
                    $data->getTitle(),
                    $data->getContent(),
                    $data->getTags(),
                    $data->getLevel(),
                    $data->isLocked(),
                    $data->getTemplate()
                );

                $response = new DeletePageResponseDto(
                    $page->delete(
                        $this->gateway
                    )
                );
            }

        }

        $this->presenter->present($response);
    }
}