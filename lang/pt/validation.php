<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | following language lines contain default error messages used by
    | validator class. Some of these rules have multiple versions such
    | as size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute precisa ser aceito.',
    'accepted_if' => ':attribute precisa ser aceito quando :other é :value.',
    'active_url' => ':attribute não é uma URL válida.',
    'after' => ':attribute deve ser uma data após :date.',
    'after_or_equal' => ':attribute deve ser uma data após ou igual a :date.',
    'alpha' => ':attribute deve conter apenas letras.',
    'alpha_dash' => ':attribute deve conter apenas letras, números, traços e underscores.',
    'alpha_num' => ':attribute deve conter apenas letrase números.',
    'array' => ':attribute deve ser uma coleção.',
    'before' => ':attribute deve ser uma data anterior a :date.',
    'before_or_equal' => ':attribute deve ser uma data anterior ou igual a :date.',
    'between' => [
        'numeric' => ':attribute deve ser um número entre :min e :max.',
        'file' => ':attribute deve ter um tamanho entre :min e :max kilobytes.',
        'string' => ':attribute deve ter entre :min e :max caracteres.',
        'array' => ':attribute deve ter entre :min e :max itens.',
    ],
    'boolean' => ':attribute deve ser verdadeiro ou falso.',
    'confirmed' => 'A confirmação de :attribute não confere.',
    'current_password' => 'A senha está incorreta.',
    'date' => ':attribute não é uma data válida.',
    'date_equals' => ':attribute deve ser uma data igual a :date.',
    'date_format' => ':attribute não atende ao formato de data :format.',
    'declined' => ':attribute deve ser recusado.',
    'declined_if' => ':attribute deve ser recusado quand :other é :value.',
    'different' => ':attribute e :other devem ser diferentes.',
    'digits' => ':attribute deve ter :digits dígitos.',
    'digits_between' => ':attribute deve ter entre :min e :max dígitos.',
    'dimensions' => ':attribute tem um tamanho inválido.',
    'distinct' => ':attribute tem um valor duplicado.',
    'email' => ':attribute deve ser um email válido.',
    'ends_with' => ':attribute deve terminar com algum dos valores: :values.',
    'enum' => 'O valor selecionado, :attribute, é invalido.',
    'exists' => 'O valor selecionado :attribute é inválido.',
    'file' => ':attribute deve ser um arquivo.',
    'filled' => ':attribute deve ser preenchido.',
    'gt' => [
        'numeric' => ':attribute deve ser maior que :value.',
        'file' => ':attribute deve ter um tamanho maior que :value kilobytes.',
        'string' => ':attribute deve ter um tamanho maior que :value carac.',
        'array' => ':attribute deve ter mais que :value itens.',
    ],
    'gte' => [
        'numeric' => ':attribute deve ser maior ou igual a :value.',
        'file' => ':attribute deve ter tamanho maior ou igual a :value kilobytes.',
        'string' => ':attribute deve ter mais ou exatamente :value caracteres.',
        'array' => ':attribute deve ter :value itens ou mais.',
    ],
    'image' => ':attribute deve ser uma imagem.',
    'in' => 'selected :attribute é inválido.',
    'in_array' => ':attribute não existe em :other.',
    'integer' => ':attribute deve ser um número inteiro.',
    'ip' => ':attribute deve ser um IP válido.',
    'ipv4' => ':attribute deve ser um IPv4 válido.',
    'ipv6' => ':attribute deve ser um IPv6 válido.',
    'mac_address' => ':attribute deve ser um MAC address válido.',
    'json' => ':attribute deve ser uma string JSON válida.',
    'lt' => [
        'numeric' => ':attribute deve ser menor que :value.',
        'file' => ':attribute deve ter um tamanho menor que :value kilobytes.',
        'string' => ':attribute deve ter um tamanho menor que :value caracteres.',
        'array' => ':attribute deve ter menos que :value itens.',
    ],
    'lte' => [
        'numeric' => ':attribute deve ser menor ou igual a :value.',
        'file' => ':attribute deve ter um tamanho menor ou igual a :value kilobytes.',
        'string' => ':attribute deve ter menos ou exatamente :value caracters.',
        'array' => ':attribute deve ter menos que :value itens.',
    ],
    'max' => [
        'numeric' => ':attribute não deve ser maior que :max.',
        'file' => ':attribute não deve ter tamanho maior que :max kilobytes.',
        'string' => ':attribute não deve ser maior que :max caracteres.',
        'array' => ':attribute não deve ter mais que :max itens.',
    ],
    'mimes' => ':attribute deve ser um arquivo do(s) tipo(s): :values.',
    'mimetypes' => ':attribute deve ser um arquivo do(s) tipo(s): :values.',
    'min' => [
        'numeric' => ':attribute deve ser ao menos :min.',
        'file' => ':attribute deve ter ao menos :min kilobytes.',
        'string' => ':attribute deve ter ao menos :min caracteres.',
        'array' => ':attribute deve ter ao menos :min itens.',
    ],
    'multiple_of' => ':attribute deve ser um múltiplo de :value.',
    'not_in' => 'O item selecionado :attribute é inválido.',
    'not_regex' => 'O formato de :attribute é inválido.',
    'numeric' => ':attribute deve ser um número.',
    'password' => 'A senha está incorreta.',
    'present' => ':attribute deve estar presente.',
    'prohibited' => ':attribute é proibido.',
    'prohibited_if' => ':attribute é proibido quando :other é :value.',
    'prohibited_unless' => ':attribute é proibido a menos que :other esteja em :values.',
    'prohibits' => ':attribute proíbe :other de estar presente.',
    'regex' => 'O formato de :attribute é inválido.',
    'required' => ':attribute é obrigatório.',
    'required_if' => ':attribute é obrigatório uando :other é :value.',
    'required_unless' => ':attribute é obrigatório a menos que :other esteja em :values.',
    'required_with' => ':attribute é obrigatório quando :values está presente.',
    'required_with_all' => ':attribute é obrigatório quando :values estão presentes.',
    'required_without' => ':attribute obrigatório quando :values não estão presentes.',
    'required_without_all' => ':attribute é obrigatório quando nenhum de :values está presente.',
    'same' => ':attribute e :other devem conferir.',
    'size' => [
        'numeric' => ':attribute deve ser :size.',
        'file' => ':attribute deve ter :size kilobytes.',
        'string' => ':attribute deve ter :size caracteres.',
        'array' => ':attribute deve ter :size itens.',
    ],
    'starts_with' => ':attribute deve começar com um destes valores: :values.',
    'string' => ':attribute deve ter formato text.',
    'timezone' => ':attribute deve ser um fuso horário válido.',
    'unique' => ':attribute já está em uso.',
    'uploaded' => ':attribute falhou ao ser carregado.',
    'url' => ':attribute deve set uma URL válida.',
    'uuid' => ':attribute deve ser um UUID válido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'broker_email' => [
            'required_unless' => 'O Email do corretor é obrigatório.'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'password' => 'Senha',
        'email' => 'Email',
        'name' => 'Nome',
        'phone' => 'Telefone',
        'responsible' => 'Responsável',
        'cnpj' => 'CNPJ',
        'creci' => 'CRECI',
        'cpf' => 'CPF',
        'password' => 'Senha',
        'accept_terms' => 'Aceitar os termos de uso',
        'slug' => 'Chave web',
        'title' => 'Título',
        'start_date' => 'Data inicial',
        'end_date' => 'Data final',
        'access_profile' => 'Perfil de acesso',
        'preferences' => 'Preferências',
        'occupation' => 'Profissão',
        'copart_marriage_regime' => 'Regime de matrimônio'
    ],

];
