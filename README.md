# Math Shipping Calculator on Product Page

Display a shipping calculator to your customer on the WooCommerce product page using any delivery method.
*[Leia em Português](README.pt.md)

## Usage

If you're using a Storefront child theme, the calculator will appear before the buy button, if not, add the hook to the code:

```bash
<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
```

In this case of the custom theme, pay attention to have on the page an element with the class 'qty' containing the quantity value and another element with the name 'add-to-cart' or 'variation_id' containing the product/variation code respectively.