<?php

return [
  'title' => 'Cookies',

  'what' => [
    'title' => 'What are cookies?',
    'description' => 'Cookies are small files stored by websites in your browser to improve user experience. They do not store personal data and can be managed through your browser settings.'
  ],

  'why' => [
    'title' => 'Why are they necessary?',
    'description' => 'Cookies enable basic website functionality, allow for analytics, and help tailor content to user preferences.'
  ],

  'examples' => [
    'title' => 'Examples of usage',
    'point1' => 'Tailoring content based on previous visits',
    'point2' => 'Storing user preferences',
    'point3' => 'Maintaining login sessions',
    'point4' => 'Analytics for performance improvements',
    'point5' => 'Supporting e-commerce functionality',
  ],

  'disable' => [
    'title' => 'Disabling cookies',
    'description' => 'You can disable cookies at any time via your browser settings. Some features of the site may not function properly.'
  ],

  'types' => [
    'title' => 'Types of cookies we use',
    'description' => 'We use essential, analytical, and marketing cookies to provide functionality and improve user experience.'
  ],

  'table' => [
    'name' => 'Cookie name',
    'duration' => 'Duration',
    'purpose' => 'Purpose',
    'required' => [
      'title' => 'Essential cookies',
      'session' => 'Session cookie to maintain user state.',
      'xsrf' => 'Security cookie for CSRF protection.'
    ],
    'marketing' => [
      'title' => 'Marketing cookies',
      'consent' => 'Records consent for cookie usage.',
      'nid' => 'Stores prior searches and customizes ad content.',
      'ide' => 'Measures ad interaction and avoids repetition.',
      'dsid' => 'Links user sessions across devices for ad targeting.'
    ]
  ],

  'session' => 'Session duration',
];
