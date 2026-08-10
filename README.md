# 📘 Intranet Controle OS — Sistema de Controle de Ordens de Serviço

## 🧠 Visão Geral

O Intranet Controle OS é um sistema web interno completo para controle de ordens de serviço, projetado para ser utilizado em ambientes corporativos ou oficinas técnicas. Sua arquitetura robusta segue o padrão MVC (Model-View-Controller), com regras de negócio sofisticadas, interfaces intuitivas e altos níveis de validação e segurança.

Este documento descreve detalhadamente a estrutura, as tecnologias, os fluxos de acesso e os módulos que compõem o sistema.

---

## 🎯 Objetivos do Projeto

- ✔️ Gerenciar ordens de serviço com eficiência
- ✔️ Controlar e rastrear equipamentos e chamados internos
- ✔️ Separar acessos por nível de permissão
- ✔️ Automatizar validações e promover consistência de dados
- ✔️ Fornecer uma interface amigável para todos os usuários

---

## 🔐 Perfis de Acesso

O sistema contempla três níveis de usuários, cada um com permissões específicas:

| Perfil | Permissões Principais |
|---|---|
| 👑 Administrador | Configurações gerais, gerenciamento de usuários, setores, tipos de equipamentos |
| 👨‍💼 Funcionário | Abertura e acompanhamento de chamados, alocação de equipamentos |
| 🛠️ Técnico | Atendimento de ordens de serviço atribuídas, fechamento e manutenção |

Esta divisão garante segregação de funções e controle de responsabilidades dentro da intranet.

---

## 🧱 Estrutura do Projeto

O repositório contém os seguintes diretórios principais:
├── API/ # Módulos e endpoints de API para comunicação interna via JSON
├── Controle_OS_ADM/ # Interface e lógica para usuários administradores
├── Controle_OS_Funcionario/ # Interface de funcionários, com formulários e listagens
├── Controle_OS_Tecnico/ # Interface específica para técnicos
├── assets/ # Imagens, scripts e outros recursos estáticos
├── css/ # Estilos CSS personalizados
├── data_base/ # Scripts de banco e estrutura do MySQL
├── images/ # Imagens do projeto
└── index.php # Roteador inicial do sistema

---

## 🛠️ Tecnologias Utilizadas

O projeto integra diversas tecnologias modernas para robustez e qualidade:

### 💻 Back-End
- PHP com padrão MVC
- Composer para gerenciamento de dependências e rotas
- Classes VO (Value Objects) e Classes de Funções em PHP tipadas
- Stored Procedures no MySQL para lógica de negócio
- Modelos de dados normalizados e robustos

### 📡 Integração e Dinâmica
- JavaScript / ECMAScript
- AJAX para chamadas assíncronas
- API JSON para comunicação entre front e back
- jQuery para manipulação DOM e eventos

### 🎨 Front-End
- Bootstrap para layout responsivo
- CSS nativo para estilo específico da aplicação

### 📊 Banco de Dados
- MySQL com DER (Diagrama de Entidade-Relacionamento) avançado

---

## 🧩 Funcionalidades Principais

**✨ ⚙️ Gestão Completa de Ordens de Serviço**
- Abertura, visualização, edição e finalização de chamados

**✨ 📦 Cadastro e Gerenciamento de Equipamentos**
- Tipos, modelos e alocação de equipamentos para usuários

**✨ 👤 Cadastro e Controle de Setores e Usuários**
- Inclusão de setores, tipos de usuário e permissões

**✨ 📍 Validações Automatizadas**
- CPF, e-mail e CEP com busca automática via ViaCEP
- Máscaras dinâmicas e validações em tempo real

**✨ 📆 Tratamento de Dados**
- Máscaras intuitivas de formulários
- Validação de campos críticos
- Feedback visual para erros
