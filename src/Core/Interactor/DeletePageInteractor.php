<?php


namespace Jokuf\Site\Core\Interactor;


use Jokuf\Site\Service\Boundary\DeletePagePresenterInterface;
use Jokuf\Site\Service\Boundary\DeletePageRequestInterface;
use Jokuf\Site\Service\Model\DeletePageRequestDto;
use Jokuf\Site\Service\Model\DeletePageResponseDto;
use Jokuf\Site\Service\Model\GetPageRequestDto;
use Jokuf\Site\Core\Entity\Page;
use Jokuf\Site\Service\Gateway\PageGatewayInterface;

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
                $page = new Page($data);

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