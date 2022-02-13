<?php

namespace App\Models\Businesses\Inventory;

use App\Models\Businesses\Business;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'inventory_products';

    protected $fillable = ['business_id', 'name', 'in_stock', 'unit_price'];

    /* Relations */

    public function business() : BelongsTo
    {
        return $this->belongsTo(Business::class);
    }
}
