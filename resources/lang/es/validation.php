<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'El :attribute debe ser aceptado.',
    'active_url'           => 'El :attribute no es una URL válida.',
    'after'                => 'El :attribute debe ser una fecha después de :date.',
    'after_or_equal'       => 'El :attribute debe ser una fecha después o igual a :date.',
    'alpha'                => 'El :attribute sólo puede contener letras.',
    'alpha_dash'           => 'El :attribute sólo puede contener letras, números, y guiónes bajos.',
    'alpha_num'            => 'El :attribute sólo puede contener letrás y números.',
    'array'                => 'El :attribute debe ser un array.',
    'before'               => 'El :attribute debe ser una fecha antes de :date.',
    'before_or_equal'      => 'El :attribute debe ser una fecha antes o igual a :date.',
    'between'              => [
        'numeric' => 'El :attribute debe ser un número entre :min y :max.',
        'file'    => 'El :attribute debe tener entre :min y :max kilobytes.',
        'string'  => 'El :attribute debe tener entre :min y :max caracteres.',
        'array'   => 'El :attribute debe tener entre :min y :max items.',
    ],
    'boolean'              => 'El campo :attribute debe ser verdadero o falso.',
    'confirmed'            => 'El :attribute y su confirmation no concuerdan.',
    'date'                 => 'El :attribute no es una fecha válida.',
    'date_format'          => 'El :attribute no concuerda con el formato :format.',
    'different'            => 'El :attribute y :other debe ser diferentes.',
    'digits'               => 'El :attribute debe tener :digits digitos.',
    'digits_between'       => 'El :attribute debe tener entre :min y :max digitos.',
    'dimensions'           => 'La imagen :attribute tiene dimensiones inválidas.',
    'distinct'             => 'El campo :attribute tiene un valor duplicado.',
    'email'                => 'El :attribute debe ser una dirección de email.',
    'exists'               => 'El :attribute seleccionado es invalido.',
    'file'                 => 'El :attribute debe ser a archivo.',
    'filled'               => 'El campo :attribute debe tener un valor.',
    'image'                => 'El :attribute debe ser una imagen.',
    'in'                   => 'El :attribute seleccionado es invalido.',
    'in_array'             => 'El campo :attribute no existe en :other.',
    'integer'              => 'El :attribute debe ser un entero.',
    'ip'                   => 'El :attribute debe ser una dirección IP válida.',
    'ipv4'                 => 'El :attribute debe ser una dirección IPv4 válida.',
    'ipv6'                 => 'El :attribute debe ser una dirección IPv6 válida.',
    'json'                 => 'El :attribute debe ser una cadena JSON válida.',
    'max'                  => [
        'numeric' => 'El :attribute no puede ser más grande que :max.',
        'file'    => 'El :attribute no puede ser más grande que :max kilobytes.',
        'string'  => 'El :attribute no puede ser más grande que :max caracteres.',
        'array'   => 'El :attribute no puede tener más de :max items.',
    ],
    'mimes'                => 'El :attribute debe ser un archivo de tipo: :values.',
    'mimetypes'            => 'El :attribute debe ser un archivo de tipo: :values.',
    'min'                  => [
        'numeric' => 'El :attribute debe tener al menos :min.',
        'file'    => 'El :attribute debe tener al menos :min kilobytes.',
        'string'  => 'El :attribute debe tener al menos :min caracteres.',
        'array'   => 'El :attribute debe tener al menos :min items.',
    ],
    'not_in'               => 'The selected :attribute es inválido.',
    'numeric'              => 'El :attribute debe ser un número.',
    'present'              => 'El campo :attribute debe estár presente.',
    'regex'                => 'El formato del :attribute es inválido.',
    'required'             => 'El campo :attribute es requerido.',
    'required_if'          => 'El campo :attribute es requerido cuándo :other es :value.',
    'required_unless'      => 'El campo :attribute es requerido a menos que :other esté en :values.',
    'required_with'        => 'El campo :attribute es requerido cuándo :values esté presente.',
    'required_with_all'    => 'El campo :attribute es requerido cuándo :values esté presente.',
    'required_without'     => 'El campo :attribute es requerido cuándo :values no está presente.',
    'required_without_all' => 'El campo :attribute es requerido cuándo ninguno de los :values está presente.',
    'same'                 => 'El :attribute y :other deben coincidir.',
    'size'                 => [
        'numeric' => 'El :attribute debe ser :size.',
        'file'    => 'El :attribute debe tener :size kilobytes.',
        'string'  => 'El :attribute debe tener :size caracteres.',
        'array'   => 'El :attribute debe contener :size items.',
    ],
    'string'               => 'El :attribute debe ser una cadena de texto.',
    'timezone'             => 'El :attribute debe ser una zona válida.',
    'unique'               => 'El :attribute ya ha sido tomado.',
    'uploaded'             => 'El :attribute no se pudo subir.',
    'url'                  => 'El format de :attribute es inválido.',

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

    'attributes' => [],

];
