<?php


namespace Jokuf\Site\Interactor;


use Jokuf\Site\Assembler\PageAssembler;
use Jokuf\Site\Boundary\ICreatePageResponse;
use Jokuf\Site\Entity\Page;
use Jokuf\Site\Gateway\PageGatewayInterface;
use Jokuf\Site\Boundary\ICreatePageRequest;
use Jokuf\Site\DTO\PageDTO;

class CreatePageInteractor implements ICreatePageRequest
{
    /**
     * @var Page
     */
    protected $page;
    /**
     * @var PageGatewayInterface
     */
    private $pageGateway;
    /**
     * @var ICreatePageResponse
     */
    private $response;
    /**
     * @var PageAssembler
     */
    private $pageAssembler;

    /**
     * @param PageGatewayInterface $pageGateway
     * @param ICreatePageResponse $response
     */
    public function __construct(
        PageGatewayInterface $pageGateway,
        ICreatePageResponse $response
    ) {
        $this->pageGateway = $pageGateway;
        $this->response = $response;
        $this->pageAssembler = new PageAssembler();
    }

    public function handle(PageDTO $pageDTO): void
    {
        // validate the dto

        // if all true - create entity
        $page = $this->pageAssembler->assembleEntity($pageDTO);

        // update the db
        $page->save($this->pageGateway);

        // emit the response
        $this->response->present(
            $this->pageAssembler->assembleDTO(
                $page
            )
        );
    }
}