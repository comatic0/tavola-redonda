# Távola Redonda - Gerenciamento de Mesas de RPG

## Informações do Projeto

| **Campo**                               | **Detalhes**                                  |
|-----------------------------------------|----------------------------------------------|
| **Disciplina**                          | Engenharia de Software 2024.2                |
| **Instituição**                         | Universidade Federal do Tocantins - Palmas   |
| **Semestre & Ano**                      | 2024.2                                       |
| **Curso**                               | Bacharelado em Ciência da Computação         |
| **Professor**                           | Edeilson Milhomem da Silva                   |

## Equipe

| **Nome**                                | **Função**                                    |
|-----------------------------------------|----------------------------------------------|
| Yuri Barbosa Takahashi                  | Desenvolvimento (Front-End & Back-End)       |
| Henrique Wendler Gomes                  | Desenvolvimento (Back-End)                   |
| Vitor Leal Ferreira                     | Documentação Técnica                         |
| Emanuel Badaró Fonseca                  | Desenvolvimento (Back-End)                   |
| Thiago Soares Ribeiro Nunes de Carvalho | Desenvolvimento (Front-End)                  |

### Requisitos
- PHP 7.4 ou superior
- Servidor web (Apache, Nginx, etc.)
- Banco de dados MySQL

### Instalação

1. **Clone o repositório:**
   ```sh
   git clone https://github.com/seu-usuario/tavola-redonda.git
   cd tavola-redonda

2. **Configure o Banco de Dados:**
    - Crie um banco de dados MySQL.
    - Atualize o arquivo `config.json` com as credenciais do banco de dados:

       ```json
       {
          "DB_HOST": "localhost",
          "DB_NAME": "rpg_db",
          "DB_USER": "root",
          "DB_PASS": ""
       }
       ```

    - Importe o arquivo `sql/rpg_db.sql` para preparar as tabelas no banco de dados. Você pode fazer isso usando a linha de comando ou uma ferramenta como o phpMyAdmin.

       **Usando a linha de comando:**

       ```sh
       mysql -u root -p rpg_db < caminho/para/sql/rpg_db.sql
       ```

       **Usando o phpMyAdmin:**
       1. Abra o phpMyAdmin e selecione o banco de dados `rpg_db`
       2. Vá para a aba "Importar".
       3. Clique em "Escolher arquivo" e selecione o arquivo `sql/rpg_db.sql`
       4. Clique em "Executar" para importar o arquivo e criar as tabelas.
3. **Inicie o Servidor:**
   - Se estiver usando o XAMPP (que atualmente é utilizado pelos desenvolvedores), mova a pasta do projeto para o diretório `htdocs`.
   - Acesse `http://localhost/tavola-redonda` no seu navegador.

### Descrição 

 1. **Sobre o projeto**

     - Távola Redonda é um projeto destinado ao público de pessoas que jogam RPG (Roleplay gaming) será uma alternativa mais fácil e pratica para a criação de mesas e personagens para os jogadores, reunindo alguns sistemas, facilitando assim, o decorrer de criação pre-campanha, que costuma ser a parte mais demorada de um RPG.

     - A linguagem escolhida para desenvolver a távola redonda, foi a PHP, e optamos por desenvolver a partir do aplicativo/site "GitHub", pois como é um site muito conhecido, poderá chegar em várias pessoas do nicho que quisemos atingir 


 ### Funcionamento 

    - O funcionamento do projeto está ocorrendo tudo dentro dos conformes, até o momento, lá contratempos que tivemos foram corrigidos o mais rápido possível para o melhor uso do usuário.

