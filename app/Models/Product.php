<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use HasFactory, Sortable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'slug',
        'logo_url',
        'fake_broker_id',
        'phone',
        'house_commission_value',
        'partner_commission_value',
        'commission_payer',
        'show_commission_on_proposals',
        'enable_prospects',
        'sort_prospects',
        'allow_customer_without_broker',
        'allow_proposals',
        'welcome_text',
        'show_for_customers',
        'qualification_text',
        'logo_url',
        'description'
    ];

    public $sortable = ['id',
        'name',
        'email',
        'slug',
        'created_at',
        'updated_at'];

    public function whatsAppUrl()
    {
        $urlbase = route('prospects.registration.index', $this->id);
        return "https://api.whatsapp.com/send?text=" . urlencode(__('Olá, para preencher sua ficha de intenção de compra do *') . $this->name . __('*, acesse o link a seguir:') . "\n\n" . $urlbase . "\n\n" . __('Obrigado.'));
    }

    public function gdprs()
    {
        return $this->hasMany(ProductGdpr::class);
    }
}
