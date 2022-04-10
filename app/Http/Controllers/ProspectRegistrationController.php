<?php

namespace App\Http\Controllers;

use App\Models\CoparticipantDocument;
use App\Models\Gdpr;
use App\Models\Product;
use App\Models\Prospect;
use App\Models\ProspectDocument;
use App\Models\ProspectHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class ProspectRegistrationController extends Controller
{
    public function index(Product $product)
    {
        if (!$product->enable_prospects) {
            Alert::error('Desativado', 'Desculpe, mas o cadastro de pastas está bloqueado.');
            return redirect()->route('welcome');
        }

        return view('prospects.registration.index')
            ->with('product', $product);
    }

    public function checkBroker(Product $product, Request $request)
    {
        $request->validate([
            'broker_email' => 'required_unless:havent_broker,on|max:100|nullable|email',
        ]);

        if ($product->allow_customer_without_broker && $request->havent_broker == 'on') {
            $broker = User::find($product->fake_broker_id)
                ->where('user_status', 'active')
                ->first();

            if ($broker == null) {
                Alert::error('Pasta sem corretor', 'Não foi possível prosseguir sem informar um corretor. Por favor, entre em contato com a administração.');
                throw ValidationException::withMessages(['broker_email' => 'Não foi possível prosseguir sem informar um corretor. Por favor, entre em contato com a administração.']);
                return;
            }
        } else {
            $broker = User::where('email', $request->broker_email)
                ->where('user_status', 'active')
                ->first();

            if ($broker == null) {
                Alert::error('Corretor não encontrado', 'Corretor não encontrado ou inativo. Por favor, informe outro.');
                throw ValidationException::withMessages(['broker_email' => 'Corretor não encontrado ou inativo. Por favor, informe outro.']);
            }
        }

        $prospect = Prospect::create([
            'broker_id' => $broker->id,
            'marital_state' => 'undefined',
            'marriage_regime' => 'none',
            'status' => 'temp',
            'product_id' => $product->id,
            'has_broker' => $request->havent_broker != 'on',
        ]);

        $content = 'Cliente avançou ';

        if ($request->havent_broker != 'on') {
            $content = $content . 'informando o email do corretor ' . $request->broker_email;
        } else {
            $content = $content . 'não informando um corretor, sendo considerado o corretor ' . $broker->email . ' como padrão';
        }

        ProspectHistory::create([
            'prospect_id' => $prospect->id,
            'content' => $content,
            'type' => 'log',
            'ip' => $request->ip(),
        ]);

        return redirect()->route('prospects.registration.customer-data', ['product' => $product->id, 'prospect' => $prospect->id]);
    }

    public function customerDataIndex(Product $product, Prospect $prospect)
    {
        if ($prospect->status != 'temp') {
            Alert::warning('Cadastro já enviado', 'Este cadastro já foi finalizado e enviado. Por favor, aguarde nosso contato ou realize um novo cadastro de compra.');
            return redirect()->route('welcome');
        }

        return view('prospects.registration.customer-data')
            ->with('product', $product)
            ->with('prospect', $prospect);
    }

    public function customerDataStore(Product $product, Prospect $prospect, Request $request)
    {
        if ($prospect->status != 'temp') {
            Alert::warning('Cadastro já enviado', 'Este cadastro já foi finalizado e enviado. Por favor, aguarde nosso contato ou realize um novo cadastro de compra.');
            return redirect()->route('welcome');
        }

        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|max:100|email',
            'cpf_cnpj' => 'required|string|max:14',
            'phone' => 'required|string|max:20',
            'occupation' => 'required|string|max:100',
            'marital_state' => 'required|string|in:single,married,divorced,widowed,undefined',
            'preferences' => 'required',
        ]);

        $prospect->name = $request->name;
        $prospect->email = $request->email;
        $prospect->cpf_cnpj = $request->cpf_cnpj;
        $prospect->phone = $request->phone;
        $prospect->occupation = $request->occupation;
        $prospect->marital_state = $request->marital_state;
        $prospect->customer_preferences = $request->preferences;

        $prospect->save();

        $content = 'Cliente avançou informando seus dados básicos';

        ProspectHistory::create([
            'prospect_id' => $prospect->id,
            'content' => $content,
            'type' => 'log',
            'ip' => $request->ip(),
        ]);

        return redirect()->route('prospects.registration.documents', ['product' => $product->id, 'prospect' => $prospect->id]);
    }

    public function documentsIndex(Product $product, Prospect $prospect)
    {
        if ($prospect->status != 'temp') {
            Alert::warning('Cadastro já enviado', 'Este cadastro já foi finalizado e enviado. Por favor, aguarde nosso contato ou realize um novo cadastro de compra.');
            return redirect()->route('welcome');
        }

        return view('prospects.registration.documents')
            ->with('product', $product)
            ->with('prospect', $prospect);
    }

    public function documentsStore(Product $product, Prospect $prospect, Request $request)
    {
        if ($prospect->status != 'temp') {
            Alert::warning('Cadastro já enviado', 'Este cadastro já foi finalizado e enviado. Por favor, aguarde nosso contato ou realize um novo cadastro de compra.');
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

        $documents = '';

        if ($request->hasFile('cpf_cnh')) {
            $documents = $documents . ' CPF/CNPJ,';

            $file = $request->file('cpf_cnh');

            $name = uniqid() . '-cpf-cnh-' . $prospect->id . '.' . $file->getClientOriginalExtension();
            $filePath = 'documents/' . $prospect->id . '/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $path = Storage::disk('s3')->url($filePath);

            ProspectDocument::create([
                'prospect_id' => $prospect->id,
                'type' => 'cpf_cnh',
                'url' => $path,
            ]);
        }

        if ($request->hasFile('rg')) {
            $documents = $documents . ' RG,';

            $file = $request->file('rg');

            $name = uniqid() . '-rg-' . $prospect->id . '.' . $file->getClientOriginalExtension();
            $filePath = 'documents/' . $prospect->id . '/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $path = Storage::disk('s3')->url($filePath);

            ProspectDocument::create([
                'prospect_id' => $prospect->id,
                'type' => 'rg',
                'url' => $path,
            ]);
        }

        if ($request->hasFile('comp_res')) {
            $documents = $documents . ' Comprovante de residência,';

            $file = $request->file('comp_res');

            $name = uniqid() . '-comp_res-' . $prospect->id . '.' . $file->getClientOriginalExtension();
            $filePath = 'documents/' . $prospect->id . '/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $path = Storage::disk('s3')->url($filePath);

            ProspectDocument::create([
                'prospect_id' => $prospect->id,
                'type' => 'comp_res',
                'url' => $path,
            ]);
        }

        if ($request->hasFile('comp_est_civil')) {
            $documents = $documents . ' Comprovante de estado civil,';

            $file = $request->file('comp_est_civil');

            $name = uniqid() . '-comp_est_civil-' . $prospect->id . '.' . $file->getClientOriginalExtension();
            $filePath = 'documents/' . $prospect->id . '/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $path = Storage::disk('s3')->url($filePath);

            ProspectDocument::create([
                'prospect_id' => $prospect->id,
                'type' => 'comp_est_civil',
                'url' => $path,
            ]);
        }

        if ($request->hasFile('advb_est_civil')) {
            $documents = $documents . ' Adverbação de estado civil,';

            $file = $request->file('advb_est_civil');

            $name = uniqid() . '-advb_est_civil-' . $prospect->id . '.' . $file->getClientOriginalExtension();
            $filePath = 'documents/' . $prospect->id . '/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $path = Storage::disk('s3')->url($filePath);

            ProspectDocument::create([
                'prospect_id' => $prospect->id,
                'type' => 'advb_est_civil',
                'url' => $path,
            ]);
        }

        if ($request->hasFile('com_renda')) {
            $documents = $documents . ' Comprovante de renda,';

            $file = $request->file('com_renda');

            $name = uniqid() . '-com_renda-' . $prospect->id . '.' . $file->getClientOriginalExtension();
            $filePath = 'documents/' . $prospect->id . '/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $path = Storage::disk('s3')->url($filePath);

            ProspectDocument::create([
                'prospect_id' => $prospect->id,
                'type' => 'com_renda',
                'url' => $path,
            ]);
        }

        if ($request->hasFile('other')) {
            $documents = $documents . ' Outro tipo de documento,';

            $file = $request->file('other');

            $name = uniqid() . '-other-' . $prospect->id . '.' . $file->getClientOriginalExtension();
            $filePath = 'documents/' . $prospect->id . '/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $path = Storage::disk('s3')->url($filePath);

            ProspectDocument::create([
                'prospect_id' => $prospect->id,
                'type' => 'other',
                'url' => $path,
            ]);
        }

        $content = 'Cliente avançou enviando (upload) cópia(s) de seus documentos: ' . rtrim(trim($documents), ",");

        ProspectHistory::create([
            'prospect_id' => $prospect->id,
            'content' => $content,
            'type' => 'log',
            'ip' => $request->ip(),
        ]);

        return redirect()->route('prospects.registration.co-participant', ['product' => $product->id, 'prospect' => $prospect->id]);
    }

    public function coParticipantIndex(Product $product, Prospect $prospect)
    {
        if ($prospect->status != 'temp') {
            Alert::warning('Cadastro já enviado', 'Este cadastro já foi finalizado e enviado. Por favor, aguarde nosso contato ou realize um novo cadastro de compra.');
            return redirect()->route('welcome');
        }

        return view('prospects.registration.co-participant')
            ->with('product', $product)
            ->with('prospect', $prospect);
    }

    public function coParticipantStore(Product $product, Prospect $prospect, Request $request)
    {
        if ($prospect->status != 'temp') {
            Alert::warning('Cadastro já enviado', 'Este cadastro já foi finalizado e enviado. Por favor, aguarde nosso contato ou realize um novo cadastro de compra.');
            return redirect()->route('welcome');
        }

        $request->validate([
            'has_coparticipant' => 'required|in:true,false',
        ]);

        $prospect->has_coparticipant = $request->has_coparticipant;

        if ($request->has_coparticipant == 'true') {
            $request->validate([
                'name' => 'required|max:100',
                'email' => 'required|max:100|email',
                'cpf_cnpj' => 'required|string|max:14',
                'phone' => 'required|string|max:20',
                'occupation' => 'required|string|max:100',
                'marital_state' => 'required|string|in:single,married,divorced,widowed,undefined',
            ]);

            $prospect->copart_name = $request->name;
            $prospect->copart_email = $request->email;
            $prospect->copart_cpf_cnpj = $request->cpf_cnpj;
            $prospect->copart_phone = $request->phone;
            $prospect->copart_occupation = $request->occupation;
            $prospect->copart_marital_state = $request->marital_state;
        }

        $prospect->save();

        $content = 'Cliente avançou ';

        if ($request->has_coparticipant == 'true') {
            $content = $content . ' informando dados básicos de um coparticipante em seu cadastro';
        } else {
            $content = $content . ' sem nenhum coparticipante em seu cadastro';
        }

        ProspectHistory::create([
            'prospect_id' => $prospect->id,
            'content' => $content,
            'type' => 'log',
            'ip' => $request->ip(),
        ]);

        if ($request->has_coparticipant == 'true') {
            return redirect()->route('prospects.registration.co-participant.documents', ['product' => $product->id, 'prospect' => $prospect->id]);
        } else {
            return redirect()->route('prospects.registration.review', ['product' => $product->id, 'prospect' => $prospect->id]);
        }
    }

    public function coparticipantDocumentsIndex(Product $product, Prospect $prospect)
    {
        if ($prospect->status != 'temp') {
            Alert::warning('Cadastro já enviado', 'Este cadastro já foi finalizado e enviado. Por favor, aguarde nosso contato ou realize um novo cadastro de compra.');
            return redirect()->route('welcome');
        }

        return view('prospects.registration.co-participant-documents')
            ->with('product', $product)
            ->with('prospect', $prospect);
    }

    public function coparticipantDocumentsStore(Product $product, Prospect $prospect, Request $request)
    {
        if ($prospect->status != 'temp') {
            Alert::warning('Cadastro já enviado', 'Este cadastro já foi finalizado e enviado. Por favor, aguarde nosso contato ou realize um novo cadastro de compra.');
            return redirect()->route('welcome');
        }

        if ($prospect->has_coparticipant == false) {
            return redirect()->route('prospects.registration.review', ['product' => $product->id, 'prospect' => $prospect->id]);
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

        $documents = '';

        if ($request->hasFile('cpf_cnh')) {
            $documents = $documents . ' CPF/CNPJ,';

            $file = $request->file('cpf_cnh');

            $name = uniqid() . '-cpf-cnh-' . $prospect->id . '.' . $file->getClientOriginalExtension();
            $filePath = 'documents/' . $prospect->id . '/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $path = Storage::disk('s3')->url($filePath);

            CoparticipantDocument::create([
                'prospect_id' => $prospect->id,
                'type' => 'cpf_cnh',
                'url' => $path,
            ]);
        }

        if ($request->hasFile('rg')) {
            $documents = $documents . ' RG,';

            $file = $request->file('rg');

            $name = uniqid() . '-rg-' . $prospect->id . '.' . $file->getClientOriginalExtension();
            $filePath = 'documents/' . $prospect->id . '/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $path = Storage::disk('s3')->url($filePath);

            CoparticipantDocument::create([
                'prospect_id' => $prospect->id,
                'type' => 'rg',
                'url' => $path,
            ]);
        }

        if ($request->hasFile('comp_res')) {
            $documents = $documents . ' Comprovante de residência,';

            $file = $request->file('comp_res');

            $name = uniqid() . '-comp_res-' . $prospect->id . '.' . $file->getClientOriginalExtension();
            $filePath = 'documents/' . $prospect->id . '/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $path = Storage::disk('s3')->url($filePath);

            CoparticipantDocument::create([
                'prospect_id' => $prospect->id,
                'type' => 'comp_res',
                'url' => $path,
            ]);
        }

        if ($request->hasFile('comp_est_civil')) {
            $documents = $documents . ' Comprovante de estado civil,';

            $file = $request->file('comp_est_civil');

            $name = uniqid() . '-comp_est_civil-' . $prospect->id . '.' . $file->getClientOriginalExtension();
            $filePath = 'documents/' . $prospect->id . '/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $path = Storage::disk('s3')->url($filePath);

            CoparticipantDocument::create([
                'prospect_id' => $prospect->id,
                'type' => 'comp_est_civil',
                'url' => $path,
            ]);
        }

        if ($request->hasFile('advb_est_civil')) {
            $documents = $documents . ' Adverbação de estado civil,';

            $file = $request->file('advb_est_civil');

            $name = uniqid() . '-advb_est_civil-' . $prospect->id . '.' . $file->getClientOriginalExtension();
            $filePath = 'documents/' . $prospect->id . '/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $path = Storage::disk('s3')->url($filePath);

            CoparticipantDocument::create([
                'prospect_id' => $prospect->id,
                'type' => 'advb_est_civil',
                'url' => $path,
            ]);
        }

        if ($request->hasFile('com_renda')) {
            $documents = $documents . ' Comprovante de renda,';

            $file = $request->file('com_renda');

            $name = uniqid() . '-com_renda-' . $prospect->id . '.' . $file->getClientOriginalExtension();
            $filePath = 'documents/' . $prospect->id . '/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $path = Storage::disk('s3')->url($filePath);

            CoparticipantDocument::create([
                'prospect_id' => $prospect->id,
                'type' => 'com_renda',
                'url' => $path,
            ]);
        }

        if ($request->hasFile('other')) {
            $documents = $documents . ' Outro tipo de documento,';

            $file = $request->file('other');

            $name = uniqid() . '-other-' . $prospect->id . '.' . $file->getClientOriginalExtension();
            $filePath = 'documents/' . $prospect->id . '/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $path = Storage::disk('s3')->url($filePath);

            CoparticipantDocument::create([
                'prospect_id' => $prospect->id,
                'type' => 'other',
                'url' => $path,
            ]);
        }

        $content = 'Cliente avançou enviando (upload) cópia(s) dos documentos do coparticipante: ' . rtrim(trim($documents), ",");

        ProspectHistory::create([
            'prospect_id' => $prospect->id,
            'content' => $content,
            'type' => 'log',
            'ip' => $request->ip(),
        ]);

        return redirect()->route('prospects.registration.review', ['product' => $product->id, 'prospect' => $prospect->id]);
    }

    public function reviewIndex(Product $product, Prospect $prospect)
    {
        if ($prospect->status != 'temp') {
            Alert::warning('Cadastro já enviado', 'Este cadastro já foi finalizado e enviado. Por favor, aguarde nosso contato ou realize um novo cadastro de compra.');
            return redirect()->route('welcome');
        }

        return view('prospects.registration.review')
            ->with('product', $product)
            ->with('prospect', $prospect);
    }

    public function termsIndex(Product $product, Prospect $prospect, Request $request)
    {
        $content = 'Cliente avançou revisando seus dados e confirmando os mesmos';

        ProspectHistory::create([
            'prospect_id' => $prospect->id,
            'content' => $content,
            'type' => 'log',
            'ip' => $request->ip(),
        ]);

        if ($prospect->status != 'temp') {
            Alert::warning('Cadastro já enviado', 'Este cadastro já foi finalizado e enviado. Por favor, aguarde nosso contato ou realize um novo cadastro de compra.');
            return redirect()->route('welcome');
        }

        $gdpr = Gdpr::where('type', 'privacy')->first();
        return view('prospects.registration.terms')
            ->with('product', $product)
            ->with('prospect', $prospect)
            ->with('privacy', $gdpr);
    }

    public function finish(Product $product, Prospect $prospect, Request $request)
    {
        $content = 'Cliente aceitou os termos de cadastro e proteção de dados e finalizou o registro';

        ProspectHistory::create([
            'prospect_id' => $prospect->id,
            'content' => $content,
            'type' => 'log',
            'ip' => $request->ip(),
        ]);

        if ($prospect->status != 'temp') {
            Alert::warning('Cadastro já enviado', 'Este cadastro já foi finalizado e enviado. Por favor, aguarde nosso contato ou realize um novo cadastro de compra.');
            return redirect()->route('welcome');
        }

        $request->validate([
            'accept_terms' => 'required|accepted|in:true,false',
            'accept_privacy' => 'required|accepted|in:true,false',
        ]);

        $prospect->document_code = $this->GUID();
        $prospect->status = 'open';
        $prospect->save();

        $content = 'Cliente concluiu o cadastro de intenção de compra';

        ProspectHistory::create([
            'prospect_id' => $prospect->id,
            'content' => $content,
            'type' => 'log',
            'ip' => $request->ip(),
        ]);

        ProspectHistory::create([
            'prospect_id' => $prospect->id,
            'content' => 'Proposta cadastrada com sucesso',
            'type' => 'data',
            'ip' => $request->ip(),
        ]);

        Alert::success('Sucesso', 'Cadastro finalizado com sucesso. Em breve entraremos em contato.');

        return redirect()->route('welcome');
    }

    private function GUID()
    {
        if (function_exists('com_create_guid') === true) {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }
}
