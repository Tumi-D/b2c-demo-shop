<?php

namespace Pyz\Zed\Book\Persistence;

use Generated\Shared\Transfer\BookTransfer;

interface BookRepositoryInterface
{
    /**
     * @param int $idBook
     *
     * @return \Generated\Shared\Transfer\BookTransfer|null
     */
    public function findBookById(int $idBook): ?BookTransfer;

    /**
     * @param array $filter
     *
     * @return \Generated\Shared\Transfer\BookTransfer[]
     */
    public function findBooks(array $filter = []): array;

    /**
     * @param \Generated\Shared\Transfer\BookTransfer $bookTransfer
     *
     * @return \Generated\Shared\Transfer\BookTransfer
     */
    public function createBook(BookTransfer $bookTransfer): BookTransfer;

    /**
     * @param \Generated\Shared\Transfer\BookTransfer $bookTransfer
     *
     * @return \Generated\Shared\Transfer\BookTransfer
     */
    public function updateBook(BookTransfer $bookTransfer): BookTransfer;

    /**
     * @param int $idBook
     *
     * @return bool
     */
    public function deleteBook(int $idBook): bool;
}
