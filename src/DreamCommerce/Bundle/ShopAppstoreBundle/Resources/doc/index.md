## Installation

1. Download DreamCommerceShopAppstoreBundle using composer
2. Enable the Bundle
3. Create your Billing, Shop, Subscription, Token class
4. Configure your application's security.yml
5. Configure the DreamCommerceShopAppstoreBundle
6. Import DreamCommerceShopAppstoreBundle routing
7. Update your database schema

### Step 1: Download DreamCommerceShopAppstoreBundle using composer

Add DreamCommerceShopAppstoreBundle by running the command:

``` bash
$ php composer.phar require dreamcommerce/appstore-bundle "0.1@dev"
```

Composer will install the bundle to your project's `vendor/dreamcommerce` directory.

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new \DreamCommerce\Bundle\ShopAppstoreBundle\DreamCommerceShopAppstoreBundle()
    );
}
```

### Step 3: Create your Billing, Shop, Subscription, Token class

##### xml

If you use xml to configure Doctrine you must add two types of file. The Entity and the orm.xml:

Billing
-------

```php
<?php
// src/Acme/UserBundle/Entity/Billing.php

namespace Acme\UserBundle\Entity;

use DreamCommerce\Component\ShopAppstore\Model\Billing as BaseBilling;

/**
 * Billing
 */
class Billing extends BaseBilling
{
    protected $id;

    public function getId(){
        return $this->id;
    }
}
```
```xml
<?xml version="1.0" encoding="utf-8"?>
<!-- src/Acme/UserBundle/Resources/config/doctrine/Billing.orm.xml -->
<doctrine-mapping xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping http://doctrine-project.org/schemas/orm/doctrine-mapping.xsd">

    <entity name="Acme\UserBundle\Entity\Billing" table="billings">
        <indexes>
            <index name="shop_id" columns="shop_id"/>
        </indexes>
        <id name="id" type="integer" column="id">
            <generator strategy="IDENTITY"/>
        </id>
        <one-to-one field="shop" target-entity="DreamCommerce\Component\ShopAppstore\Model\ShopInterface" inversed-by="billing">
            <join-columns>
                <join-column name="shop_id" referenced-column-name="id"/>
            </join-columns>
        </one-to-one>
    </entity>
</doctrine-mapping>
```

Shop
----

```php
<?php
// src/Acme/UserBundle/Entity/Shop.php

namespace Acme\UserBundle\Entity;

use DreamCommerce\Component\ShopAppstore\Model\Shop as BaseShop;

/**
 * Shop
 */
class Shop extends BaseShop
{
    protected $id;

    public function getId(){
        return $this->id;
    }
}
```
```xml
<?xml version="1.0" encoding="utf-8"?>
<!-- src/Acme/UserBundle/Resources/config/doctrine/Shop.orm.xml -->
<doctrine-mapping xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping http://doctrine-project.org/schemas/orm/doctrine-mapping.xsd">

    <entity name="Acme\UserBundle\Entity\Shop" table="shops">
        <indexes>
            <index name="shop" columns="name"/>
        </indexes>
        <id name="id" type="integer" column="id">
            <generator strategy="IDENTITY"/>
        </id>

        <one-to-one field="token" target-entity="DreamCommerce\Component\ShopAppstore\Model\TokenInterface" mapped-by="shop" inversed-by="token">
        </one-to-one>

        <one-to-one target-entity="DreamCommerce\Component\ShopAppstore\Model\BillingInterface" mapped-by="shop" field="billing" inversed-by="billing">
        </one-to-one>

        <one-to-many target-entity="DreamCommerce\Component\ShopAppstore\Model\SubscriptionInterface" mapped-by="shop" field="subscriptions">
            <order-by>
                <order-by-field name="expiresAt"/>
            </order-by>
        </one-to-many>
    </entity>
</doctrine-mapping>
```

Subscription
------------

```php
<?php
// src/Acme/UserBundle/Entity/Subscription.php

namespace Acme\UserBundle\Entity;

use DreamCommerce\Component\ShopAppstore\Model\Subscription as BaseSubscription;

/**
 * Subscription
 */
class Subscription extends BaseSubscription
{
    protected $id;

    public function getId(){
        return $this->id;
    }
}
```
```xml
<?xml version="1.0" encoding="utf-8"?>
<!-- src/Acme/UserBundle/Resources/config/doctrine/Subscription.orm.xml -->
<doctrine-mapping xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping http://doctrine-project.org/schemas/orm/doctrine-mapping.xsd">

    <entity name="Acme\UserBundle\Entity\Subscription" table="subscriptions">
        <indexes>
            <index name="shop_id" columns="shop_id"/>
        </indexes>
        <id name="id" type="integer" column="id">
            <generator strategy="IDENTITY"/>
        </id>
        <many-to-one field="shop" target-entity="DreamCommerce\Component\ShopAppstore\Model\ShopInterface" inversed-by="subscriptions">
            <join-columns>
                <join-column name="shop_id" referenced-column-name="id"/>
            </join-columns>
        </many-to-one>
    </entity>
</doctrine-mapping>
```

Token
-----

```php
<?php
// src/Acme/UserBundle/Entity/Token.php

namespace Acme\UserBundle\Entity;

use DreamCommerce\Component\ShopAppstore\Model\Token as BaseToken;

/**
 * Token
 */
class Token extends BaseToken
{
    protected $id;

    public function getId(){
        return $this->id;
    }
}
```
```xml
<?xml version="1.0" encoding="utf-8"?>
<!-- src/Acme/UserBundle/Resources/config/doctrine/Token.orm.xml -->
<doctrine-mapping xmlns="http://doctrine-project.org/schemas/orm/doctrine-mapping"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://doctrine-project.org/schemas/orm/doctrine-mapping http://doctrine-project.org/schemas/orm/doctrine-mapping.xsd">

    <entity name="Acme\UserBundle\Entity\Token" table="tokens">
        <indexes>
            <index name="shop_id" columns="shop_id"/>
        </indexes>
        <id name="id" type="integer" column="id">
            <generator strategy="IDENTITY"/>
        </id>
        <one-to-one field="shop" target-entity="DreamCommerce\Component\ShopAppstore\Model\ShopInterface" inversed-by="token">
            <join-columns>
                <join-column name="shop_id" referenced-column-name="id"/>
            </join-columns>
        </one-to-one>
    </entity>
</doctrine-mapping>
```

### Step 4: Configure your application's security.yml

TODO

### Step 5: Configure the DreamCommerceShopAppstoreBundle

Now that you have properly configured your application's `security.yml` to work
with the DreamCommerceShopAppstoreBundle, the next step is to configure the bundle to work with
the specific needs of your application.

Add the following configuration to your `config.yml` file according to which type
of datastore you are using.

``` yaml
# app/config/config.yml
dream_commerce_shop_appstore:
    applications:
        acme:
            app_id: "..."
            app_secret: "..."
            appstore_secret: "..."
```

### Step 6: Import DreamCommerceShopAppstoreBundle routing files

`app/config/routing.yml`:

```yaml
dreamcommerce:
    resource: "@DreamCommerceShopAppstoreBundle/Resources/config/routing.yml"
    prefix:   /appstore

acme:
    resource: "@AcmeUserBundle/Resources/config/routing.yml"
    prefix:   /acme
```

### Step 7: Update your database schema

Now that the bundle is configured, the last thing you need to do is update your
database schema because you have added a new entities, the `Billing`, `Shop`, `Subscription`, `Token` class which you
created in Step 4.

For ORM run the following command.

``` bash
$ php app/console doctrine:schema:update --force
```