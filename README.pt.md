# Math Shipping Calculator on Product Page

Exiba uma calculadora de envio para o seu cliente na página do produto do WooCommerce usando qualquer método de entrega.
*[Read in English](README.md)

## Usage

Se você está usando um tema filho do Storefront, a calculadora irá aparecer antes do botão comprar, caso não estiver, adicione a hook ao código:

```bash
<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
```

Nesse caso do tema personalizado, atente-se para ter na página um elemento com a classe 'qty' contendo o valor da quantidade e outro elemento com o nome 'add-to-cart' ou 'variation_id' contendo o código do produto/variação respectivamente.