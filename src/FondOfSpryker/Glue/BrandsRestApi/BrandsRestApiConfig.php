<?php

namespace FondOfSpryker\Glue\BrandsRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class BrandsRestApiConfig extends AbstractBundleConfig
{
    public const RESOURCE_BRANDS = 'brands';

    public const CONTROLLER_BRANDS = 'brands-resource';

    public const ACTION_BRANDS_GET = 'get';

    public const RESPONSE_CODE_UUID_MISSING = '800';
    public const RESPONSE_DETAILS_UUID_MISSING = 'External reference is missing.';

    public const RESPONSE_CODE_BRAND_NOT_FOUND = '801';
    public const RESPONSE_DETAILS_BRAND_NOT_FOUND = 'Brand not found.';
}
