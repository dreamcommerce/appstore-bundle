DreamCommerceShopAppstore
=========================

Bundle used with DreamCommerce's Symfony applications. More documentation coming soon.

Changelog
---------

``1.2.0``
    - refactored URL-generating routines to make them compatible with Symfony 3.0
    - automatic messages errors are now passed-through instead of muting

``1.1.2``
    - fixed token refresh on application update
    - fixed incorrect exception catching on appstore exception

``1.1.1``
    - security: added ``<meta name="referrer" content="origin">`` to the main layout file

``1.1.0``
    - added ``dream_commerce_shop_appstore:refresh_tokens`` command that can be executed periodically in order to automatically extend shop tokens validity
    - added ``ShopChecker`` with method ``verifySsl`` to verify if specified shop has a SSL stack set up correctly
    - added ``minimal_version`` param to ``Application`` services

``1.0.1``
    - CollectionChoiceListLoader deprecated dependencies removed

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
    - added ``ParamConverter`` support in ``ApplicationControllerInterface``-aware controllers - for ``ShopInterface`` and ``ClientInterface`` arguments

``0.1.4``
    - fixed token refreshing issues

``0.1.3``
    - repo maintenance commit

``0.1.2``
    - fixed missing ``ui.html.twig``

``0.1``
    - first Packagist release