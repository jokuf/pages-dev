<?php


namespace Jokuf\Site\Interactor;


use Jokuf\Site\Assembler\PageAssembler;
use Jokuf\Site\Boundary\ICreatePageResponse;
use Jokuf\Site\Entity\Page;
use Jokuf\Site\Gateway\IPageGateway;
use Jokuf\Site\Boundary\ICreatePageRequest;
use Jokuf\Site\DTO\PageDTO;

class CreatePageInteractor implements ICreatePageRequest
{
    /**
     * @var Page
     */
    protected $page;
    /**
     * @var IPageGateway
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
     * @param IPageGateway $pageGateway
     * @param ICreatePageResponse $response
     */
    public function __construct(
        IPageGateway $pageGateway,
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
        $this->pageGateway->save($page);

        // emit the response
        $this->response->present(
            $this->pageAssembler->assembleDTO(
                $page
            )
        );
    }
}