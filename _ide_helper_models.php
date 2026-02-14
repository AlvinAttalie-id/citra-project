<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id_keluar
 * @property string $slug
 * @property string $kode_barang
 * @property int $id_user
 * @property string $tgl_keluar
 * @property int $jumlah
 * @property string|null $keterangan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $status
 * @property-read \App\Models\User $admin
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ReturnBarang> $returnBarang
 * @property-read int|null $return_barang_count
 * @property-read \App\Models\StokBarang $stokBarang
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BarangKeluar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BarangKeluar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BarangKeluar onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BarangKeluar query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BarangKeluar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BarangKeluar whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BarangKeluar whereIdKeluar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BarangKeluar whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BarangKeluar whereJumlah($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BarangKeluar whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BarangKeluar whereKodeBarang($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BarangKeluar whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BarangKeluar whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BarangKeluar whereTglKeluar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BarangKeluar whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BarangKeluar withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BarangKeluar withoutTrashed()
 */
	class BarangKeluar extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id_return
 * @property string $kode_barang
 * @property int $jumlah_rusak
 * @property string $tanggal
 * @property string|null $keterangan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $id_user
 * @property-read \App\Models\StokBarang $stokBarang
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BarangRusak newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BarangRusak newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BarangRusak onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BarangRusak query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BarangRusak whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BarangRusak whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BarangRusak whereIdReturn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BarangRusak whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BarangRusak whereJumlahRusak($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BarangRusak whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BarangRusak whereKodeBarang($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BarangRusak whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BarangRusak whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BarangRusak withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BarangRusak withoutTrashed()
 */
	class BarangRusak extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id_pengeluaran
 * @property int|null $id_user
 * @property string $slug
 * @property string $jenis_pengeluaran
 * @property \Illuminate\Support\Carbon $tgl_pengeluaran
 * @property int $biaya
 * @property string|null $bukti
 * @property string|null $keterangan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pengeluaran newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pengeluaran newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pengeluaran onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pengeluaran query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pengeluaran whereBiaya($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pengeluaran whereBukti($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pengeluaran whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pengeluaran whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pengeluaran whereIdPengeluaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pengeluaran whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pengeluaran whereJenisPengeluaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pengeluaran whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pengeluaran whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pengeluaran whereTglPengeluaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pengeluaran whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pengeluaran withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pengeluaran withoutTrashed()
 */
	class Pengeluaran extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id_return
 * @property int $id_keluar
 * @property string $kode_barang
 * @property string $tanggal_r
 * @property int $jumlah
 * @property string|null $alasan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $kode_return
 * @property int $id_user
 * @property-read \App\Models\BarangKeluar $barangKeluar
 * @property-read \App\Models\StokBarang $stokBarang
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReturnBarang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReturnBarang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReturnBarang onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReturnBarang query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReturnBarang whereAlasan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReturnBarang whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReturnBarang whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReturnBarang whereIdKeluar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReturnBarang whereIdReturn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReturnBarang whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReturnBarang whereJumlah($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReturnBarang whereKodeBarang($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReturnBarang whereKodeReturn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReturnBarang whereTanggalR($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReturnBarang whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReturnBarang withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReturnBarang withoutTrashed()
 */
	class ReturnBarang extends \Eloquent {}
}

namespace App\Models{
/**
 * @property string $kode_barang
 * @property string $slug
 * @property string $jenis_barang
 * @property int $jumlah_stok
 * @property int $harga
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BarangKeluar> $barangKeluar
 * @property-read int|null $barang_keluar_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BarangRusak> $barangRusak
 * @property-read int|null $barang_rusak_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ReturnBarang> $returnBarang
 * @property-read int|null $return_barang_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SuplayBarang> $suplayBarang
 * @property-read int|null $suplay_barang_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StokBarang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StokBarang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StokBarang onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StokBarang query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StokBarang whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StokBarang whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StokBarang whereHarga($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StokBarang whereJenisBarang($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StokBarang whereJumlahStok($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StokBarang whereKodeBarang($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StokBarang whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StokBarang whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StokBarang withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StokBarang withoutTrashed()
 */
	class StokBarang extends \Eloquent {}
}

namespace App\Models{
/**
 * @property string $nomor_pengiriman
 * @property string $slug
 * @property int $id_user
 * @property string $kode_barang
 * @property string $tgl_pengiriman
 * @property int $jumlah
 * @property string|null $keterangan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\StokBarang $stokBarang
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuplayBarang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuplayBarang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuplayBarang onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuplayBarang query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuplayBarang whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuplayBarang whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuplayBarang whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuplayBarang whereJumlah($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuplayBarang whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuplayBarang whereKodeBarang($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuplayBarang whereNomorPengiriman($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuplayBarang whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuplayBarang whereTglPengiriman($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuplayBarang whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuplayBarang withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuplayBarang withoutTrashed()
 */
	class SuplayBarang extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id_user
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $name
 * @property string|null $alamat
 * @property string|null $no_hp
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BarangKeluar> $barangKeluar
 * @property-read int|null $barang_keluar_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SuplayBarang> $suplayBarang
 * @property-read int|null $suplay_barang_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereNoHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutRole($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutTrashed()
 */
	class User extends \Eloquent implements \Filament\Models\Contracts\FilamentUser {}
}

