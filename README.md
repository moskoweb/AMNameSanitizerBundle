# Mautic Name Sanitizer

### Requisitos

- Mautic v2.15 ou superior;
- PHP v7.0 ou superior.

### Instalação

```sh
$ cd plugins

$ git clone https://github.com/moskoweb/AMNameSanitizerBundle.git
```

Limpe o cache rodando o seguinte comando na pasta raíz do seu Mautic:

```sh
$ php app/console cache:clear && chmod -R g+rw * && php app/console mautic:assets:generate
```
Acessea página de plugins pelo painel do Mautic e clique no botão **Instalar/Atualizar plugins**. 

### Ativação e uso

Procure na listagem de plugins por “Name Sanitizer”, clique nele e depois clique em Sim abaixo de publicado. Salve as alterações e feche.

Após isso, será possível rodar o seguinte comando na na pasta raíz do seu Mautic:

```sh
$ php app/console mautic:sanitize-names
```

Quando executado, o plugin irá pegar todos os nomes de contatos cadastrados no mautic e corrigi-los caso necessário. Após, ele irá retornar o número total de contatos que foram alterados.

Além do comando, também será adicionado um botão chamado “Limpar nomes” na tela da listagem de contatos. Ao clicar nele, o comando será executado em background e retornará uma notificação com a quantidade total de contatos alterados.

Nas configurações do plugin há a opção de limpar o nome na inserção do contato. Se marcada como sim, o nome do contato será limpo no momento em que for inserido (seja inserção manual, via formulário ou por importação).
