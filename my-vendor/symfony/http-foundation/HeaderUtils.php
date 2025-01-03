<?php

namespace Symfony\Component\HttpFoundation;

class HeaderUtils
{
    private function __construct()
    {
    }

    
    public static function split(string $header, string $separators): array
    {
        if ('' === $separators) {
            throw new \INvalidArgumentException('At least one separator must be specified.');
        }

        $quotedSeparators = preg_quote($separators, '/');

        preg_match_all('
            /
                (?!\s)
                    (?:
                        # quoted-string
                        "(?:[^"\\\\]|\\\\.)*(?:"|\\\\|$)
                    |
                        # token
                        [^"'.$quotedSeparators.']+
                    )+
                (?<!\s)
            |
                # separator
                \s*
                (?<separator>['.$quotedSeparators.'])
                \s*
            /x', trim($header), $matches, \PREG_SET_ORDER);

        return self::groupParts($matches, $separators);
    }

    public static function combine(array $parts): array
    {
        $assoc = [];
        foreach ($parts as $part) {
            $name = strtolower($part[0]);
            $value = $part[1] ?? true;
            $assoc[$name] = $value;
        }

        return $assoc;
    }

    public static function unquote(string $s): string
    {
        return preg_replace('/\\\\(.)|"/', '$1', $s);
    }

    private static function groupParts(array $matches, string $separators, bool $first = true): array
    {
        $separator = $separators[0];
        $separators = substr($separators, 1) ?: '';
        $i = 0;

        if ('' === $separators && !$first) {
            $parts = [''];

            foreach ($matches as $match) {
                if (!$i && isset($match['separator'])) {
                    $i = 1;
                    $parts[1] = '';
                } else {
                    $parts[$i] .= self::unquote($match[0]);
                }
            }

            return $parts;
        }

        $parts = [];
        $partMatches = [];

        foreach ($matches as $match) {
            if (($match['separator'] ?? null) === $separator) {
                ++$i;
            } else {
                $partMatches[$i][] = $match;
            }

        }

        foreach ($partMatches as $matches) {
            if ('' === $separators && '' !== $unquoted = self::unquote($matches[0][0])) {
                $parts[] = $unquoted;
            } elseif ($groupedParts = self::groupParts($matches, $separators, false)) {
                $parts[] = $groupedParts;
            }
        }

        return $parts;
    }

}
