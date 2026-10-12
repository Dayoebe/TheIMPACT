<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

class ProgrammeMedia
{
    /** @param array<string, mixed> $media
     *  @return array<string, mixed>
     */
    public static function present(array $media): array
    {
        $resolvedUrl = ($media['source'] ?? null) === 'upload'
            ? Storage::disk('public')->url($media['path'])
            : ($media['url'] ?? '');

        return [
            ...$media,
            'resolved_url' => $resolvedUrl,
            'embed_url' => self::embedUrl($media),
            'direct_playable' => self::isDirectlyPlayable($media),
        ];
    }

    /** @param array<string, mixed> $media */
    public static function embedUrl(array $media): ?string
    {
        if (($media['source'] ?? null) !== 'link' || empty($media['url'])) {
            return null;
        }

        $url = $media['url'];
        $host = strtolower(parse_url($url, PHP_URL_HOST) ?? '');
        $path = trim(parse_url($url, PHP_URL_PATH) ?? '', '/');

        if (($media['type'] ?? null) === 'video') {
            if (in_array($host, ['youtube.com', 'www.youtube.com', 'm.youtube.com', 'youtu.be'], true)) {
                $videoId = $host === 'youtu.be' ? explode('/', $path)[0] : self::youtubeVideoId($url, $path);

                return preg_match('/^[A-Za-z0-9_-]{6,20}$/', $videoId) ? 'https://www.youtube-nocookie.com/embed/'.$videoId : null;
            }

            if (in_array($host, ['vimeo.com', 'www.vimeo.com'], true) && preg_match('/^(?:video\/)?(\d+)/', $path, $matches)) {
                return 'https://player.vimeo.com/video/'.$matches[1];
            }
        }

        if (($media['type'] ?? null) === 'audio') {
            if (in_array($host, ['open.spotify.com', 'www.open.spotify.com'], true) && preg_match('#^(track|episode|album|playlist|show)/([A-Za-z0-9]+)#', $path, $matches)) {
                return 'https://open.spotify.com/embed/'.$matches[1].'/'.$matches[2];
            }

            if (in_array($host, ['soundcloud.com', 'www.soundcloud.com'], true)) {
                return 'https://w.soundcloud.com/player/?url='.rawurlencode($url);
            }

            if (in_array($host, ['audiomack.com', 'www.audiomack.com'], true) && $path !== '') {
                return 'https://audiomack.com/embed/'.$path;
            }
        }

        return null;
    }

    /** @param array<string, mixed> $media */
    public static function isDirectlyPlayable(array $media): bool
    {
        if (($media['source'] ?? null) === 'upload') {
            return true;
        }

        $extension = strtolower(pathinfo(parse_url($media['url'] ?? '', PHP_URL_PATH) ?? '', PATHINFO_EXTENSION));

        return match ($media['type'] ?? null) {
            'audio' => in_array($extension, ['aac', 'm4a', 'mp3', 'oga', 'ogg', 'wav'], true),
            'video' => in_array($extension, ['m4v', 'mov', 'mp4', 'ogv', 'webm'], true),
            default => false,
        };
    }

    private static function youtubeVideoId(string $url, string $path): string
    {
        parse_str(parse_url($url, PHP_URL_QUERY) ?? '', $query);

        if (isset($query['v']) && is_string($query['v'])) {
            return $query['v'];
        }

        $segments = explode('/', $path);

        return in_array($segments[0] ?? '', ['embed', 'shorts', 'live'], true) ? ($segments[1] ?? '') : '';
    }
}
