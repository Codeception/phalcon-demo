<?php

namespace PhalconDemo\Models;

use Phalcon\Mvc\Model;

/**
 * ProductTypes Model
 *
 * @method static ProductTypes findFirstById(int $id)
 */
class ProductTypes extends Model
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * ProductTypes initializer
     */
    public function initialize()
    {
        $this->hasMany(
            'id',
            __NAMESPACE__ . '\Products',
            'product_types_id',
            [
                'foreignKey' => [
                    'message' => "Product Type cannot be deleted because it's used in Products"
                ]
            ]
        );
    }
}
