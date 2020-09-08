<?php


namespace Jokuf\Site\Interactor;


use Jokuf\Site\Assembler\PageAssembler;
use Jokuf\Site\Boundary\IUpdatePageResponse;
use Jokuf\Site\DTO\PageDTO;
use Jokuf\Site\Gateway\IPageGateway;

class UpdatePageInteractor implements IUpdatePageResponse
{
    /**
     * @var IPageGateway
     */
    private $gateway;
    /**
     * @var IUpdatePageResponse
     */
    private $response;
    /**
     * @var PageAssembler
     */
    private $assembler;

    public function __construct(IPageGateway $gateway, IUpdatePageResponse $response)
    {
        $this->assembler = new PageAssembler();
        $this->gateway = $gateway;
        $this->response = $response;
    }

    public function present(PageDTO $pageDTO): void
    {
        if (null === $pageDTO->getId()) {
            throw new \DomainException('Cannot update page that not exists');
        }

        $page = $this->assembler->assembleEntity($pageDTO);
        $this->gateway->save($page);

        $this->response->present(
            $this->assembler->assembleDTO(
                $page
            )
        );
    }
}