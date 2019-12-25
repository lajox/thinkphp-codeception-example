<?php
class Book {
    function getName() {}
    function myMethod() {}
}

interface BookRepository {
    function find($id): Book;
    function findAll(): array;
    function add(Book $book): void;
}