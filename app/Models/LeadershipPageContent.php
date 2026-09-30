<?php

namespace App\Models;

use App\Support\LeadershipPageDefaults;
use Database\Factories\LeadershipPageContentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeadershipPageContent extends Model
{
    /** @use HasFactory<LeadershipPageContentFactory> */
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
        return static::query()->firstOrCreate(['key' => 'leadership'], ['content' => LeadershipPageDefaults::content()]);
    }
}
