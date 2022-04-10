<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Prospect extends Model
{
    use HasFactory, Sortable, SoftDeletes;

    protected $fillable = [
        'name',
        'cpf_cnpj',
        'phone',
        'email',
        'occupation',
        'marital_state',
        'customer_preferences',
        'rg',
        'birth_date',
        'marriage_regime',
        'broker_id',
        'status',
        'product_id',
        'copart_name',
        'copart_cpf_cnpj',
        'copart_phone',
        'copart_email',
        'copart_occupation',
        'copart_marital_state',
        'has_coparticipant',
        'has_broker',
        'total_incoming',
        'zip_code',
        'address',
        'number',
        'complement',
        'neighborhood',
        'city',
        'state',
        'nationality',
        'copart_zipcode',
        'copart_address',
        'copart_number',
        'copart_complement',
        'copart_neighborhood',
        'copart_city',
        'copart_state',
        'copart_nationality',
        'copart_birth_date',
        'copart_marriage_regime',
        'notes'
    ];

    protected $casts = [
        'birth_date' => 'datetime',
        'copart_birth_date' => 'datetime',
    ];

    public $sortable = ['id',
        'name',
        'email',
        'created_at',
        'updated_at'];

    public function broker()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function code()
    {
        return $this->hasOne(Code::class);
    }

    public function prospect_documents()
    {
        return $this->hasMany(ProspectDocument::class);
    }

    public function prospect_copart_documents()
    {
        return $this->hasMany(CoparticipantDocument::class);
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    public function translateStatus($plural = false)
    {
        switch ($this->status) {
            case 'open':
                return 'Aberta' . ($plural ? 's' : '');
            case 'approved':
                return 'Aprovada' . ($plural ? 's' : '');
            case 'rejected':
                return 'Reprovada' . ($plural ? 's' : '');
            default:
                return 'Desconhecido';
        }
    }

    public function getStatusColor()
    {
        switch ($this->status) {
            case 'open':
                return 'yellow';
            case 'approved':
                return 'green';
            case 'rejected':
                return 'red';
            default:
                return 'gray';
        }
    }

    public function whatsAppDocumentUrl()
    {
        $urlbase = route('prospects.data.documents.code', ['code' => $this->document_code]);
        return "https://api.whatsapp.com/send?phone=+55" . preg_replace('/[^0-9]/', '', $this->phone) . "&text=" . urlencode("Olá, para enviar seus documentos referentes a intenção de compra do *" . $this->product->name . "*, acesse o link a seguir:\n\n" . $urlbase . "\n\nObrigado.");
    }
}
