<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://www.ifsertao-pe.edu.br/images/IF_Sertao-PE/Identidade-visual/Marca_CS.png" width="400"></a></p>

<h1> Bolão do IF 2022 - Desenvolvimento web com Laravel</h1>

## Recomendações

Depois de clonar o repositório, você precisa:

- Executar o comando **composer update** ou **composer install** para instalar as dependências.
- Criar um arquivo **.env** a partir do **.env.example** e substituir as credenciais de acordo com o seu banco de dados.
- Gerar uma chave pro projeto através do comando **php artisan key:generate**.
- Depois de criar o banco de dados no phpmyadmin (ou qualquer gerenciador) executar o comando **php artisan migrate** na raiz do projeto para gerar as tabelas no seu bando de dados (configurar as credenciais antes no passo de criação do arquivo **.env**).
