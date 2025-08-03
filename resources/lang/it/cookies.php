<?php

return [
  'title' => 'Cookie',

  'what' => [
    'title' => 'Cosa sono i cookie?',
    'description' => 'I cookie sono piccoli file salvati dal sito nel tuo browser per migliorare l’esperienza utente. Non contengono dati personali e possono essere gestiti tramite le impostazioni del browser.'
  ],

  'why' => [
    'title' => 'Perché sono necessari?',
    'description' => 'I cookie permettono il funzionamento di base del sito, consentono l’analisi statistica e personalizzano i contenuti.'
  ],

  'examples' => [
    'title' => 'Esempi di utilizzo',
    'point1' => 'Personalizzazione dei contenuti in base alle visite precedenti',
    'point2' => 'Memorizzazione delle preferenze utente',
    'point3' => 'Mantenimento dell’accesso al sistema',
    'point4' => 'Analisi delle visite per migliorare il sito',
    'point5' => 'Supporto alle funzionalità dell’e-commerce',
  ],

  'disable' => [
    'title' => 'Disattivazione dei cookie',
    'description' => 'Puoi disattivare i cookie tramite le impostazioni del browser. Alcune funzionalità del sito potrebbero essere compromesse.'
  ],

  'types' => [
    'title' => 'Tipi di cookie utilizzati',
    'description' => 'Utilizziamo cookie essenziali, analitici e di marketing per garantire la funzionalità e migliorare l’esperienza.'
  ],

  'table' => [
    'name' => 'Nome cookie',
    'duration' => 'Durata',
    'purpose' => 'Scopo',
    'required' => [
      'title' => 'Cookie essenziali',
      'session' => 'Cookie di sessione per mantenere lo stato utente.',
      'xsrf' => 'Cookie di sicurezza per la protezione CSRF.'
    ],
    'marketing' => [
      'title' => 'Cookie di marketing',
      'consent' => 'Registra il consenso all’uso dei cookie.',
      'nid' => 'Memorizza ricerche recenti per personalizzare gli annunci.',
      'ide' => 'Analizza le interazioni con gli annunci.',
      'dsid' => 'Associa l’attività dell’utente tra dispositivi diversi per il targeting pubblicitario.'
    ]
  ],

  'session' => 'Sessione',
];
