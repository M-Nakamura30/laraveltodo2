<?php

namespace App\Policies;

use App\Folder;
use App\User;

//ユーザーとフォルダが紐づいているときのみ許可
//作成したポリシーは AuthServiceProviderに登録
class FolderPolicy
{
    /**
     * フォルダの閲覧権限
     * @param User $user
     * @param Folder $folder
     * @return bool
     */
    public function view(User $user, Folder $folder)
    {
        return $user->id === $folder->user_id;
    }
}