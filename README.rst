DreamCommerceShopAppstore
=========================

Bundle used with DreamCommerce's Symfony applications. More documentation coming soon.

Changelog
---------

``1.0.0``
    - using client library 1.x - needed to increase first number due to the exceptions API changed
    - improved library exception handling - now any uncaught library exception is being handled with data used for request, even in production
    - added ``dream_commerce_shop_appstore:log_view`` command - allows to see library log errors formatted with new lines
    - rebuilt internals - now services classes are specified by parameters; creating inherited bundles are easier
    - removed calls marked as deprecated in Symfony 2.8
    - fixed incorrect ``RequestStack`` handling in Symfony 2.8
    - added option ``skip_ssl`` to ignore SSL errors
    - improved related resource fetching - added redundant values removal
    - added method which helps to partition query_string arguments

``0.1.4``
    - fixed token refreshing issues

``0.1.3``
    - repo maintenance commit

``0.1.2``
    - fixed missing ``ui.html.twig``

``0.1``
    - first Packagist release