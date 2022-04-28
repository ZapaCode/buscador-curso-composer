#!/usr/bin/env php
<?php

require 'vendor/autoload.php'; //Utilizado para executar as dependencias abaixo, se ele não vao funcionar

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use Alura\BuscadorDeCursos\Buscador;

$client = new Client(['base_uri'=>'http://alura.com.br/']);
$crawler = new Crawler();
$resposta = $client->request('GET', 'http://alura.com.br/cursos-online-programacao/php');

$html = $resposta->getBody();

$crawler = new Crawler();
$crawler->addHtmlContent($html);
$cursos = $crawler->filter('span.card-curso__nome');

$buscador = new Buscador($client, $crawler);
$cursos = $buscador->buscar('/cursos-online-programacao/php');


foreach($cursos as $curso){
    echo exibeMensagem($curso);
}