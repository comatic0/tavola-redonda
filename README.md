# Távola Redonda - Gerenciamento de Mesas de RPG

## Instruções Básicas

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
3. **Inicie o Servidor:**
   - Se estiver usando o XAMPP (que atualmente é utilizado pelos desenvolvedores), mova a pasta do projeto para o diretório `htdocs`.
   - Acesse `http://localhost/tavola-redonda` no seu navegador.
