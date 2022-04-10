<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Partner extends Model
{
    use HasFactory, Sortable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'cnpj',
        'creci',
        'phone',
        'whatsapp',
        'user_id',
        'responsible',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function getBrokerCountText($brokers)
    {
        return $brokers . ' ' . ($brokers == 1 ? __('corretor') : __('corretores'));
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function formattedCnpj()
    {
        $cnpj_cpf = preg_replace("/\D/", '', $this->cnpj);

        if (strlen($cnpj_cpf) === 11) {
            return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
        }

        return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
    }
}
