
# 📊 Sistema de Visualização de Dados do Raio-X da Administração Pública Federal


Projeto desenvolvido para a disciplina **Programação para Internet II**, com o objetivo de explorar o ciclo completo de desenvolvimento Web, desde a obtenção de dados públicos até sua visualização interativa no navegador.

---

## 🎯 Objetivo do Projeto

Criar uma aplicação web que permite:

- 🔄 Processar e exibir dados do [Painel Raio-X da Administração Pública Federal](https://dados.gov.br/dados/conjuntos-dados/raio-x-da-administracao-publica-federal)
- 📈 Utilizar bibliotecas de visualização como **D3.js** para apresentar os dados dinamicamente
- 🧾 Armazenar o histórico de consultas dos usuários em um banco relacional
- 👤 Permitir que o usuário consulte e remova buscas anteriores

---

## 🧰 Tecnologias Utilizadas

- **PHP** – Backend responsável por carregar, processar e servir os dados
- **JavaScript / D3.js** – Geração dos gráficos interativos (Zoomable Sunburst, etc.)
- **JSON / CSV** – Formatos utilizados na entrada e transformação dos dados
- **HTML5 e CSS3** – Construção da interface visual
- **PostgreSQL ou SQLite** – Armazenamento do histórico de buscas (via `historico.php`)

---

## 🖥️ Estrutura do Projeto

- `index.php` – Página principal de interação do usuário
- `getJSONFile.php` – API intermediária para carregamento dos dados
- `historico.php` – Página de visualização e remoção de consultas anteriores
- `arrayCustAdm.json`, `custeio_adm.csv` – Fontes de dados processadas
- `af72c7d68ff017ab@377.js` – Notebook exportado do ObservableHQ para visualização D3.js

---

## 📦 Requisitos Funcionais

- Coleta e tratamento de dados externos (JSON/CSV)
- Visualização interativa usando D3.js
- Armazenamento e manipulação de histórico de buscas
- Facilidade de uso por parte do usuário final

---

## 📊 Sobre a Visualização "Zoomable Sunburst"

https://observablehq.com/d/af72c7d68ff017ab@377

Visualize este notebook no seu navegador executando um servidor web nesta pasta. Por exemplo:

~~~sh
npx http-server
~~~

Ou, use o [Observable Runtime](https://github.com/observablehq/runtime) para importar este módulo diretamente para sua aplicação. Para instalar via npm:

~~~sh
npm install @observablehq/runtime@5
npm install https://api.observablehq.com/d/af72c7d68ff017ab@377.tgz?v=3
~~~

Depois, importe seu notebook e o runtime assim:

~~~js
import {Runtime, Inspector} from "@observablehq/runtime";
import define from "af72c7d68ff017ab";
~~~

Para registrar no console o valor da célula chamada “foo”:

~~~js
const runtime = new Runtime();
const main = runtime.module(define);
main.value("foo").then(value => console.log(value));
~~~
---

## 👤 Desenvolvedores

Projeto realizado por:

- **Gil Antony Borba Veloso Araújo Oliveira e Ézio Enrique Fiúza Ribeiro**


---

## 📄 Licença

Distribuído sob a licença [MIT](./LICENSE.txt)

---

