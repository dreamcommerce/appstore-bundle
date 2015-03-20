# appstore-bundle

## configuration

`app/config/routing.yml`:

```yaml
dreamcommerce:
    resource: "@DreamCommerceShopAppstoreBundle/Resources/config/routing.yml"
    prefix:   /responder

your_app:
    resource: "@YourAppBundle/Resources/config/routing.yml"
    prefix:   /your_app
```

`app/config.yml`:

```yaml
dream_commerce_shop_appstore:
    applications:
        your_app:
            app_id:             "abcabcabcabc"
            app_secret:         "abcabcabacba"
            appstore_secret:    "abcbabcaba"
```