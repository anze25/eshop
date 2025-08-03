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

    'accepted' => 'Polje :attribute mora biti sprejeto.',
    'accepted_if' => 'Polje :attribute mora biti sprejeto, ko je :other :value.',
    'active_url' => 'Polje :attribute ni veljaven URL.',
    'after' => 'Polje :attribute mora biti datum po :date.',
    'after_or_equal' => 'Polje :attribute mora biti datum po ali enak :date.',
    'alpha' => 'Polje :attribute lahko vsebuje samo črke.',
    'alpha_dash' => 'Polje :attribute lahko vsebuje samo črke, številke, pomišljaje in podčrtaje.',
    'alpha_num' => 'Polje :attribute lahko vsebuje samo črke in številke.',
    'array' => 'Polje :attribute mora biti polje (array).',
    'ascii' => 'Polje :attribute lahko vsebuje samo enobajtne alfanumerične znake in simbole.',
    'before' => 'Polje :attribute mora biti datum pred :date.',
    'before_or_equal' => 'Polje :attribute mora biti datum pred ali enak :date.',
    'between' => [
        'array' => 'Polje :attribute mora imeti med :min in :max elementov.',
        'file' => 'Polje :attribute mora biti med :min in :max kilobajti.',
        'numeric' => 'Polje :attribute mora biti med :min in :max.',
        'string' => 'Polje :attribute mora biti dolgo med :min in :max znakov.',
    ],
    'boolean' => 'Polje :attribute mora biti "true" ali "false".',
    'can' => 'Polje :attribute vsebuje nepooblaščeno vrednost.',
    'confirmed' => 'Potrditev polja :attribute se ne ujema.',
    'contains' => 'Polje :attribute manjka zahtevana vrednost.',
    'current_password' => 'Geslo ni pravilno.',
    'date' => 'Polje :attribute ni veljaven datum.',
    'date_equals' => 'Polje :attribute mora biti datum, enak :date.',
    'date_format' => 'Polje :attribute se ne ujema z obliko :format.',
    'decimal' => 'Polje :attribute mora imeti :decimal decimalnih mest.',
    'declined' => 'Polje :attribute mora biti zavrnjeno.',
    'declined_if' => 'Polje :attribute mora biti zavrnjeno, ko je :other :value.',
    'different' => 'Polji :attribute in :other morata biti različni.',
    'digits' => 'Polje :attribute mora imeti :digits števk.',
    'digits_between' => 'Polje :attribute mora imeti med :min in :max števk.',
    'dimensions' => 'Polje :attribute ima neveljavne dimenzije slike.',
    'distinct' => 'Polje :attribute ima podvojeno vrednost.',
    'doesnt_end_with' => 'Polje :attribute se ne sme končati z enim od naslednjih: :values.',
    'doesnt_start_with' => 'Polje :attribute se ne sme začeti z enim od naslednjih: :values.',
    'email' => 'Polje :attribute mora biti veljaven e-poštni naslov.',
    'ends_with' => 'Polje :attribute se mora končati z enim od naslednjih: :values.',
    'enum' => 'Izbrana vrednost :attribute ni veljavna.',
    'exists' => 'Izbrana vrednost :attribute ni veljavna.',
    'extensions' => 'Polje :attribute mora imeti eno od naslednjih končnic: :values.',
    'file' => 'Polje :attribute mora biti datoteka.',
    'filled' => 'Polje :attribute mora imeti vrednost.',
    'gt' => [
        'array' => 'Polje :attribute mora imeti več kot :value elementov.',
        'file' => 'Polje :attribute mora biti večje od :value kilobajtov.',
        'numeric' => 'Polje :attribute mora biti večje od :value.',
        'string' => 'Polje :attribute mora imeti več kot :value znakov.',
    ],
    'gte' => [
        'array' => 'Polje :attribute mora imeti :value ali več elementov.',
        'file' => 'Polje :attribute mora biti večje ali enako :value kilobajtov.',
        'numeric' => 'Polje :attribute mora biti večje ali enako :value.',
        'string' => 'Polje :attribute mora imeti :value ali več znakov.',
    ],
    'hex_color' => 'Polje :attribute mora biti veljavna heksadecimalna barva.',
    'image' => 'Polje :attribute mora biti slika.',
    'in' => 'Izbrana vrednost :attribute ni veljavna.',
    'in_array' => 'Polje :attribute mora obstajati v :other.',
    'integer' => 'Polje :attribute mora biti celo število.',
    'ip' => 'Polje :attribute mora biti veljaven IP naslov.',
    'ipv4' => 'Polje :attribute mora biti veljaven IPv4 naslov.',
    'ipv6' => 'Polje :attribute mora biti veljaven IPv6 naslov.',
    'json' => 'Polje :attribute mora biti veljaven JSON niz.',
    'list' => 'Polje :attribute mora biti seznam.',
    'lowercase' => 'Polje :attribute mora biti z malimi črkami.',
    'lt' => [
        'array' => 'Polje :attribute mora imeti manj kot :value elementov.',
        'file' => 'Polje :attribute mora biti manjše od :value kilobajtov.',
        'numeric' => 'Polje :attribute mora biti manjše od :value.',
        'string' => 'Polje :attribute mora imeti manj kot :value znakov.',
    ],
    'lte' => [
        'array' => 'Polje :attribute ne sme imeti več kot :value elementov.',
        'file' => 'Polje :attribute mora biti manjše ali enako :value kilobajtov.',
        'numeric' => 'Polje :attribute mora biti manjše ali enako :value.',
        'string' => 'Polje :attribute mora imeti manj kot ali enako :value znakov.',
    ],
    'mac_address' => 'Polje :attribute mora biti veljaven MAC naslov.',
    'max' => [
        'array' => 'Polje :attribute ne sme imeti več kot :max elementov.',
        'file' => 'Polje :attribute ne sme biti večje od :max kilobajtov.',
        'numeric' => 'Polje :attribute ne sme biti večje od :max.',
        'string' => 'Polje :attribute ne sme imeti več kot :max znakov.',
    ],
    'max_digits' => 'Polje :attribute ne sme imeti več kot :max števk.',
    'mimes' => 'Polje :attribute mora biti datoteka tipa: :values.',
    'mimetypes' => 'Polje :attribute mora biti datoteka tipa: :values.',
    'min' => [
        'array' => 'Polje :attribute mora imeti vsaj :min elementov.',
        'file' => 'Polje :attribute mora biti vsaj :min kilobajtov.',
        'numeric' => 'Polje :attribute mora biti vsaj :min.',
        'string' => 'Polje :attribute mora imeti vsaj :min znakov.',
    ],
    'min_digits' => 'Polje :attribute mora imeti vsaj :min števk.',
    'missing' => 'Polje :attribute mora manjkati.',
    'missing_if' => 'Polje :attribute mora manjkati, ko je :other :value.',
    'missing_unless' => 'Polje :attribute mora manjkati, razen če je :other :value.',
    'missing_with' => 'Polje :attribute mora manjkati, ko je :values prisoten.',
    'missing_with_all' => 'Polje :attribute mora manjkati, ko so :values prisotni.',
    'multiple_of' => 'Polje :attribute mora biti večkratnik od :value.',
    'not_in' => 'Izbrana vrednost :attribute ni veljavna.',
    'not_regex' => 'Oblika polja :attribute ni veljavna.',
    'numeric' => 'Polje :attribute mora biti število.',
    'password' => [
        'letters' => 'Polje :attribute mora vsebovati vsaj eno črko.',
        'mixed' => 'Polje :attribute mora vsebovati vsaj eno veliko in eno malo črko.',
        'numbers' => 'Polje :attribute mora vsebovati vsaj eno številko.',
        'symbols' => 'Polje :attribute mora vsebovati vsaj en simbol.',
        'uncompromised' => 'Podan :attribute se je pojavil v uhajanju podatkov. Prosimo, izberite drug :attribute.',
    ],
    'present' => 'Polje :attribute mora biti prisotno.',
    'present_if' => 'Polje :attribute mora biti prisotno, ko je :other :value.',
    'present_unless' => 'Polje :attribute mora biti prisotno, razen če je :other :value.',
    'present_with' => 'Polje :attribute mora biti prisotno, ko je :values prisoten.',
    'present_with_all' => 'Polje :attribute mora biti prisotno, ko so :values prisotni.',
    'prohibited' => 'Polje :attribute je prepovedano.',
    'prohibited_if' => 'Polje :attribute je prepovedano, ko je :other :value.',
    'prohibited_unless' => 'Polje :attribute je prepovedano, razen če je :other v :values.',
    'prohibits' => 'Polje :attribute prepoveduje prisotnost :other.',
    'regex' => 'Oblika polja :attribute ni veljavna.',
    'required' => 'Polje :attribute je obvezno.',
    'required_array_keys' => 'Polje :attribute mora vsebovati vnose za: :values.',
    'required_if' => 'Polje :attribute je obvezno, ko je :other :value.',
    'required_if_accepted' => 'Polje :attribute je obvezno, ko je :other sprejet.',
    'required_if_declined' => 'Polje :attribute je obvezno, ko je :other zavrnjen.',
    'required_unless' => 'Polje :attribute je obvezno, razen če je :other v :values.',
    'required_with' => 'Polje :attribute je obvezno, ko je :values prisoten.',
    'required_with_all' => 'Polje :attribute je obvezno, ko so :values prisotni.',
    'required_without' => 'Polje :attribute je obvezno, ko :values ni prisoten.',
    'required_without_all' => 'Polje :attribute je obvezno, ko nobeden od :values ni prisoten.',
    'same' => 'Polji :attribute in :other se morata ujemati.',
    'size' => [
        'array' => 'Polje :attribute mora vsebovati :size elementov.',
        'file' => 'Polje :attribute mora biti veliko :size kilobajtov.',
        'numeric' => 'Polje :attribute mora biti :size.',
        'string' => 'Polje :attribute mora imeti :size znakov.',
    ],
    'starts_with' => 'Polje :attribute se mora začeti z enim od naslednjih: :values.',
    'string' => 'Polje :attribute mora biti niz.',
    'timezone' => 'Polje :attribute mora biti veljaven časovni pas.',
    'unique' => ':attribute je že zaseden.',
    'uploaded' => 'Nalaganje polja :attribute ni uspelo.',
    'uppercase' => 'Polje :attribute mora biti z velikimi črkami.',
    'url' => 'Polje :attribute mora biti veljaven URL.',
    'ulid' => 'Polje :attribute mora biti veljaven ULID.',
    'uuid' => 'Polje :attribute mora biti veljaven UUID.',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
