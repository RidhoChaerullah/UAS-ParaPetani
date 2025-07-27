<?php

namespace App\Policies;

use App\Models\Plant;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PlantPolicy
{
    /**
     * Izinkan user yang sudah login untuk membuat tanaman baru.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Izinkan user untuk melihat detail tanaman HANYA JIKA itu miliknya.
     */
    public function view(User $user, Plant $plant): bool
    {
        return $user->id === $plant->user_id;
    }

    /**
     * Izinkan user untuk memperbarui tanaman HANYA JIKA itu miliknya.
     */
    public function update(User $user, Plant $plant): bool
    {
        return $user->id === $plant->user_id;
    }

    /**
     * Izinkan user untuk menghapus tanaman HANYA JIKA itu miliknya.
     * Ini adalah logika yang akan digunakan oleh method destroy() di controller Anda.
     */
    public function delete(User $user, Plant $plant): bool
    {
        return $user->id === $plant->user_id;
    }

    // Untuk method di bawah ini, biarkan saja 'false' karena sepertinya
    // Anda belum membutuhkan fungsionalitas 'restore' atau 'force delete'.

    public function viewAny(User $user): bool
    {
        return false; // Misal: hanya admin yang bisa lihat semua (bisa diubah nanti)
    }

    public function restore(User $user, Plant $plant): bool
    {
        return false;
    }

    public function forceDelete(User $user, Plant $plant): bool
    {
        return false;
    }
}