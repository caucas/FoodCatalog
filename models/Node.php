<?php namespace Macrobit\FoodCatalog\Models;

use Model;

/**
 * Node Model
 */
class Node extends Model
{
    use \October\Rain\Database\Traits\NestedTree;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'macrobit_foodcatalog_nodes';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
        'firm' => ['Macrobit\FoodCatalog\Models\Firm']
    ];
    public $belongsToMany = [
        'tags' => ['Macrobit\FoodCatalog\Models\Tag', 'table' => 'macrobit_foodcatalog_node_tags']
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public function getParentIdOptions()
    {
        $result = [];
        $result[0] = 'ROOT';
        $nodes = Node::all();
        foreach ($nodes as $node) {
            $result[$node->id] = implode(', ', $node->tags->lists('name'));
        }
        return $result;
    }

}