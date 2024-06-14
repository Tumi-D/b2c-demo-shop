<?php

namespace Pyz\Zed\Book\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Zed\Book\Business\BookFacadeInterface getFacade()
 * @method \Pyz\Zed\Book\Communication\BookCommunicationFactory getFactory()
 */
class ListController extends AbstractController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function indexAction(Request $request)
    {
        // Retrieve books from the database using the facade or factory
        $books = $this->getFacade()->getAllBooks();

        // Render the Twig template with the list of books
        return $this->viewResponse([
            'books' => $books,
        ]);
    }
}
