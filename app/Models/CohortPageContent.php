<?php

namespace App\Models;

use App\Support\CohortPageDefaults;
use Database\Factories\CohortPageContentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CohortPageContent extends Model
{
    /** @use HasFactory<CohortPageContentFactory> */
    use HasFactory;

    protected $fillable = ['key', 'content', 'updated_by'];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return ['content' => 'array'];
    }

    public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public static function current(): self
    {
        return static::query()->firstOrCreate(['key' => 'cohorts-registration'], ['content' => CohortPageDefaults::content()]);
    }
}
