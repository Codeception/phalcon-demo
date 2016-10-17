<?php

namespace PhalconDemo\Models;

use Phalcon\Mvc\Model;

/**
 * Products Model
 *
 * @method static Products findFirstById(int $id)
 */
class Products extends Model
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var integer
     */
    public $product_types_id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $price;

    /**
     * @var string
     */
    public $active;

    /**
     * Products initializer
     */
    public function initialize()
    {
        $this->belongsTo(
            'product_types_id',
            __NAMESPACE__ . '\ProductTypes',
            'id',
            [
                'reusable' => true,
                'alias'    => 'ProductTypes'
            ]
        );
    }

    /**
     * Returns a human representation of 'active'
     *
     * @return string
     */
    public function getActiveDetail()
    {
        return $this->active == 'Y' ? 'Yes' : 'No';
    }
}
