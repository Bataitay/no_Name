<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;
    protected $fillable = ['nameVi', 'nameEn', 'quantity', 'description', 'price', 'category_id', 'supplier_id', 'user_id'];
    protected $dates = [
        'created_at',
    ];

    public function getCreatedFormatAttribute()
    {
        return $this->created_at->format('d-m-Y');
    }
    protected $appends = ['created_format'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function scopeSearch($query, $term)
    {
        $columns = ['nameVi', 'nameEn', 'quantity', 'description', 'price', 'category_id', 'status'];

        if ($term) {
            // foreach ($columns as  $column) {
            $query->Where('nameVi', 'like', "%{$term}%")
                ->orWhere('nameEn', 'like', "%{$term}%")
                ->orWhere('quantity', 'like', "%{$term}%")
                ->orWhere('description', 'like', "%{$term}%")
                ->orWhere('status', 'like', "%{$term}%")
                ->orWhere('price', 'like', "%{$term}%");
            // }
        }
        return $query;
    }
    public function scopeNameCate($query, $request)
    {
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        };
        return $query;
    }

    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['startPrice']) && isset($filters['endPrice'])) {
            $query->whereBetween('price', [$filters['startPrice'], $filters['endPrice']]);
        }
        return $query;
    }
    public function scopeForm_date_to($query, array $form_date_to)
    {
        if (isset($form_date_to['start_date']) && isset($form_date_to['end_date'])) {
            $query->whereBetween('updated_by', [$form_date_to['start_date'], $form_date_to['end_date']]);
        }
        return $query;
    }
    public function scopeStatus($query, $request)
    {
        if ($request->has('status')) {
            $query->where('status', $request->status);
        };
        return $query;
    }
    public function fileDetails()
   {
    return $this->hasMany(FileDetail::class);
   }
}
