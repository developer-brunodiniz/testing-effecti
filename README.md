## Sobre o projeto:

O projeto foi criado em vue.js utilizando laravel para gerenciamento da api com o banco de dados postgres. O foco são as licitações e seu gerenciamento, no projeto você tem a possibilidade de cadastrar, atualizar, deletar e listar as licitações, modalidades, empresas e status.

#### **Stacks tecnológicas:**

|  Stack   |  Versão  |
| :------: | :------: |
|  NodeJS  | v18.16.0 |
|   Npm    |  v9.5.1  |
|  VueJS   |  v3.2.0  |
| Laravel  |  v10.10  |
| Postgres |  v15.3   |
|  Mysql   |   v8.0   |

---

## Iniciar o Docker

Se o seu docker não está configurado para utilizar sem o sudo, adicione no ínicio do comando.

```bash
docker-compose up -d
```

ou

```bash
docker-compose up -d --build --remove-orphans --force-recreate
```

ou

```bash
docker-compose up -d --build
```

Após iniciar o docker, faça a cópia do arquivo **.env.example** para **.env** e preencha as informações do banco corretamente, elas existem no **docker-compose.yml** efetue o comando abaixo para instalar as dependências:

```bash
composer install
```

---

### **Status:**

Os status tem o objetivo de informar ao registro se ele está inativo, excluído ou ativo, temos também a possibilidade de adicionar mais status para controle como invisível e visível.

Ao deletar um registro ele não é removido da base por questões de segurança e perca de dados, ele tem apenas o status alterado.

### **Empresas:**

As empresas são necessárias para a criação da licitação, não tem validação de dados **(Exceto: e-mail)** então é possível adicionar dados fictícios, porém em um projeto em produção é inviável a adição de validações.

### **Modalidades:**

As modalidades são necessárias para a criação das licitações, os dados que já existem foram recuperados do site da effecti.

### **Licitações:**

As licitações são a base do projeto, ele existe para o gerenciamento delas. Para solicitar uma licitação é necessário informar a empresa, a modalidade e descrever qual a sua licitação.

---

## **Base de dados - Docker**

Na configuração do docker, adicionei dois gerenciadores de dados, mysql e postgres, isso em uma situação de produção é importante para termos backup, porém temos outras formas e essa configuração não é obrigatória. Caso tenha algum problema para executar os dados ou o migrate com o postgres fique a vontade para atualizar o .env do projeto e utilizar o mysql.

Ao subir a configuração do ambiente, utilize os comandos abaixo na ordem para atualizar a base de dados:

```bash
docker container exec -it php bash
```

```bash
php artisan migrate
```

```bash
php artisan db:seed
```

### Após as configurações acima você pode acessar o sistema pela URL **127.0.0.1:8080**, a URL da API é **127.0.0.1:8089/api/v1**

---

## Parar e remover o docker

É preciso muito cuidado ao executar os comandos abaixo, pois se você tiver mais container em sua máquina, eles serão parados e removidos.

```bash
docker stop $(docker ps -a -q)
docker rm $(docker ps -a -q)
docker rmi $(docker images -q) -f
```

---

**OBS: Temos algumas possibilidades de melhorias, como, separação de componentes para reutilização, utilização de props para passar valor entre os componentes e a documentação da api utilizando o swagger.**
