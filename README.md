# Sculpin Category List Bundle

3rd party Sculpin Bundle that creates category list

## Setup

```
composer require sunadarake/sculpin-category-list-bundle
```
In your `app/SculpinKernel.php`

```php
<?php

use Sculpin\Bundle\SculpinBundle\HttpKernel\AbstractKernel;
use Darake\SculpinCategoryListBundle;

class SculpinKernel extends AbstractKernel
{
    protected function getAdditionalSculpinBundles(): array
    {
        return [
            SculpinCategoryListBundle::class,
        ];
    }
}
```

## How to use

If you have configured taxonomy in `app/config/sculpin_kernel.yml` , you write the following in template file.

```
<h2>category list</h2>
<ul>
    {% for cat in site.categories_list %}
        <li>{{ cat.name }} {{ cat.count }}</li>
    {% endfor %}
</ul>
```

or

```
<h2>tag list</h2>
<ul>
    {% for tag in site.tags_list %}
        <li>{{ tag.name }} {{ tag.count }}</li>
    {% endfor %}
</ul>
```