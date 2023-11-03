<?php

require 'vendor/autoload.php';

use Symfony\Component\BrowserKit\HttpBrowser;
$client = new HttpBrowser();

$url = 'https://busca.inpi.gov.br/pePI/servlet/LoginController?action=login';
$crawler = $client->request('GET', $url);

$crawler = $client->request('POST','https://busca.inpi.gov.br/pePI/jsp/marcas/Pesquisa_classe_basica.jsp', [
    'buscaExata' => 'sim',
    'txt' =>'',
    'marca' => 'abcc',
    'classeInter' =>'',
    'registerPerPage' => '20',
    'botao' =>   'pesquisar',
    'Action' => 'searchMarca',
    'tipoPesquisa' => 'BY_MARCA_CLASSIF_BASICA'
]);
// echo$crawler->form();
$crawler =  $client->submitForm('pesquisar',['marca' => 'abc']);
// $crawler->html();
// Output the PDF content

use Dompdf\Dompdf;
use Dompdf\Options;

// Create Dompdf instance
$options = new Options();
$options->set('isHtml5ParserEnabled', true); // Enable HTML5 support
$options->set('isPhpEnabled', true); // Enable PHP code within the HTML

$dompdf = new Dompdf($options);

// Load HTML content (replace this with your HTML content)
$htmlContent =$crawler->html();

$dompdf->loadHtml($htmlContent);

// Render the HTML to PDF
$dompdf->render();

// Output the PDF to a file
$outputFilename = 'output.pdf';
$dompdf->stream($outputFilename);

// You can also save the PDF to a file instead of streaming it
// $dompdf->output();

// Note: The 'stream' method sends the PDF to the browser. You can change the output method if you want to save it as a file instead.
