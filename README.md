<h3 align="center">Validate-Trait for Laravel</h3>

## 🧐 Sobre <a name = "about"></a>

Este pacote foi criado para que a logica do request possa ser chamado automaticamente de quadentro do service Pattern.

Ele tambem faz o bind do request padrão, aquele que normalmente possui o mesmo caminho do service incluindo o mesmo nome quando necessario.

Com isso, voce diminui a repetição de código quando for algum padrão, sem que seja engessado tambem.
Sempre que possivel ele sera atualizado, e esta aberto para a comunidade sugerir melhorias.

## 🏁 Para utilizar o pack

Para utilizar a classe, basta instalar ela utilizando o comando do composer:

```
composer require quantumtecnology/validate-trait
```

e chamar ela dentro de um service.

Pronto, ja é para estar funcionando.

## 🎈 Recursos

Nele existem algumas ferramentas uteis.

- Validate Trait:
  - Faz o bind automatico do request cujo caminho e nome sejam os mesmo do service.
  - Chama a classe de request passada, ou caso tenha utilizado o bind automatico.

## 🧐 Outras Bibliotecas

- [Enum-Basics-Extension](https://packagist.org/packages/quantumtecnology/enum-basics-extension) - Utilizado para auxiliar nas Classes de Enums;
- [SetSchema-Trait](https://packagist.org/packages/quantumtecnology/setschema-trait-postgresql) - Suprir a necessidade de setar os schemas automaticamente do PostgreSQL;
- [PerPage-Trait](https://packagist.org/packages/quantumtecnology/perpage-trait) - Padronizar a quantidade do paginate na api inteira e definir uma quantidade máxima;
- [Handler-Basics-Extension](https://packagist.org/packages/quantumtecnology/handler-basics-extension) - Contem tratamento das principais exceções do laravel, e contem varios responses para lhe auxiliar;

## ⛏️ Ferramentas

- [php](https://www.php.net/) - linguagem

## ✍️ Autor

- [@Luis Gustavo Santarosa Pinto](https://github.com/QuantumTecnology) - Idea & Initial work
