<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\HistoryRankingSmart;
use Illuminate\Auth\Access\HandlesAuthorization;

class HistoryRankingSmartPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:HistoryRankingSmart');
    }

    public function view(AuthUser $authUser, HistoryRankingSmart $historyRankingSmart): bool
    {
        return $authUser->can('View:HistoryRankingSmart');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:HistoryRankingSmart');
    }

    public function update(AuthUser $authUser, HistoryRankingSmart $historyRankingSmart): bool
    {
        return $authUser->can('Update:HistoryRankingSmart');
    }

    public function delete(AuthUser $authUser, HistoryRankingSmart $historyRankingSmart): bool
    {
        return $authUser->can('Delete:HistoryRankingSmart');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:HistoryRankingSmart');
    }

    public function restore(AuthUser $authUser, HistoryRankingSmart $historyRankingSmart): bool
    {
        return $authUser->can('Restore:HistoryRankingSmart');
    }

    public function forceDelete(AuthUser $authUser, HistoryRankingSmart $historyRankingSmart): bool
    {
        return $authUser->can('ForceDelete:HistoryRankingSmart');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:HistoryRankingSmart');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:HistoryRankingSmart');
    }

    public function replicate(AuthUser $authUser, HistoryRankingSmart $historyRankingSmart): bool
    {
        return $authUser->can('Replicate:HistoryRankingSmart');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:HistoryRankingSmart');
    }

}