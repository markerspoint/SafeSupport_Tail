<?php

if (!function_exists('getUserAvatarUrl')) {
    function getUserAvatarUrl($user)
    {
        if ($user->avatar) {
            return $user->avatar; // Use stored avatar URL
        }

        $genderMap = [
            'male' => 'boy',
            'female' => 'girl',
        ];
        $gender = $user->gender ? ($genderMap[$user->gender] ?? 'boy') : 'boy';
        return "https://avatar.iran.liara.run/public/{$gender}?seed={$user->id}";
    }
}