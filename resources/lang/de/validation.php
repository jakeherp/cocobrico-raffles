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

    'accepted'             => ':attribute muss akzeptiert werden.',
    'active_url'           => ':attribute ist keine gültige URL.',
    'after'                => ':attribute muss nach :date liegen.',
    'alpha'                => ':attribute darf nur Buchstaben beinhalten.',
    'alpha_dash'           => ':attribute darf nur Buchstaben, Zahlen und Bindestriche beinhalten.',
    'alpha_num'            => ':attribute darf nur Buchstaben und Zahlen beinhalten.',
    'array'                => ':attribute muss ein Array sein.',
    'before'               => ':attribute muss vor :date liegen.',
    'between'              => [
        'numeric' => ':attribute muss zwischen :min und :max liegen.',
        'file'    => ':attribute muss zwischen :min und :max kb groß sein.',
        'string'  => ':attribute muss zwischen :min und :max Zeichen beinhalten.',
        'array'   => ':attribute muss zwischen :min und :max Objekte beinhalten.',
    ],
    'boolean'              => ':attribute muss wahr oder falsch sein.',
    'confirmed'            => ':attribute Bestätigung stimmt nicht überein.',
    'date'                 => ':attribute ist kein gültiges Datum.',
    'date_format'          => ':attribute stimmt nicht mit dem Format :format überein.',
    'different'            => ':attribute und :other dürfen nicht gleich sein.',
    'digits'               => ':attribute muss :digits Zeichen enthalten.',
    'digits_between'       => ':attribute muss zwischen :min und :max Zeichen enthalten.',
    'email'                => ':attribute muss eine gültige Email-Adresse sein.',
    'exists'               => ':attribute ist ungültig.',
    'filled'               => ':attribute ist ein Pflichtfeld.',
    'image'                => ':attribute muss ein Bild sein.',
    'in'                   => ':attribute ist ungültig.',
    'integer'              => ':attribute muss eine Zahl sein.',
    'ip'                   => ':attribute muss eine IP Adresse sein.',
    'json'                 => ':attribute muss ein JSON String sein.',
    'max'                  => [
        'numeric' => ':attribute muss größer als :max sein.',
        'file'    => ':attribute darf nicht größer als :max kb sein.',
        'string'  => ':attribute darf nicht mehr als :max Zeichen haben.',
        'array'   => ':attribute darf nicht mehr als :max Objekte beinhalten.',
    ],
    'mimes'                => ':attribute muss eine der folgenden Dateien sein: :values.',
    'min'                  => [
        'numeric' => ':attribute muss mindestens :min sein.',
        'file'    => ':attribute muss mindestens :min kb groß sein.',
        'string'  => ':attribute muss mindestens :min Zeichen haben.',
        'array'   => ':attribute muss mindestens :min Objekte beinhalten.',
    ],
    'not_in'               => ':attribute ist ungültig.',
    'numeric'              => ':attribute muss eine Zahl sein.',
    'regex'                => ':attribute Format ist ungültig.',
    'required'             => ':attribute Feld ist ein Pflichtfeld.',
    'required_if'          => ':attribute Feld ist ein Pflichtfeld wenn :other :value ist.',
    'required_unless'      => ':attribute Feld ist ein Pflichtfeld, außer wenn :other :values ist.',
    'required_with'        => ':attribute Feld ist ein Pflichtfeld, wenn :values present ist.',
    'required_with_all'    => ':attribute Feld ist ein Pflichtfeld, wenn :values zutrifft.',
    'required_without'     => ':attribute Feld ist ein Pflichtfeld, wenn :values nicht zutrifft.',
    'required_without_all' => ':attribute Feld ist ein Pflichtfeld, wenn weder :values zutreffen.',
    'same'                 => ':attribute und :other müssen übereinstimmen.',
    'size'                 => [
        'numeric' => ':attribute muss :size.',
        'file'    => ':attribute muss :size kb groß sein.',
        'string'  => ':attribute muss :size Zeichen haben.',
        'array'   => ':attribute muss :size Objekte beinhalten.',
    ],
    'string'               => ':attribute muss ein String sein.',
    'timezone'             => ':attribute muss eine gültige Zeitzone sein.',
    'unique'               => ':attribute ist bereits vergeben.',
    'url'                  => ':attribute Format ist ungültig.',

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
