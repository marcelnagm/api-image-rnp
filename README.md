# api-image-rnp

Experimentos em PHP de **web scraping** e análise de imagem, usando `symfony/browser-kit` e `dompdf`.

## O que tem aqui

| Arquivo | Função |
|---|---|
| `public/process.php` | Acessa o painel público da RNP (`panorama.rnp.br`), baixa a imagem em base64 do mapa de enlaces, salva em `image.png`, recorta e lê a cor de pixels específicos para saber se cada enlace (**AM ⇄ RR**, **RR ⇄ VEN**) está ativo. Devolve o resultado como JSON junto com a imagem recortada. |
| `public/index.php` | Consulta de marcas no buscador do INPI com `HttpBrowser`, enviando o formulário e gerando o resultado em PDF com `Dompdf`. |
| `public/form.html` | Formulário simples de apoio. |
| `public/src/Acme/Client.php` | Classe cliente de exemplo. |

## Como rodar

```bash
cd public
composer install
php -S localhost:8000
# depois abra http://localhost:8000/process.php
```

Requisitos: PHP 8+, extensão `gd` e Composer.

## Observações

- Projeto de estudo/prototipação; os seletores e coordenadas de pixel dependem do layout atual das páginas de origem e podem quebrar se ele mudar.
- Veja também o [`curl_image`](https://github.com/marcelnagm/curl_image), uma versão menor da mesma ideia.
