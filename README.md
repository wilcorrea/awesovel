# awesovel

1- Criar projeto Laravel com composer 
```
~: composer create-project laravel/laravel [nome] "5.1.*"
```
2- Clonar o Awesovel para dentro da pasta vendor
```
~: cd [nome]/vendor
~/[nome]/vendor: git clone https://github.com/wilcorrea/awesovel.git awesovel
```
3- Adicionar autoload ao "composer.json"
```
  (...)
  , "autoload": {
    (...)
    , "psr-4": {
      "...": "app/"
      , "Awesovel\\": "vendor/awesovel/src"
    }
  },
  (...)
```
4- Atualizar o autoload do projeto com o composer
```
~/[nome]: composer dump-autoload
```
5- Adicionar o trecho abaixo em "config/app.php"['providers']
```
(...)
    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        (...)
        /**
         * Awesovel Service Provider
         */
        Awesovel\Providers\AwesovelServiceProvider::class
        (...)
    ],
```
6- Copie o arquivo "config/awesovel.php" para a pasta config do seu projeto
```
~/[nome]: cp vendor/awesovel/config/awesovel.php config/awesovel.php
```
7- Copie a vasta de views para o diretório resouces do seu projeto
```
~/[nome]: cp -rf vendor/awesovel/views/awesovel/ resources/views/awesovel
```
8- Alterar o nome da Aplicação para não conflitar com o nome do vendor Awesowel, ou seja, as classes em Src vão usar o "namespace" padrão e as classes do core padrão irão usar o "namespace" Awesowel
```
~: php artisan app:name [nome]
```

