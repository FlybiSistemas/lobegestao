<?php

return [
    'accepted'             => 'O :attribute deve ser aceito.',
    'active_url'           => 'O :attribute não é uma URL válida.',
    'after'                => 'O :attribute deve ser uma data posterior a :date.',
    'after_or_equal'       => 'O :attribute deve ser uma data posterior ou igual a :date.',
    'alpha'                => 'O :attribute deve conter somente letras.',
    'alpha_dash'           => 'O :attribute deve conter letras, números e traços.',
    'alpha_num'            => 'O :attribute deve conter somente letras e números.',
    'array'                => 'O :attribute deve ser um array.',
    'before'               => 'O :attribute deve ser uma data anterior a :date.',
    'before_or_equal'      => 'O :attribute deve ser uma data anterior ou igual a :date.',
    'between'              => [
        'numeric' => 'O :attribute deve estar entre :min e :max.',
        'file'    => 'O :attribute deve estar entre :min e :max kilobytes.',
        'string'  => 'O :attribute deve estar entre :min e :max caracteres.',
        'array'   => 'O :attribute deve ter entre :min e :max itens.',
    ],
    'boolean'              => 'O :attribute deve ser verdadeiro ou falso.',
    'confirmed'            => 'A confirmação de :attribute não confere.',
    'date'                 => 'O :attribute não é uma data válida.',
    'date_format'          => 'O :attribute não confere com o formato :format.',
    'different'            => 'O :attribute e :other devem ser diferentes.',
    'digits'               => 'O :attribute deve ter :digits dígitos.',
    'digits_between'       => 'O :attribute deve ter entre :min e :max dígitos.',
    'dimensions'           => 'O :attribute não tem dimensões válidas.',
    'distinct'             => 'O :attribute campo contém um valor duplicado.',
    'email'                => 'O :attribute deve ser um endereço de e-mail válido.',
    'exists'               => 'O :attribute selecionado é inválido.',
    'file'                 => 'O :attribute precisa ser um arquivo.',
    'filled'               => 'O :attribute é um campo obrigatório.',
    'image'                => 'O :attribute deve ser uma imagem.',
    'in'                   => 'O :attribute é inválido.',
    'in_array'             => 'O :attribute campo não existe em :other.',
    'integer'              => 'O :attribute deve ser um inteiro.',
    'ip'                   => 'O :attribute deve ser um endereço IP válido.',
    'json'                 => 'O :attribute deve ser um JSON válido.',
    'max'                  => [
        'numeric' => 'O :attribute não deve ser maior que :max.',
        'file'    => 'O :attribute não deve ter mais que :max kilobytes.',
        'string'  => 'O :attribute não deve ter mais que :max caracteres.',
        'array'   => 'O :attribute não pode ter mais que :max itens.',
    ],
    'mimes'                => 'O :attribute deve ser um arquivo do tipo: :values.',
    'mimetypes'            => 'O :attribute deve ser um arquivo do tipo: :values.',
    'min'                  => [
        'numeric' => 'O :attribute deve ser no mínimo :min.',
        'file'    => 'O :attribute deve ter no mínimo :min kilobytes.',
        'string'  => 'O :attribute deve ter no mínimo :min caracteres.',
        'array'   => 'O :attribute deve ter no mínimo :min itens.',
    ],
    'not_in'               => 'O :attribute selecionado é inválido.',
    'numeric'              => 'O :attribute deve ser um número.',
    'present'              => 'O :attribute deve estar presente.',
    'regex'                => 'O formato de :attribute é inválido.',
    'required'             => 'O campo :attribute é obrigatório.',
    'required_if'          => 'O campo :attribute é obrigatório quando :other é :value.',
    'required_unless'      => 'O :attribute é necessário a menos que :other esteja em :values.',
    'required_with'        => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_with_all'    => 'O campo :attribute é obrigatório quando :values estão presentes.',
    'required_without'     => 'O campo :attribute é obrigatório quando :values não está presente.',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum destes estão presentes: :values.',
    'same'                 => 'O :attribute e :other devem ser iguais.',
    'size'                 => [
        'numeric' => 'O :attribute deve ser :size.',
        'file'    => 'O :attribute deve ter :size kilobytes.',
        'string'  => 'O :attribute deve ter :size caracteres.',
        'array'   => 'O :attribute deve conter :size itens.',
    ],
    'string'               => 'O :attribute deve ser uma string',
    'timezone'             => 'O :attribute deve ser uma timezone válida.',
    'unique'               => 'O :attribute já está em uso.',
    'uploaded'             => 'O :attribute falhou no upload.',
    'url'                  => 'O formato de :attribute é inválido.',
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */
    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */
    'attributes' => [
        'bairro'                            => 'Bairro',
        'casas_decimais'                    => 'Casas Decimais',
        'cep'                               => 'CEP',
        'cidade'                            => 'Cidade',
        'cnpj'                              => 'CNPJ',
        'cnpj_cpf'                          => 'CNPJ/CPF',
        'codigo'                            => 'Código',
        'complemento'                       => 'Complemento',
        'cpf'                               => 'CPF',
        'data'                              => 'Data',
        'data_base'                         => 'Data Base',
        'data_baixa'                        => 'Data da Baixa',
        'data_contrato'                     => 'Data do Contrato',
        'data_emissao'                      => 'Data de Emissão',
        'data_fim'                          => 'Data Fim',
        'data_inicio'                       => 'Data de Início',
        'data_nascimento'                   => 'Data de Nascimento.',
        'data_vencimento'                   => 'Data de Vencimento',
        'dia_semana'                        => 'Dia da Semana',
        'email'                             => 'E-mail',
        'fone1'                             => 'Telefone',
        'fone2'                             => 'Telefone 2',
        'fone3'                             => 'Telefone 3',
        'logradouro'                        => 'Logradouro',
        'nome'                              => 'Nome',
        'razao'                             => 'Razão Social',
        'sexo'                              => 'Sexo',
        'uf'                                => 'UF',
        'valor'                             => 'Valor',

    ],
    'recaptcha' => 'Por favor, resolva o captcha acima.',
];
