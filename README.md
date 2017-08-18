# sei-soap-proxy-app

O [WebService do SEI](https://softwarepublico.gov.br/social/articles/0004/7172/SEI-WebServices-v3.0.pdf) foi implementado em PHP utilizando o protocolo SOAP e possui alguns problemas quando consumido a partir de clientes de outras linguagens (como Ruby, Python, etc), funcionando completamente somente a partir do cliente SOAP do PHP. Portanto, esta mini-aplicação PHP foi criada para universalizar a comunicação com o SEI utilizando JSON.

Esta aplicação funciona como um intermediador da comunicação com o WebService SOAP do SEI, onde recebe uma requisição HTTP com os dados do serviço do SEI em JSON, chama o WebService do SEI via cliente SOAP PHP e devolve os dados em JSON (e não XML!!).

## Rodando a aplicação

Esta aplicação foi implementada utilizando o micro-framework PHP Lumen, portanto é necessário ter o PHP 5.6 instalado.

- Instale o [Composer](https://getcomposer.org/download/);
- Instale as dependências do projeto;
  - `$ composer install`
- Renomeie o arquivo `.env.example` para `.env` e defina o valor de `SEI_WS_URL` como a URL do WebService do SEI que será consumida (confira no manual do SEI o padrão da URL).
- Para própositos de testes locais, rode o servidor do PHP
  - `php -S localhost:8000 -t public`
- Pronto, sua aplicação estará rodando em localhost:8000/

## Utilização

A aplicação conta apenas com uma rota para chamar os serviços. Para requisitar um serviço do WebService do SEI, basta uma requisição POST para a rota `/seiws` com o seguinte payload:

- `service` - Nome do serviço do SEI;
- `data` - Parâmetros do serviço.

Os dados dos serviços podem ser obtidos no [manual do SEI](https://softwarepublico.gov.br/social/articles/0004/7172/SEI-WebServices-v3.0.pdf).

### Exemplo

Para consultar os dados de um procedimento do SEI, a estrutura do payload da requisição POST seria a seguinte:
```json
{
    "service": "consultarProcedimento",
    "data": {
        "SiglaSistema": "SIGLA DO SISTEMA CRIADO NO SEI",
        "IdentificacaoServico": "NOME DO SERVIÇO CRIADO NO SEI",
        "IdUnidade": "ID DA UNIDADE",
        "ProtocoloProcedimento": "NUMERO DO PROTOCOLO DO PROCEDIMENTO",
        "SinRetornarAndamentoGeracao": "S",
        "SinRetornarAssuntos":  "N",
        "SinRetornarInteressados":  "N",
        "SinRetornarObservacoes":  "N",
        "SinRetornarAndamentoConclusao":  "N",
        "SinRetornarUltimoAndamento":  "N",
        "SinRetornarUnidadesProcedimentoAberto":  "N",
        "SinRetornarProcedimentosRelacionados": "N",
        "SinRetornarProcedimentosAnexados": "N"
    }
}
```
