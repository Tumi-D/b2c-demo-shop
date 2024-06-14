<?php

namespace Pyz\Zed\Book\Communication\Controller;

use Generated\Shared\Transfer\BookTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends AbstractController
{
    public function indexAction()
    {
        $bookCollection = $this->getFacade()->getAllBooks();
        return $this->viewResponse(['bookCollection' => $bookCollection]);
    }

    public function createAction(Request $request)
    {
        $form = $this->getFactory()->createBookForm()->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bookTransfer = $form->getData();
            $this->getFacade()->createBook($bookTransfer);

            return $this->redirectResponse('/book');
        }

        return $this->viewResponse(['form' => $form->createView()]);
    }

    public function updateAction(Request $request)
    {
        $idBook = $request->query->getInt('id');
        $bookTransfer = $this->getFacade()->getBookById($idBook);

        $form = $this->getFactory()->createBookForm($bookTransfer)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bookTransfer = $form->getData();
            $this->getFacade()->updateBook($bookTransfer);

            return $this->redirectResponse('/book');
        }

        return $this->viewResponse(['form' => $form->createView()]);
    }

    public function deleteAction(Request $request)
    {
        $idBook = $request->query->getInt('id');
        $this->getFacade()->deleteBookById($idBook);

        return $this->redirectResponse('/book');
    }
}
