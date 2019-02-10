<?php
/**
 * Created by PhpStorm.
 * User: Sile
 * Date: 2/10/2019
 * Time: 7:20 PM
 */

namespace App\Traits;


use App\Models\Product;
use Artesaos\SEOTools\Traits\SEOTools;
use TCG\Voyager\Models\Setting;

trait SEO
{
    use SEOTools;

    /**
     * Default SEO optimization for other pages
     *
     * @param $pageTitle
     */
    public function seoDefault($pageTitle)
    {
        $this->seo()->metatags()
            ->setTitle($pageTitle)
            ->setDescription(setting('site.description'))
            ->setCanonical(url()->current())
            ->setKeywords(setting('site.description'))
            ->addMeta('author', 'sinisa.buncic7@gmail.com');

        $this->seo()->opengraph()
            ->setTitle($pageTitle)
            ->setDescription(setting('site.description'))
            ->setUrl(url()->current())
            ->setSiteName('Electro ecommerce')
            ->addImage(setting('site.logo'))
            ->addProperty('locale', app()->getLocale())
            ->setType('articles');
    }

    /**
     * SEO optimization for home page
     */
    public function seoHome()
    {
        $this->seoDefault('Home');
    }

    /**
     * SEO optimization for product page
     *
     * @param Product $product
     */
    public function seoProduct(Product $product)
    {
        $this->seo()->metatags()
            ->setTitle($product->get('name'))
            ->setDescription($product->get('description'))
            ->setCanonical($product->getUrl())
            //->setKeywords(getSettings()->keywords)
            ->addMeta('author', 'sinisa.buncic7@gmail.com');

        $this->seo()->opengraph()
            ->setTitle($product->get('name'))
            ->setDescription($product->get('description'))
            ->setUrl($product->getUrl())
            ->addImage(asset($product->image))
            ->setSiteName('Electro ecommerce')
            ->addProperty('locale', app()->getLocale())
            ->setType('articles');
    }
}