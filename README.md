# Távola Redonda - Gerenciamento de Mesas de RPG
![image](https://github.com/user-attachments/assets/fe3efe8b-56a5-456e-b540-6bcacc916dcf)


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
| Yuri Barbosa Takahashi - Líder -                 | Desenvolvimento (Front-End & Back-End)       |
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
    - Atualize o arquivo `config.json` com as credenciais do banco de dados e consiga a chave da API Steam, pode ser adquirida em https://steamcommunity.com/dev :

       ```json
       {
          "DB_HOST": "localhost",
          "DB_NAME": "rpg_db",
          "DB_USER": "root",
          "DB_PASS": "",
          "STEAM_API_KEY": ""
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
3. **Configurando o XAMPP & Composer**
   - Vá no painel de administração do XAMPP, e altere o `php.ini`
   - Procure a linha `;extension=gd`, tire o `;` e salve-a apenas como `extension=gd`
   - Reinicie o Apache.
   - Instale o Composer em https://getcomposer.org/Composer-Setup.exe
   - Acesse a pasta do repositório e rode o comando `composer install`
   ![Code_RC65hAP9po](https://github.com/user-attachments/assets/c5087ad8-7f38-4718-b4d2-2bc09950d3af)

3. **Inicie o Servidor:**
   - Se estiver usando o XAMPP (que atualmente é utilizado pelos desenvolvedores), mova a pasta do projeto para o diretório `htdocs`.
   - Acesse `http://localhost/tavola-redonda` no seu navegador.

### Descrição 

 1. **Sobre o projeto**

     - Távola Redonda é um projeto destinado ao público de pessoas que jogam RPG (Roleplay gaming) será uma alternativa mais fácil e pratica para a criação de mesas e personagens para os jogadores, reunindo alguns sistemas, facilitando assim, o decorrer de criação pre-campanha, que costuma ser a parte mais demorada de um RPG.

     - A linguagem escolhida para desenvolver a távola redonda, foi a PHP, e optamos por desenvolver a partir do aplicativo/site "GitHub", pois como é um site muito conhecido, poderá chegar em várias pessoas do nicho que quisemos atingir 


 ### Funcionamento 


### Sprint Planning
### Iteração 1

### Sprint 1:  Sistema de Gestão de Mesas 

### Valor da Sprint:
Desenvolver uma interface completa e acessível que integre a criação e gestão de mesas. O sistema permitirá que mestres de RPG ou educadores possam facilmente registrar, editar e gerenciar suas mesas e oferecer uma experiência de usuário intuitiva e personalizável.

### Funcionalidades:

Opções de autenticação: registro de usuário

Interface e Usabilidade (Página Inicial):

Criação de uma página inicial acessível, atraente e intuitiva que facilite a navegação pelos recursos.

Informações claras sobre o projeto, suas funcionalidades e objetivos.

 Gestão de Mesas (Registro de Mesas):

Registro e criação de mesas, com descrição detalhada da história, sistema de jogo, e outras opções personalizáveis.

Visualização de informações atuais da mesa, etc.

Edição e modificação de informações das mesas.

Exclusão de mesas.

### Iteração 2:

### Sprint 1:

### valor: 

Possibilatar ao usuário a busca por mesas existentes, o cadastro de personagens, funções adicionais no gerenciamento de mesas, possibilitando o ingresso de jogadores nas mesas, cadastro de mestres, login de usuários e mestres.

### Funcionalidades:
Sistema para buscar por uma mesa existente no banco de dados:
O usuário poderá ingressar em uma mesa que já existe procurando por ela

Sistema para agendamento de horários e dias de sessões durante a criação de mesas.

Gestão de Fichas de Personagens (Registro de Ficha de Personagem):

Registro e criação de personagens, com detalhes como nome, descrição e controlador.

Possibilitar a exibição, alteração e exlusão do perfil.

Criação de uma página acessível, atraente e intuitiva.

### User Stories e Prototipação

link do figma:
https://www.figma.com/proto/XRtVmx6cYXFqCAnXDwrnau/Tabula-Redonda?node-id=0-1&t=FSuhYp1hLdezC1Qp-1
