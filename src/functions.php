<?php

use Michelf\Markdown;

function renderHTMLFromMarkdown($string_markdown_formatted)
{
    return Markdown::defaultTransform($string_markdown_formatted);
}

function multiply($facteur_gauche, $facteur_droite)
{
    return $facteur_gauche * $facteur_droite;
}

function getBooks()
{
    $response = Requests::get('https://medusa.delahayeyourself.info/api/books/');

    $books=json_decode($response->body);

    return $books;
}

function readFileContent($filepath)
{
    return file_get_contents($filepath);
}