# Documentação da API de Cadastro de Usuários

## Descrição
API simples para cadastro e exclusão de usuários, desenvolvida em PHP para atividade do curso de sistemas.

---

## Endpoints

### POST /api.php
Cadastra um novo usuário no sistema.

**Campos obrigatórios:**
```json
{
    "nome": "Nome Completo",
    "email": "email@valido.com",
    "senha": "#Senha123",
    "telefone": "12345678900",
    "endereco": "Rua Exemplo, 123",
    "nascimento": "2000-01-01"
}
```

**Campos opcionais:**
- `estado` (padrão: "MG")

**Regras de validação:**
- Telefone deve ter 11 caracteres ou mais
- E-mail deve ser válido
- Senha forte: mínimo 8 caracteres, 1 maiúscula, 1 minúscula, 1 número e 1 caractere especial (@$!%?&#)

**Resposta de sucesso:**
```json
{
    "mensagem": "Tudo certo! Cliente cadastrado.",
    "cliente": { ...dados do usuário... }
}
```

---

```markdown
## Possíveis Erros e Respostas

### Endpoint POST /api.php

**400 Bad Request:**
- "E-mail inválido."
- "Senha inválida ou não fornecida. Revise!"
- "O telefone tem menos de 11 caracteres."
- "Todos os campos são obrigatórios!"
- "Erro ao cadastrar: [mensagem do banco de dados]"

**405 Method Not Allowed:**
- "Método não permitido. Use POST."

### Endpoint DELETE /excluir.php

**400 Bad Request:**
- "E-mail do usuário não fornecido."
- "Erro ao excluir: [mensagem do banco de dados]"

**404 Not Found:**
- "Usuário não encontrado."

**405 Method Not Allowed:**
- "Método não permitido. Use DELETE."
```

### DELETE /excluir.php
Remove um usuário do sistema.

**Campo obrigatório:**
```json
{
    "email": "email@valido.com"
}
```

**Respostas possíveis:**
- 200: Usuário excluído com sucesso
- 404: Usuário não encontrado
- 400: Erro na requisição

---

## Estrutura do Banco

**Tabela:** `api_usuarios`

| Campo | Tipo | Descrição |
|-------|------|-----------|
| id | CHAR(36) | ID único do usuário |
| nome | VARCHAR(100) | Nome completo |
| email | VARCHAR(150) | E-mail (único) |
| senha | VARCHAR(255) | Senha criptografada |
| telefone | VARCHAR(200) | Número de telefone |
| endereco | VARCHAR(100) | Endereço completo |
| estado | CHAR(2) | Estado (UF) |
| data_nascimento | DATE | Data de nascimento |
| criacao | TIMESTAMP | Data de criação |

---

## Configuração

1. Banco de dados: MySQL
2. Arquivo de configuração: conexao.php
3. Validação de senha: senhaSegura.php
4. Script SQL: sql.sql (criação do banco e tabela)

---

## Exemplos de Uso

### Cadastrar usuário:
```http
POST http://localhost/atv2/api.php
Content-Type: application/json

{
    "nome": "João Silva",
    "email": "joao@email.com",
    "senha": "#Senha123",
    "telefone": "31999999999",
    "endereco": "Rua das Flores, 100",
    "nascimento": "1990-05-15",
    "estado": "MG"
}
```

### Excluir usuário:
```http
DELETE http://localhost/atv2/excluir.php
Content-Type: application/json

{
    "email": "joao@email.com"
}
```

---

## Observações

- A API retorna respostas em formato JSON
- Códigos HTTP indicam o status da operação
- Todos os campos são validados antes do processamento
- As senhas são armazenadas de forma segura (hash)