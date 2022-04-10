<?php

namespace App\Http\Controllers;

use App\Models\Code;
use App\Models\Product;
use App\Models\Prospect;
use App\Models\ProspectDocument;
use App\Models\ProspectHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Zip;

class ProspectController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter');
        $product_id = $request->query('product_id');
        $status = $request->query('status') ?? 'open';

        $products = Product::all(['id', 'name']);
        $prospects = Prospect::where('status', $status);
        $prospectCount = Prospect::all();

        if ($product_id != null && $product_id != 'null') {
            $prospects = $prospects->where('product_id', $product_id);
            $prospectCount = $prospectCount->where('product_id', $product_id);
        }

        $prospects = $prospects->paginate(10);

        $open = $prospectCount->where('status', 'open')->count();
        $approved = $prospectCount->where('status', 'approved')->count();
        $rejected = $prospectCount->where('status', 'rejected')->count();

        return view('prospects.index')
            ->with('prospects', $prospects)
            ->with('products', $products)
            ->with('filter', $filter)
            ->with('status', $status)
            ->with('product_id', $product_id)
            ->with('prospect_status', $this->translateStatus($status, true))
            ->with('status_color', $this->getStatusColor($status, true))
            ->with('open', $open)
            ->with('approved', $approved)
            ->with('rejected', $rejected);
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

    private function getStatusColor($status)
    {
        switch ($status) {
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

    public function data(Prospect $prospect, Request $request)
    {
        ProspectHistory::create([
            'prospect_id' => $prospect->id,
            'content' => 'O usuário ' . auth()->user()->email . ' abriu os dados da pasta ' . $prospect->id . ' com status ' . $prospect->translateStatus(false),
            'type' => 'log',
            'ip' => $request->ip(),
        ]);

        $histories = ProspectHistory::where('prospect_id', $prospect->id)->where('type', 'data')->orWhere('type', 'status')->orderBy('created_at')->get();

        return view('prospects.data')
            ->with('prospect', $prospect)
            ->with('histories', $histories);
    }

    public function getDocument(Prospect $prospect, ProspectDocument $prospect_document, Request $request)
    {
        ProspectHistory::create([
            'prospect_id' => $prospect->id,
            'content' => 'O usuário ' . auth()->user()->email . ' solicitou o download do documento ' . $prospect_document->getTranslatedType() . ' - ID: ' . $prospect_document->id,
            'type' => 'log',
            'ip' => $request->ip(),
        ]);

        $name = basename($prospect_document->url ?? $prospect_document->getTranslatedTypeFile());
        $headers = [
            'Content-Type' => 'application/jpeg',
            'Content-Disposition' => 'attachment; filename="' . $name . '"',
        ];

        $s3Path = str_replace('https://.s3.amazonaws.com/', '', str_replace(env('AWS_BUCKET'), '', $prospect_document->url));

        return Response::make(Storage::disk('s3')->get($s3Path), 200, $headers);
    }

    public function getZipDocuments(Prospect $prospect, Request $request)
    {
        ProspectHistory::create([
            'prospect_id' => $prospect->id,
            'content' => 'O usuário ' . auth()->user()->email . ' solicitou o download de todos os documentos em formato ZIP',
            'type' => 'log',
            'ip' => $request->ip(),
        ]);

        $zipname = "documentos-" . time() . '-' . $prospect->id . ".zip";
        $zip = Zip::create($zipname);

        foreach ($prospect->prospect_documents as $prospect_document) {
            $name = basename($prospect_document->url ?? $prospect_document->getTranslatedTypeFile());
            $s3Path = str_replace('https://.s3.amazonaws.com/', '', str_replace(env('AWS_BUCKET'), '', $prospect_document->url));
            $content = Storage::disk('s3')->get($s3Path);

            $zip->addRaw($content, $name);
        }

        return $zip;
    }

    public function updateData(Prospect $prospect, Request $request)
    {
        ProspectHistory::create([
            'prospect_id' => $prospect->id,
            'content' => 'O usuário ' . auth()->user()->email . ' gravou alteração dos dados da pasta',
            'type' => 'log',
            'ip' => $request->ip(),
        ]);

        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|max:100|email',
            'cpf_cnpj' => 'required|string|max:14',
            'phone' => 'required|string|max:20',
            'occupation' => 'required|string|max:100',
            'marital_state' => 'required|string|in:single,married,divorced,widowed,undefined',
            'marriage_regime' => 'nullable|string|in:partial_goods_community,universal_goods_community,goods_separation,final_participation_in_aquests',
            'preferences' => 'required',
            'has_coparticipant' => 'required|in:true,false',
            'rg' => 'nullable|max:20',
            'nationality' => 'nullable|max:50',
            'birth_date' => 'nullable|date_format:dmY',
            'zip_code' => 'nullable|max:8',
            'address' => 'nullable|max:100',
            'complement' => 'nullable|max:20',
            'neighborhood' => 'nullable|max:50',
            'number' => 'nullable|max:10',
            'city' => 'nullable|max:50',
            'state' => 'nullable|max:2',
        ]);

        $prospect->name = $request->name;
        $prospect->email = $request->email;
        $prospect->cpf_cnpj = $request->cpf_cnpj;
        $prospect->phone = $request->phone;
        $prospect->occupation = $request->occupation;
        $prospect->marital_state = $request->marital_state;
        $prospect->marriage_regime = $request->marriage_regime;
        $prospect->customer_preferences = $request->preferences;
        $prospect->rg = $request->rg;
        $prospect->nationality = $request->nationality;
        $prospect->birth_date = $request->birth_date != null ? substr($request->birth_date, 4, 4) . '-' . substr($request->birth_date, 2, 2) . '-' . substr($request->birth_date, 0, 2) : null;
        $prospect->zip_code = $request->zip_code;
        $prospect->address = $request->address;
        $prospect->complement = $request->complement;
        $prospect->neighborhood = $request->neighborhood;
        $prospect->number = $request->number;
        $prospect->city = $request->city;
        $prospect->state = $request->state;

        if ($request->has_coparticipant == 'true') {
            $request->validate([
                'copart_name' => 'required|max:100',
                'copart_email' => 'required|max:100|email',
                'copart_cpf_cnpj' => 'required|string|max:14',
                'copart_phone' => 'required|string|max:20',
                'copart_occupation' => 'required|string|max:100',
                'copart_marital_state' => 'required|string|in:single,married,divorced,widowed,undefined',
                'copart_marriage_regime' => 'nullable|string|in:partial_goods_community,universal_goods_community,goods_separation,final_participation_in_aquests',
                'copart_rg' => 'nullable|max:20',
                'copart_nationality' => 'nullable|max:50',
                'copart_birth_date' => 'nullable|date_format:dmY',
                'copart_zip_code' => 'nullable|max:8',
                'copart_address' => 'nullable|max:100',
                'copart_complement' => 'nullable|max:20',
                'copart_neighborhood' => 'nullable|max:50',
                'copart_number' => 'nullable|max:10',
                'copart_city' => 'nullable|max:50',
                'copart_state' => 'nullable|max:2',
            ]);

            $prospect->copart_name = $request->copart_name;
            $prospect->copart_email = $request->copart_email;
            $prospect->copart_cpf_cnpj = $request->copart_cpf_cnpj;
            $prospect->copart_phone = $request->copart_phone;
            $prospect->copart_occupation = $request->copart_occupation;
            $prospect->copart_marital_state = $request->copart_marital_state;
            $prospect->copart_marriage_regime = $request->copart_marriage_regime;
            $prospect->copart_rg = $request->copart_rg;
            $prospect->copart_nationality = $request->copart_nationality;
            $prospect->copart_birth_date = $request->copart_birth_date != null ? substr($request->copart_birth_date, 4, 4) . '-' . substr($request->copart_birth_date, 2, 2) . '-' . substr($request->copart_birth_date, 0, 2) : null;
            $prospect->copart_zipcode = $request->copart_zip_code;
            $prospect->copart_address = $request->copart_address;
            $prospect->copart_complement = $request->copart_complement;
            $prospect->copart_neighborhood = $request->copart_neighborhood;
            $prospect->copart_number = $request->copart_number;
            $prospect->copart_city = $request->copart_city;
            $prospect->copart_state = $request->copart_state;
        }

        $prospect->total_incoming = $request->total_incoming;

        $prospect->save();

        ProspectHistory::create([
            'prospect_id' => $prospect->id,
            'content' => 'Dados da pasta alterados',
            'type' => 'data',
            'ip' => $request->ip(),
        ]);

        Alert::success('Sucesso', 'Dados da pasta alterados com sucesso.');

        return redirect()->route('prospects.data', $prospect->id);
    }

    public function documentsIndex(Request $request)
    {
        $prospect = Prospect::where('document_code', $request->query('code'))->first();

        if ($prospect == null) {
            Alert::error('Código inválido', 'Código para upload de documentos inválido. Por favor, entre em contato com seu corretor ou responsável.');
            return redirect()->route('welcome');
        }

        if ($prospect->status == 'temp') {
            Alert::warning('Cadastro ainda não enviado', 'Este cadastro precisa ser enviado pelo fluxo de cadastro. Por favor, realize um cadastro de compra.');
            return redirect()->route('welcome');
        }

        return view('prospects.documents')
            ->with('prospect', $prospect);
    }

    public function documentsStore(Request $request)
    {
        $prospect = Prospect::where('document_code', $request->query('code'))->first();

        if ($prospect == null) {
            Alert::error('Código inválido', 'Código para upload de documentos inválido. Por favor, entre em contato com seu corretor ou responsável.');
            return redirect()->route('welcome');
        }

        if ($prospect->status == 'temp') {
            Alert::warning('Cadastro ainda não enviado', 'Este cadastro precisa ser enviado pelo fluxo de cadastro. Por favor, realize um cadastro de compra.');
            return redirect()->route('welcome');
        }

        $request->validate([
            'cpf_cnh' => 'nullable|max:5120|mimes:jpg,png,pdf',
            'rg' => 'nullable|max:5120|mimes:jpg,jpeg,png,pdf,JPG,JPEG,PNG,PDF',
            'comp_res' => 'nullable|max:5120|mimes:jpg,jpeg,png,pdf,JPG,JPEG,PNG,PDF',
            'comp_est_civil' => 'nullable|max:5120|mimes:jpg,jpeg,png,pdf,JPG,JPEG,PNG,PDF',
            'advb_est_civil' => 'nullable|max:5120|mimes:jpg,jpeg,png,pdf,JPG,JPEG,PNG,PDF',
            'com_renda' => 'nullable|max:5120|mimes:jpg,jpeg,png,pdf,JPG,JPEG,PNG,PDF',
            'other' => 'nullable|max:5120|mimes:jpg,jpeg,png,pdf,JPG,JPEG,PNG,PDF',
        ]);

        if ($request->hasFile('cpf_cnh')) {
            ProspectHistory::create([
                'prospect_id' => $prospect->id,
                'content' => 'O cliente adicionou um documento do tipo CPF ou CNH a pasta',
                'type' => 'log',
                'ip' => $request->ip(),
            ]);

            $file = $request->file('cpf_cnh');

            $name = uniqid() . '-cpf-cnh-' . $prospect->id . '.' . $file->getClientOriginalExtension();
            $filePath = 'documents/' . $prospect->id . '/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $path = Storage::disk('s3')->url($filePath);

            $document = ProspectDocument::create([
                'prospect_id' => $prospect->id,
                'type' => 'cpf_cnh',
                'url' => $path,
            ]);
        }

        if ($request->hasFile('rg')) {
            ProspectHistory::create([
                'prospect_id' => $prospect->id,
                'content' => 'O cliente adicionou um documento do tipo RG a pasta',
                'type' => 'log',
                'ip' => $request->ip(),
            ]);

            $file = $request->file('rg');

            $name = uniqid() . '-rg-' . $prospect->id . '.' . $file->getClientOriginalExtension();
            $filePath = 'documents/' . $prospect->id . '/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $path = Storage::disk('s3')->url($filePath);

            $document = ProspectDocument::create([
                'prospect_id' => $prospect->id,
                'type' => 'rg',
                'url' => $path,
            ]);
        }

        if ($request->hasFile('comp_res')) {
            ProspectHistory::create([
                'prospect_id' => $prospect->id,
                'content' => 'O cliente adicionou um documento do tipo Comprovante de residência a pasta',
                'type' => 'log',
                'ip' => $request->ip(),
            ]);

            $file = $request->file('comp_res');

            $name = uniqid() . '-comp_res-' . $prospect->id . '.' . $file->getClientOriginalExtension();
            $filePath = 'documents/' . $prospect->id . '/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $path = Storage::disk('s3')->url($filePath);

            $document = ProspectDocument::create([
                'prospect_id' => $prospect->id,
                'type' => 'comp_res',
                'url' => $path,
            ]);
        }

        if ($request->hasFile('comp_est_civil')) {
            ProspectHistory::create([
                'prospect_id' => $prospect->id,
                'content' => 'O cliente adicionou um documento do tipo Comprovante de estado civil a pasta',
                'type' => 'log',
                'ip' => $request->ip(),
            ]);

            $file = $request->file('comp_est_civil');

            $name = uniqid() . '-comp_est_civil-' . $prospect->id . '.' . $file->getClientOriginalExtension();
            $filePath = 'documents/' . $prospect->id . '/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $path = Storage::disk('s3')->url($filePath);

            $document = ProspectDocument::create([
                'prospect_id' => $prospect->id,
                'type' => 'comp_est_civil',
                'url' => $path,
            ]);
        }

        if ($request->hasFile('advb_est_civil')) {
            ProspectHistory::create([
                'prospect_id' => $prospect->id,
                'content' => 'O cliente adicionou um documento do tipo Adverbações de estado civil a pasta',
                'type' => 'log',
                'ip' => $request->ip(),
            ]);

            $file = $request->file('advb_est_civil');

            $name = uniqid() . '-advb_est_civil-' . $prospect->id . '.' . $file->getClientOriginalExtension();
            $filePath = 'documents/' . $prospect->id . '/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $path = Storage::disk('s3')->url($filePath);

            $document = ProspectDocument::create([
                'prospect_id' => $prospect->id,
                'type' => 'advb_est_civil',
                'url' => $path,
            ]);
        }

        if ($request->hasFile('com_renda')) {
            ProspectHistory::create([
                'prospect_id' => $prospect->id,
                'content' => 'O cliente adicionou um documento do tipo Comprovante de renda a pasta',
                'type' => 'log',
                'ip' => $request->ip(),
            ]);

            $file = $request->file('com_renda');

            $name = uniqid() . '-com_renda-' . $prospect->id . '.' . $file->getClientOriginalExtension();
            $filePath = 'documents/' . $prospect->id . '/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $path = Storage::disk('s3')->url($filePath);

            $document = ProspectDocument::create([
                'prospect_id' => $prospect->id,
                'type' => 'com_renda',
                'url' => $path,
            ]);
        }

        if ($request->hasFile('other')) {
            ProspectHistory::create([
                'prospect_id' => $prospect->id,
                'content' => 'O cliente adicionou um documento do tipo Outros a pasta',
                'type' => 'log',
                'ip' => $request->ip(),
            ]);

            $file = $request->file('other');

            $name = uniqid() . '-other-' . $prospect->id . '.' . $file->getClientOriginalExtension();
            $filePath = 'documents/' . $prospect->id . '/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $path = Storage::disk('s3')->url($filePath);

            $document = ProspectDocument::create([
                'prospect_id' => $prospect->id,
                'type' => 'other',
                'url' => $path,
            ]);
        }

        ProspectHistory::create([
            'prospect_id' => $prospect->id,
            'content' => 'Novos documentos inseridos pelo cliente',
            'type' => 'data',
            'ip' => $request->ip(),
        ]);

        Alert::success('Sucesso', 'Documentos enviados com sucesso. Em breve entraremos em contato');

        return redirect()->route('welcome');
    }

    public function docsIndex(Request $request)
    {
        $code = $request->query('code');

        if ($code != null) {
            return redirect()->route('prospects.data.documents', ['code' => $code]);
        }

        return view('prospects.data-code');
    }

    public function approve(Prospect $prospect, Request $request)
    {
        DB::transaction(function () use ($prospect, $request) {
            $prospect->status = 'approved';
            $prospect->notes = $request->notes;
            $prospect->save();

            $code = Code::where('prospect_id', $prospect->id)->first();

            $codeStr = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 8);

            while (Code::where('code', $code)->first() != null) {
                $codeStr = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 8);
            }

            if ($code == null) {
                $code = Code::create([
                    'product_id' => $prospect->product_id,
                    'prospect_id' => $prospect->id,
                    'broker_id' => $prospect->broker_id,
                    'available' => 1,
                    'used' => 0,
                    'code' => $codeStr,
                ]);
            }

            ProspectHistory::create([
                'prospect_id' => $prospect->id,
                'content' => 'Pasta aprovada pelo usuário ' . auth()->user()->email,
                'type' => 'log',
                'ip' => $request->ip(),
            ]);

            ProspectHistory::create([
                'prospect_id' => $prospect->id,
                'content' => 'Pasta aprovada!',
                'notes' => $request->notes,
                'type' => 'status',
                'ip' => $request->ip(),
            ]);
        });

        Alert::success('Sucesso', 'Pasta aprovada com sucesso');

        return redirect()->route('prospects.data', ['prospect' => $prospect->id]);

    }

    public function open(Prospect $prospect, Request $request)
    {
        DB::transaction(function () use ($prospect, $request) {
            $prospect->status = 'open';
            $prospect->notes = $request->notes;
            $prospect->save();

            ProspectHistory::create([
                'prospect_id' => $prospect->id,
                'content' => 'Pasta teve solicitação de correções pelo usuário ' . auth()->user()->email,
                'type' => 'log',
                'ip' => $request->ip(),
            ]);

            ProspectHistory::create([
                'prospect_id' => $prospect->id,
                'content' => 'Solicitação de correções!',
                'notes' => $request->notes,
                'type' => 'status',
                'ip' => $request->ip(),
            ]);
        });

        Alert::success('Sucesso', 'Solicitação de correções na pasta realizada com sucesso');

        return redirect()->route('prospects.data', ['prospect' => $prospect->id]);
    }

    public function reject(Prospect $prospect, Request $request)
    {
        DB::transaction(function () use ($prospect, $request) {
            $prospect->status = 'rejected';
            $prospect->notes = $request->notes;
            $prospect->save();

            ProspectHistory::create([
                'prospect_id' => $prospect->id,
                'content' => 'Pasta foi reprovada pelo usuário ' . auth()->user()->email,
                'type' => 'log',
                'ip' => $request->ip(),
            ]);

            ProspectHistory::create([
                'prospect_id' => $prospect->id,
                'content' => 'Proposta reprovada!',
                'notes' => $request->notes,
                'type' => 'status',
                'ip' => $request->ip(),
            ]);
        });

        Alert::success('Sucesso', 'Pasta reprovada com sucesso');

        return redirect()->route('prospects.data', ['prospect' => $prospect->id]);
    }

    public function destroy(Prospect $prospect, Request $request)
    {
        DB::transaction(function () use ($prospect, $request) {
            $code = Code::where('prospect_id', $prospect->id)->first();

            if ($code != null) {
                $code->delete();
            }

            $prospect->delete();

            ProspectHistory::create([
                'prospect_id' => $prospect->id,
                'content' => 'Pasta foi excluída pelo usuário ' . auth()->user()->email,
                'type' => 'log',
                'ip' => $request->ip(),
            ]);

            ProspectHistory::create([
                'prospect_id' => $prospect->id,
                'content' => 'Proposta excluída!',
                'notes' => $request->notes,
                'type' => 'data',
                'ip' => $request->ip(),
            ]);
        });

        Alert::success('Sucesso', 'Pasta excluída com sucesso');

        return redirect()->route('prospects.index', ['status' => $prospect->status]);
    }
}
