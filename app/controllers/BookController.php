<?php


namespace app\controllers;

use app\exceptions\NotFoundException;
use app\repositories\BookRepository;
use app\requests\CreateRequest;
use Phalcon\Mvc\Controller;

class BookController extends BaseController
{
    protected BookRepository $bookRepository;

    public function onConstruct()
    {
        $this->bookRepository = new BookRepository();
    }

    public function getAllAction()
    {
        return $this->bookRepository->getAllBooks();
    }

    public function getAction($id)
    {
        $book = $this->bookRepository->getById($id);

        if(null == $book)
        {
            throw new NotFoundException("Book");
        }

        return $book;
    }

    public function createAction()
    {
        return $this->bookRepository->create($this->request->getJsonRawBody(true));
    }

    public function updateAction($id)
    {
        return $this->bookRepository->update($id, $this->request->getJsonRawBody(true));
    }

    public function deleteAction($id)
    {
        $is_success = $this->bookRepository->delete($id);
        return [
            'success' => $is_success
        ];
    }
}