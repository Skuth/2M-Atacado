<h1 align="center">
    <img alt="2M Atacado"src=".github/logo.webp" width="150px" />
</h1>

<p align="center">
  <img alt="GitHub language count" src="https://img.shields.io/github/languages/count/Skuth/2M-Atacado">

  <img alt="Repository size" src="https://img.shields.io/github/repo-size/Skuth/2M-Atacado">

  <img alt="License" src="https://img.shields.io/badge/license-MIT-brightgreen">
</p>

<p align="center">
  <img alt="Frontend" src=".github/picture.png" width="100%">
  <img alt="Frontend Product" src=".github/picture-product.png" width="100%">
  <br><br>
  <img alt="Frontend Mobile" src=".github/picture-sm.png" width="200px">
</p>

## 📋 Tecnologias

Esse projeto foi desenvolvido com as seguintes tecnologias:

- [Slim Framework](https://www.slimframework.com/)
- [Rain Tpl](https://github.com/feulf/raintpl3)
- [Sass](https://sass-lang.com/)
- [Gulp](https://gulpjs.com/)

## 💻 Projeto

A 2M Atacado é um distribuidor para materiais de construção, Onde os valores são liberados apenas para clientes PJ autorizados dentro do sistema, o site conta com PWA para utilização rápido em dispositivos moveis.

## 👨‍💻 Como usar

- Necessário [Composer](https://getcomposer.org/)

- Clonar este respositório:
  ```
  $ git clone https://github.com/Skuth/2M-Atacado
  ```
- Instale o [WampServer](https://www.wampserver.com/en/) ou algum servidor Apache com PHP >= 7.2
- Configure uma **Virtual Host** para o site
- Configure o [Banco de Dados](./db.sql)
- Instale as dependências:
  ```
  $ composer install
  ```
- Crie e configure o arquivo [Config.php](./vendor/skuth/php-classes/src/DB/Config.example.php)
- Acesse sua **Virtual Host**
- Acesso para o painel é **admin** | **admin**

## 📝 Licença

Esse projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE.md) para mais detalhes.