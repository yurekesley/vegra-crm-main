<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class ProposalHistory extends Model
{
    use HasFactory, Sortable, SoftDeletes;

    protected $fillable = [
        'proposal_id',
        'content',
        'type',
        'ip',
        'notes'
    ];

    public $sortable = ['id',
        'proposal_id',
        'content',
        'type',
        'created_at',
        'updated_at'];

    public function proposal_id()
    {
        return $this->belongsTo(Proposal::class);
    }

    private function translateStatus($status, $plural = false)
    {
        switch ($status) {
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
}
