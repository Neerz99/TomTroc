<?php

class HomeController extends Controller
{
    public function index()
    {
        $booksModel = new BooksModel();
        $allBooks = $booksModel->findAllWithOwners();

        $latestBooks = array_slice($allBooks, 0, 4);

        $this->render('home/index', [
            'title'   => 'Rejoignez nos lecteurs passionnés ',
            'latestBooks'   => $latestBooks,
        ]);
    }
}
