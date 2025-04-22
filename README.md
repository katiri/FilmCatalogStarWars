# Catálogo de filmes da franquia Star Wars

Este é um projeto desenvolvido durante um teste de um processo seletivo.

## Como instalar o projeto
O primeiro passo é clonar o projeto no seu repositório local. Para isso você precisa ter o [Git](https://git-scm.com/ "Link para o site do Git"), o [XAMPP](https://www.apachefriends.org/pt_br/index.html "Link para o site do XAMPP") com PHP 7.4 e MySQL e o [Composer](https://getcomposer.org/ "Link para o site do Composer") instalados no seu computador.

Após instalar tudo crie uma pasta no dentro de htdocs do XAMPP onde gostaria de clonar o projeto. Em seguida abra o terminal e navegue até essa pasta.

Com o terminal na pasta escolhida, digite:

```sh
git clone https://github.com/katiri/FilmCatalogStarWars.git .
```

Isso vai clonar os arquivos do projeto no diretório em que o terminal estiver aberto.

É importante destacar que esse projeto é dependente da API [APIStarWars](https://github.com/katiri/APIStarWars), então realize o processo de instalação dessa API também.

Após instalar todos os itens necessários, instale as dependências do projeto executando o seguinte código no terminal:

```sh
composer install
```

Após instalar as dependências via composer, crie dentro do diretório principal um arquivo .env com o seguinte conteúdo:

```sh
API_URL=https://localhost/caminho_para_o_clone_do_projeto_APIStarWars_instalado_anteriormente
SSL=false
```

E pronto agora é só executar o servidor Apache e o MySQL no painel do XAMPP e acessar o projeto no navegador.

## Meta
João Pedro P. Ramos - <jpedropazosramos@gmail.com> - [@LinkedIn](https://www.linkedin.com/in/joao-pedro-ramos "Meu LinkedIn")

<https://katiri.github.io/>