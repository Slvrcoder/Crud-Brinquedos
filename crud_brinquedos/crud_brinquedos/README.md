# CRUD de Gestão de Brinquedos

Sistema web simples, feito em PHP procedural e MySQL, para gerenciar os brinquedos de uma loja. Permite **cadastrar**, **listar**, **editar** e **excluir** brinquedos, com os dados: nome, categoria, faixa etária, preço e quantidade em estoque.

Este projeto foi desenvolvido como Atividade de Recuperação de CRUD / Prepared Statements em PHP.

## Funcionalidades

- **Create**: cadastro de novos brinquedos através de formulário.
- **Read**: listagem de todos os brinquedos cadastrados.
- **Update**: edição dos dados de um brinquedo já cadastrado.
- **Delete**: exclusão de um brinquedo (com confirmação no navegador).

## Requisitos técnicos atendidos

- Todas as operações no banco de dados usam **Prepared Statements** (`mysqli_prepare` / `mysqli_stmt_bind_param`), sem concatenação direta de valores do usuário nas queries.
- **Validação dos dados** recebidos (campos obrigatórios, preço e estoque numéricos, valores não negativos), tanto no `required`/`type` do HTML quanto no PHP no lado do servidor.
- **Tratamento básico de erros**: verificação de falha de conexão, falha ao preparar/executar statements, e mensagens exibidas ao usuário.
- **Organização dos arquivos**:
  - `index.php` — página principal (formulário de cadastro + listagem).
  - `infra/conexao.php` — conexão com o banco (mysqli).
  - `infra/funcoes.php` — funções auxiliares de validação e redirecionamento.
  - `public/cadastrar.php` — Create.
  - `public/editar.php` — exibe o formulário de edição (Read de um registro).
  - `public/atualizar.php` — Update.
  - `public/excluir.php` — Delete.
  - `style/styles.css` — estilos da interface.
  - `database/brinquedos.sql` — script de criação do banco e da tabela.

## Estrutura do banco de dados

Tabela `brinquedos`:

| Campo               | Tipo           | Observação              |
|---------------------|----------------|--------------------------|
| id                  | INT (AUTO_INCREMENT) | Chave primária     |
| nome                | VARCHAR(100)   | Obrigatório              |
| categoria           | VARCHAR(60)    | Obrigatório              |
| faixa_etaria        | VARCHAR(30)    | Obrigatório              |
| preco               | DECIMAL(10,2)  | Não pode ser negativo    |
| quantidade_estoque  | INT             | Não pode ser negativo    |
| criado_em           | TIMESTAMP      | Preenchido automaticamente |

## Como executar o sistema

### Pré-requisitos
- PHP 7.4+ com extensão `mysqli` habilitada.
- Servidor MySQL (ex.: via XAMPP, WAMP, Laragon ou MySQL/MariaDB local).
- Um servidor web local (Apache embutido do XAMPP, ou `php -S`).

### Passo a passo

1. Clone o repositório:
   ```bash
   git clone <url-do-repositorio>
   cd crud_brinquedos
   ```

2. Crie o banco de dados e a tabela importando o script SQL:
   ```bash
   mysql -u root -p < database/brinquedos.sql
   ```
   Ou, pelo phpMyAdmin: abra a aba **Importar** e selecione o arquivo `database/brinquedos.sql`.

3. Configure as credenciais do banco em `infra/conexao.php` (host, usuário, senha) caso sejam diferentes do padrão (`localhost` / `root` / senha em branco).

4. Suba o servidor PHP. Duas opções:
   - Colocando a pasta do projeto dentro do `htdocs` do XAMPP e acessando via `http://localhost/crud_brinquedos/`.
   - Ou rodando o servidor embutido do PHP dentro da pasta do projeto:
     ```bash
     php -S localhost:8000
     ```
     e acessando `http://localhost:8000/`.

5. Abra o navegador na página inicial (`index.php`) e utilize o sistema: cadastre, edite e exclua brinquedos.

## Tecnologias utilizadas

- PHP (mysqli + Prepared Statements)
- MySQL
- HTML5 / CSS3
