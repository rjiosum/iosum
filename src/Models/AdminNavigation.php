<?php declare(strict_types=1);

namespace Iosum\AdminNav\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Iosum\AdminNav\Database\Factories\AdminNavigationFactory;
use Iosum\Base\Models\Model;

class AdminNavigation extends Model
{
    use HasFactory;

    protected $fillable = ['parent_id', 'position', 'title', 'icon', 'route_name', 'route_path'];

    protected static function newFactory()
    {
        return AdminNavigationFactory::new();
    }

    public function children()
    {
        return $this->hasMany(AdminNavigation::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(AdminNavigation::class, 'parent_id', 'id');
    }

    public function scopeParents(Builder $builder)
    {
        return $builder->where('parent_id', 0);
    }

    public function scopeOrdered(Builder $builder, $direction = 'asc')
    {
        return $builder->orderBy('position', $direction);
    }
}
