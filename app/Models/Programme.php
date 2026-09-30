<?php

namespace App\Models;

use App\Support\ProgrammeDefaults;
use Database\Factories\ProgrammeFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Programme extends Model
{
    /** @use HasFactory<ProgrammeFactory> */
    use HasFactory;

    protected $fillable = ['slug', 'name', 'headline', 'icon', 'category', 'summary', 'overview', 'audience', 'duration', 'registration_url', 'objectives', 'curriculum', 'facilitators', 'cohorts', 'status', 'sort_order', 'updated_by'];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'objectives' => 'array',
            'curriculum' => 'array',
            'facilitators' => 'array',
            'cohorts' => 'array',
            'sort_order' => 'integer',
        ];
    }

    public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /** @param Builder<Programme> $query */
    public function scopePublished(Builder $query): void
    {
        $query->where('status', 'published');
    }

    public static function importDefaultsIfEmpty(): void
    {
        if (static::query()->exists()) {
            return;
        }

        DB::transaction(function (): void {
            if (static::query()->lockForUpdate()->exists()) {
                return;
            }

            foreach (ProgrammeDefaults::programmes() as $slug => $programme) {
                static::query()->create([
                    ...$programme,
                    'slug' => $slug,
                    'status' => 'published',
                    'sort_order' => array_search($slug, array_keys(ProgrammeDefaults::programmes()), true),
                ]);
            }
        });
    }
}
