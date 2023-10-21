<h3 align="center">Validate-Trait for Laravel</h3>

## 🧐 Sobre <a name = "about"></a>

Este pacote foi criado por conta da deficiencia em que o laravel tem de trabalhar com schemas do postgresql.
Ao utilizar a trait na model, ele automaticamente, identifica o schema ao qual a model pertence, se baseando na pasta ao qual
a model se encontra, por exemplo:

```
Models/People/userModel
```
Schema: People
Table: Users


Com isso, voce remove a necessidade de ficar colocando o table na model manualmente.
Sempre que possivel ele sera atualizado, e esta aberto para a comunidade sugerir melhorias.

## 🏁 Para utilizar o pack

Para utilizar a classe, basta instalar ela utilizando o comando do composer:

```
composer require gustavosantarosa/setschema-trait-postgresql
```

e chamar ela dentro de uma model.

Pronto, ja é para estar funcionando.

## 🎈 Utilizando

Nele existem algumas ferramentas uteis.

- BaseEnum:
  - Popula a variavel table, com o schema automaticamente.

## ⛏️ Utilizado

- [php](https://www.php.net/) - linguagem

## ✍️ Autor

- [@Luis Gustavo Santarosa Pinto](https://github.com/GustavoSantarosa) - Idea & Initial work
