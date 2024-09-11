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


### Sprint Planning
Iteração 1
Duração: 2 semanas 
Início: 21/08/24
Término: 11/09/24

### Sprint 1:  Sistema de Gestão de Mesas e Personagens com Interface Intuitiva

### Valor da Sprint:
Desenvolver uma interface completa e acessível que integre a criação e gestão de mesas e fichas de personagens. O sistema permitirá que mestres de RPG ou educadores possam facilmente registrar, editar e gerenciar suas mesas e fichas de personagens, além de oferecer uma experiência de usuário intuitiva e personalizável com modos noturno e claro.

### Funcionalidades:

Opções de autenticação: Sign in, Sign up e Disconnect.

Interface e Usabilidade (Página Inicial):

Criação de uma página inicial acessível, atraente e intuitiva que facilite a navegação pelos recursos.

Alternar entre modos noturno e claro.

Informações claras sobre o projeto, suas funcionalidades e objetivos.


### Gestão de Mesas (Registro de Mesas):

Registro e criação de mesas, com descrição detalhada da história, sistema de jogo, e outras opções personalizáveis.

Visualização de informações atuais da mesa, incluindo jogadores, níveis de experiência, etc.

Edição e modificação de informações das mesas e jogadores.

Exclusão de mesas e jogadores.

Sistema para agendamento de horários e dias de sessões.

Gestão de Fichas de Personagens (Registro de Ficha de Personagem):

Registro e criação de personagens, com detalhes como nome, descrição e controlador.

Visualização e edição dos detalhes da ficha do personagem.

Exclusão de personagens.

Exportação de fichas para PDF, facilitando o compartilhamento e armazenamento.

### User Stories e Prototipação

link do figma:
https://www.figma.com/proto/XRtVmx6cYXFqCAnXDwrnau/Tabula-Redonda?node-id=0-1&t=FSuhYp1hLdezC1Qp-1
