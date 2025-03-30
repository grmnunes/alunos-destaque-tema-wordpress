# Tema WordPress - Cadastro de Alunos e Premiações

Este projeto é um tema WordPress desenvolvido para exibir informações sobre escolas públicas e seus alunos premiados em feiras e eventos educacionais. O tema obtém os dados através de uma API e implementa um sistema de cache para otimizar o desempenho e reduzir requisições desnecessárias.

## 🚀 Tecnologias Utilizadas

- **WordPress** (CMS)
- **PHP** (Linguagem principal do tema)
- **REST API** (Integração de dados)
- **Transients** (Cache)
- **Bootstrap** (Estilização do frontend)
- **ACF (Advanced Custom Fields)** (Campos personalizados)

## 📌 Funcionalidades

- Consumo de API para obter dados de escolas, alunos e premiações
- Cache via Transients API para otimizar o carregamento
- Estrutura amigável para SEO e performance
- Personalização via painel administrativo do WordPress

## 📜 Instalação

1. Clone o repositório dentro da pasta de temas do WordPress:
   ```bash
   git clone https://github.com/seu-usuario/seu-repositorio.git wp-content/themes/seu-tema
   ```
2. Ative o tema no painel do WordPress.
3. Configure as opções de API e cache conforme necessário.

## ⚡ Cache e Performance

O tema utiliza a **Transients API** do WordPress para armazenar temporariamente os dados da API e evitar múltiplas requisições desnecessárias. Isso melhora a performance e reduz o tempo de carregamento das páginas.

Exemplo de implementação:
```php
$cached_data = get_transient('api_data_cache');
if (!$cached_data) {
    $response = wp_remote_get('https://api.exemplo.com/premiacoes');
    if (is_wp_error($response)) {
        return;
    }
    $cached_data = wp_remote_retrieve_body($response);
    set_transient('api_data_cache', $cached_data, 2 * HOUR_IN_SECONDS);
}
```

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo `LICENSE` para mais detalhes.

