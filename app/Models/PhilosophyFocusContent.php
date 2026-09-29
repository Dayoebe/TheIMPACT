<?php

namespace App\Models;

use App\Support\PhilosophyFocusDefaults;
use Database\Factories\PhilosophyFocusContentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PhilosophyFocusContent extends Model
{
    /** @use HasFactory<PhilosophyFocusContentFactory> */
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
        return static::query()->firstOrCreate(
            ['key' => 'philosophy-focus'],
            ['content' => PhilosophyFocusDefaults::content()],
        );
    }
}
