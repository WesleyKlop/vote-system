<?php

namespace App\VoteSystem\Helpers;

use Exception;

/**
 * Copyright (C) 2018  Stan Overgauw.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
final class TokenHelper
{
    /**
     * All characters that can be used for a token.
     * Basically all number and letters except for 0, 1, I, L and O.
     */
    public const KEY_SPACE = '23456789ABCDEFGHJKMNPQRSTUVWXYZ';

    /**
     * @throws Exception
     */
    public static function generateTokens(int $amount): iterable
    {
        $tokenLength = config('vote-system.token_length');
        for ($i = 0; $i < $amount; $i++) {
            yield TokenHelper::generateToken($tokenLength);
        }
    }

    /**
     * Generates a token with given length inside a given keySpace. Based on code by Stan Overgauw.
     * @throws Exception
     */
    public static function generateToken(int $length): string
    {
        $pieces = [];
        $max = mb_strlen(self::KEY_SPACE) - 1;
        for ($i = 0; $i < $length; $i++) {
            $pieces[] = self::KEY_SPACE[random_int(0, $max)];
        }

        return implode('', $pieces);
    }
}
