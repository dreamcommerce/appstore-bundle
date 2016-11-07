DreamCommerceShopAppstore
=========================

Bundle used with DreamCommerce's Symfony applications. More documentation coming soon.

Changelog
---------

``1.4.9``
    - added ``dream_commerce_shop_appstore:webhooks`` to dump configured webhooks
    - fixed FQCN in Doctrine Version detection

``1.4.8``
    - fixed interfaces mapping due to changes in event_listener/event_subscriber

``1.4.7``
    - fixed subscription limiter

``1.4.6``
    - added ``subscriber.(create|delete|edit)`` webhook events support

``1.4.5``
    - fixed ``ParcelDispatchEvent`` webhook

``1.4.4``
    - added support for shops with a valid SSL-chain but disabled in admin panel

``1.4.3``
    - class name fixed

``1.4.2``
    - self-issued certificate support in shop checker

``1.4.1``
    - fixed an issue with redirection loops if shop platform returns an URL with protocol reduction (SSL->no-SSL->SSL)

``1.4.0``
    - narrowed exceptions thrown on invalid bundle configuration supplied
    - webhooks support added

``1.3.3``
    - fixed ``ShopChecker`` URL jumping

``1.3.2``
    - removed version constraint from ``composer.json``

``1.3.1``
    - fixed 301-redirects on install process detection

``1.3.0``
    - added User-Agent configuration entry to distinguish app within access_logs

``1.2.1``
    - added workaround on 301-redirects with shop URL during install process

``1.2.0``
    - refactored URL-generating routines to make them compatible with Symfony 3.0
    - automatic messages errors are now passed-through instead of muting

``1.1.3``
    - added workaround on 301-redirects with shop URL during install process

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