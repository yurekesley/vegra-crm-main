<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, Sortable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'partner_id',
        'user_type',
        'user_status',
        'access_profile_id',
        'cpf',
        'creci',
        'phone',
        'whatsapp',
        'picture_url',
        'director_id',
        'manager_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function access_profile()
    {
        return $this->belongsTo(AccessProfile::class);
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function isActive()
    {
        return $this->user_status == 'active';
    }

    public function approve()
    {
        $this->user_status = 'active';
    }

    public function translatedUserType()
    {
        switch ($this->user_type) {
            case 'partner':
                return 'parceiro';
            case 'broker':
                return 'corretor';
            case 'admin':
                return 'usuário';
            default:
                return 'desconhecido';
        }
    }

    public function translatedUserStatus()
    {
        switch ($this->user_status) {
            case 'pending':
                return 'pendente';
            case 'active':
                return 'ativo';
            case 'inactive':
                return 'inativo';
            case 'blocked':
                return 'bloqueado';
            default:
                return 'desconhecido';
        }
    }

    public function translatedUserStatusColor()
    {
        switch ($this->user_status) {
            case 'pending':
                return 'yellow';
            case 'active':
                return 'green';
            case 'inactive':
                return 'gray';
            case 'blocked':
                return 'red';
            default:
                return 'desconhecido';
        }
    }

    public function formattedCpf()
    {
        $cnpj_cpf = preg_replace("/\D/", '', $this->cpf);

        if (strlen($cnpj_cpf) === 11) {
            return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
        }

        return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification());
    }

    public function sendPasswordResetNotification($token)
    {

        $this->notify(new ResetPasswordNotification($token));
    }
}
