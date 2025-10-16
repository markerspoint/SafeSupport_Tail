<?php

if (!function_exists('getUserAvatarUrl')) {
    function getUserAvatarUrl($user)
    {
        if ($user->avatar) {
            return $user->avatar;
        }

        $genderMap = [
            'male' => 'boy',
            'female' => 'girl',
        ];
        $gender = $user->gender ? ($genderMap[$user->gender] ?? 'boy') : 'boy';
        $avatarUrl = "https://avatar.iran.liara.run/public/{$gender}?seed={$user->id}";

        // Save the generated avatar URL to the user's avatar column
        $user->update(['avatar' => $avatarUrl]);

        return $avatarUrl;
    }
}