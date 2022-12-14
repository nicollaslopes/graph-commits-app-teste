Essa é uma aplicação que tem a funcionalidade de realizar a autenticação do usuário pelo Github e em seguida é listado todos os repositórios públicos.
Ao clicar em algum repositório, irá ser exibido um gráfico no qual o eixo X contém os dias dos commits deste repositório e o eixo Y contém a quantidade de commits (dos últimos 90 dias).

## Tecnologias utilizadas

- PHP(Laravel)
- Banco de Dados: Sqlite

## Para localmente testar em uma máquina

- Clone e acesse o diretório do projeto, instale as dependências com o comando `composer install`.
- Para iniciar o projeto, execute no seu terminal o comando `php artisan serve`.

## URL de Acesso
- https://graph-commits-app.vercel.app