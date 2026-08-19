<?php

namespace App\Policies;

use App\Models\JenisProduk;
use App\Models\User;

class JenisProdukPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role->name, ['admin', 'kasir'], true);
    }

    public function view(User $user, JenisProduk $jenisProduk): bool
    {
        return in_array($user->role->name, ['admin', 'kasir'], true);
    }

    public function create(User $user): bool
    {
        return $user->role->name === 'admin'; // hanya admin yang boleh tambah jenis baru
    }

    public function update(User $user, JenisProduk $jenisProduk): bool
    {
        return $user->role->name === 'admin';
    }

    public function delete(User $user, JenisProduk $jenisProduk): bool
    {
        return $user->role->name === 'admin';
    }
}
