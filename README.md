# awesowel

1. Criar projeto Laravel com composer (~: composer create-project laravel/laravel [nome] "5.1.*")

2. Adicionar o trecho abaixo em config/app.php ['providers']
```
/*
 * Awesovel Service Provider
 */
//Awesovel\Providers\AwesovelServiceProvider::class,
```

3. Adicionar "Awesovel\/": "vendor/awesovel/src" to composer.json."autoload"."psr-4"

4. Atualizar o autoload do projeto com o composer (~: composer dump-autoload)

5. Alterar o nome da Aplicação (~: php artisan app:name [nome]) para não conflitar com o nome do vendor Awesowel, ou seja, as classes em Src vão usar o "namespace" padrão e as classes do core padrão irão usar o "namespace" Awesowel

