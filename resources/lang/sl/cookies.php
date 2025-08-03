<?php

return [
  'title' => 'Piškotki',

  'what' => [
    'title' => 'Kaj so piškotki?',
    'description' => 'Piškotki so majhne datoteke, ki jih spletna mesta shranijo v vaš brskalnik za izboljšanje uporabniške izkušnje. Ne vsebujejo osebnih podatkov in jih lahko upravljate v nastavitvah brskalnika.'
  ],

  'why' => [
    'title' => 'Zakaj so potrebni?',
    'description' => 'Piškotki omogočajo osnovne funkcije delovanja spletnega mesta ter analizo uporabe, kar izboljšuje delovanje in prilagodljivost vsebine.'
  ],

  'examples' => [
    'title' => 'Primeri uporabe',
    'point1' => 'Prilagoditev vsebine na podlagi preteklih obiskov',
    'point2' => 'Shranjevanje nastavitev uporabnika',
    'point3' => 'Samodejna prijava v sistem',
    'point4' => 'Analiza obiskov za izboljšave',
    'point5' => 'Podpora delovanju spletne trgovine',
  ],

  'disable' => [
    'title' => 'Onemogočenje piškotkov',
    'description' => 'Piškotke lahko vedno onemogočite v nastavitvah vašega brskalnika. Spletna stran morda ne bo delovala optimalno.'
  ],

  'types' => [
    'title' => 'Vrste piškotkov',
    'description' => 'Uporabljamo nujne, analitične in oglaševalske piškotke za zagotavljanje delovanja in izboljšanje vsebin.'
  ],

  'table' => [
    'name' => 'Ime piškotka',
    'duration' => 'Veljavnost',
    'purpose' => 'Namen',
    'required' => [
      'title' => 'Nujni piškotki',
      'session' => 'Sejni piškotek za vzdrževanje uporabniške seje.',
      'xsrf' => 'Piškotek za zaščito pred CSRF napadi.'
    ],
    'marketing' => [
      'title' => 'Piškotki za trženje',
      'consent' => 'Zabeleži vaše soglasje za uporabo piškotkov.',
      'nid' => 'Uporablja se za prikaz vsebin glede na pretekle iskalne izraze.',
      'ide' => 'Spremlja interakcijo z oglasi za boljšo prikazno ustreznost.',
      'dsid' => 'Povezuje seje med napravami za prikaz ustreznih oglasov.'
    ]
  ],

  'session' => 'Čas seje',
];
