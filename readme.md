## Sobre o projeto
Laraticket é um projeto desenvolvido no formato de tutorial que possui o objetivo de auxiliar no aprendizado do framework Laravel.

**Pelo fato do projeto ter sido desenvolvido para fins didáticos, não me responsabilizo caso você utilize-o para outros fins :)**

## Informações do projeto
O projeto consiste em um sistema de Help Desk com foco no módulo de tickets, onde foram abordados as seguintes features:

- Autenticação
    - Login
    - Registrar
    - Esqueci minha senha
- [ACL](https://pt.wikipedia.org/wiki/Lista_de_controle_de_acesso)
- Dashboard
- Módulo de Ticket
- Módulos Auxiliares (categorias, prioridades e departamentos)
- Edição de perfil

As tecnologias utilizadas foram:

- Laravel 5.5
- MySQL 5.7

## Requisitos do servidor

- PHP >= 7.0.0
- Extensão PHP OpenSSL
- Extensão PHP PDO
- Extensão PHP Mbstring
- Extensão PHP Tokenizer
- Extensão PHP XML

## Instalação

1. Clonar o projeto
1. run: `cp .env.example .env`
1. run: `composer install`
1. run: `php artisan key:generate`
1. run: `php artisan migrate --seed`

Após a instalação concluída, execute `php artisan serve` para inicializar o servidor.

## Acesso
Utilize os seguintes dados para acesso ao sistema:

### Gerente
- login: manager@manager.com
- senha: manager

### Operador
- login: operator@operator.com
- senha: operator

## Dúvidas/Problemas
Ficou com alguma dúvida em alguma etapa? Encontrou algum problema ou dificuldade? Tem ideias de melhorias?

Crie uma [issue](https://github.com/dorianneto/laraticket/issues) e vamos conversar ;)

## Licença

Laraticket é um software open source licenciado sob a licença MIT (MIT). Por favor, veja [LICENSE](license.md) para maiores detalhes.

Desenvolvido com :heart: por [Dorian Neto](https://github.com/dorianneto)