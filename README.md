
## Configurando ambiente

Sistema de Help Desk desenvolvido com Laravel 8 + Mysql + Nginx


#### Baixar projeto

1 - Clone

```sh
git clone https://github.com/RodrigoMagalhaes012/app-help-desk.git
```

2 - Acesso

```sh
cd app-help-desk
```

Para a inicialização rapida do projeto foi utilizado Docker.

O primeiro passo será instalar o docker

1 - Habilite o WSL no Windows

```sh
dism.exe /online /enable-feature /featurename:Microsoft-Windows-Subsystem-Linux /all /norestart
```
```sh
dism.exe /online /enable-feature /featurename:VirtualMachinePlatform /all /norestart
```

2 - Habilitar WSLW2

```sh
wsl --set-default-version 2
```

3 - Instalar o Ubuntu na Microsoft Store:

4 - Desabilitar o Hyper-v

5 - Criar o arquivo .wslconfig em "C:\Users\<seu_usuario>"

```sh
[wsl2]
memory=8GB
processors=4
swap=2GB
```

6 - Certififique se possui o docker instalado, caso não tenha pode ser instalado por esse link:

```sh
https://www.docker.com/get-started/
```

6 - Dentro da pasta do projeto execute o comando para subir o container do projeto

```sh
 docker-compose up --build -d
```


## Configuração projeto

1 - Instalando dependências
```sh
composer install
```
2 - Configurando variávis 
```sh
cp .env.example .env
```
```sh
php artisan key:generate
```
3 - Criando tabelas e seeders
```sh
php artisan migrate --seed
```

## Acesso ao projeto

1 - Endereço de acesso
```sh
http://localhost:8989/
```

2 - Usuário Administrador
```sh
Email: absx.suporte@mailinator.com
```
```sh
Senha:12345678
```
Existem varios usuários criados com diferentes perfis ('adm', 'agent', 'client') todos com a mesma senha: 12345678
```sh
absx.suporte@mailinator.com  (ADM)
felipe.absx@mailinator.com (AGENT)
marcos.absx@mailinator.com (AGENT)
joao.absx@mailinator.com (AGENT)
rodrigom.21amorim@gmail.com (CLIENT)
```


