# Sistema de Presença com QR Code para Sala de Aula

Uma aplicação web em PHP para gerenciar presença em sala de aula usando QR codes. O sistema possui dois tipos de usuários: professores e alunos.

## Funcionalidades

### Para Professores
- Sistema de login seguro
- Painel de controle com lista de turmas
- Geração de QR code para cada turma
- QR codes com tempo limitado (válido por 5 minutos)

### Para Alunos
- Sistema de login seguro
- Painel com leitor de QR code
- Registro de presença em tempo real
- Leitura de QR code através da câmera

## Requisitos Técnicos

- PHP 7.4 ou superior
- PostgreSQL 12 ou superior
- Servidor web (Apache/Nginx)
- Navegador moderno com suporte a acesso à câmera
- Conexão com internet (para recursos CDN)
- PDO PHP Extension habilitada

## Configuração do Banco de Dados

1. Crie um banco de dados PostgreSQL chamado `attendance_system`
2. Ajuste as configurações de conexão em `config/database.php`:
   - host
   - db_name
   - username
   - password
   - port
3. Execute o arquivo `test_db.php` para verificar a conexão

## Instalação

1. Clone ou baixe este repositório para o diretório do seu servidor web
2. Certifique-se que o servidor web tenha as permissões adequadas para ler/escrever arquivos
3. Configure o banco de dados conforme instruções acima
4. Acesse a aplicação através do seu navegador

## Bibliotecas Utilizadas

- Bootstrap 5.1.3 (Framework UI)
- QRCode.js (Geração de QR Code)
- HTML5-QRCode (Leitura de QR Code)

## Notas de Segurança

Este é um projeto de demonstração e inclui medidas básicas de segurança. Para uso em produção, você deve:

1. Implementar armazenamento adequado em banco de dados para:
   - Contas de usuários
   - Informações das turmas
   - Registros de presença
2. Adicionar autenticação apropriada com hash de senha
3. Implementar proteção CSRF
4. Usar gerenciamento seguro de sessão
5. Adicionar limite de taxa para geração e leitura de QR code
6. Implementar registro adequado de erros
7. Nunca armazenar senhas do banco de dados no código
8. Usar variáveis de ambiente para configurações sensíveis

## Estrutura do Projeto

```
/php_student
├── config/
│   └── database.php    # Configuração do banco de dados
├── index.php           # Ponto de entrada, redireciona para o painel
├── login.php           # Página de login para professores e alunos
├── logout.php          # Gerencia destruição da sessão
├── test_db.php         # Teste de conexão com banco de dados
├── teacher/
│   └── dashboard.php   # Painel do professor com geração de QR
└── student/
    ├── dashboard.php   # Painel do aluno com leitor de QR
    └── record_attendance.php # Gerencia registro de presença
```