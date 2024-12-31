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

    'accepted' => ':attribute ক্ষেত্রটি অবশ্যই একসেপ্ট করতে হবে।',
    'accepted_if' => ':attribute ক্ষেত্রটি অবশ্যই একসেপ্ট করতে হবে যখন :other হল :value।',
    'active_url' => ':attribute ক্ষেত্রটি অবশ্যই একটি বৈধ URL হতে হবে।',
    'after' => ':attribute ক্ষেত্রটি অবশ্যই :date এর পরে একটি তারিখ হতে হবে।',
    'after_or_equal' => ':attribute ক্ষেত্রটি অবশ্যই :date এর পরে বা তার সমান হতে হবে।',
    'alpha' => ':attribute ক্ষেত্রে শুধুমাত্র অক্ষর থাকতে হবে।',
    'alpha_dash' => ':attribute ক্ষেত্রে শুধুমাত্র অক্ষর, সংখ্যা, ড্যাশ এবং আন্ডারস্কোর থাকতে হবে।',
    'alpha_num' => ':attribute ক্ষেত্রে শুধুমাত্র অক্ষর এবং সংখ্যা থাকতে হবে।',
    'array' => ':attribute ক্ষেত্রটি অবশ্যই একটি অ্যারে হতে হবে।',
    'ascii' => ':attribute ফিল্ডে শুধুমাত্র একক-বাইট আলফানিউমেরিক অক্ষর এবং চিহ্ন থাকতে হবে।',
    'before' => ':attribute ক্ষেত্রটি অবশ্যই :date এর আগে একটি তারিখ হতে হবে।',
    'before_or_equal' => ':attribute ক্ষেত্রটি অবশ্যই :date এর আগে বা সমান একটি তারিখ হতে হবে।',
    'between' => [
        'array' => ':attribute ক্ষেত্রে অবশ্যই :min এবং :max আইটেমের মধ্যে থাকতে হবে।',
        'file' => ':attribute ক্ষেত্রটি অবশ্যই :min এবং :max কিলোবাইটের মধ্যে হতে হবে৷',
        'numeric' => ':attribute ক্ষেত্রটি অবশ্যই :min এবং :max এর মধ্যে হতে হবে।',
        'string' => ':attribute ক্ষেত্রটি অবশ্যই :min এবং :max অক্ষরের মধ্যে হতে হবে।',
    ],
    'boolean' => ':attribute ক্ষেত্রটি সত্য বা মিথ্যা হতে হবে।',
    'can' => ':attribute ক্ষেত্রের একটি অননুমোদিত মান রয়েছে।',
    'confirmed' => ':attribute ক্ষেত্রের নিশ্চিতকরণ মেলে না।',
    'contains' => ':attribute ক্ষেত্রের একটি প্রয়োজনীয় মান অনুপস্থিত।',
    'current_password' => 'পাসওয়ার্ডটি ভুল।',
    'date' => ':attribute ক্ষেত্রটি অবশ্যই একটি বৈধ তারিখ হতে হবে।',
    'date_equals' => ':attribute ক্ষেত্রটি অবশ্যই :date এর সমান একটি তারিখ হতে হবে।',
    'date_format' => ':attribute ক্ষেত্রটি অবশ্যই বিন্যাস :format ফর্ম্যাটের সাথে মিলবে।',
    'decimal' => ':attribute ক্ষেত্রে অবশ্যই :decimal দশমিক স্থান থাকতে হবে।',
    'declined' => ':attribute ক্ষেত্রটি অবশ্যই প্রত্যাখ্যান করতে হবে।',
    'declined_if' => ':attribute ক্ষেত্রটি অবশ্যই প্রত্যাখ্যান করতে হবে যখন :other হয় :value।',
    'different' => ':attribute ক্ষেত্র এবং :other ভিন্ন হতে হবে।',
    'digits' => ':attribute ক্ষেত্রটি হতে হবে :digits ডিজিটের',
    'digits_between' => ':attribute ক্ষেত্রটি অবশ্যই :min এবং :max ডিজিটের মধ্যে হতে হবে।',
    'dimensions' => ':attribute ক্ষেত্রের অবৈধ চিত্র মাত্রা আছে।',
    'distinct' => ':attribute ক্ষেত্রের একটি ডুপ্লিকেট মান আছে।',
    'doesnt_end_with' => ':attribute ক্ষেত্রটি অবশ্যই নিম্নলিখিতগুলির একটি দিয়ে শেষ হবে না: :values৷',
    'doesnt_start_with' => ':attribute ক্ষেত্রটি অবশ্যই নিম্নলিখিতগুলির একটি দিয়ে শুরু হবে না: :values৷',
    // 'email' => ':attribute ক্ষেত্রটি অবশ্যই একটি বৈধ ইমেল হতে হবে।',
    'email' => 'এই তথ্যটি অবশ্যই একটি বৈধ ইমেল হতে হবে।',
    'ends_with' => ':attribute ক্ষেত্রটি অবশ্যই নিম্নলিখিতগুলির একটি দিয়ে শেষ হতে হবে: :values৷',
    'enum' => 'নির্বাচিত :attribute টি অবৈধ।',
    'exists' => 'নির্বাচিত :attribute টি অবৈধ।',
    'extensions' => ':attribute ক্ষেত্রে নিম্নলিখিত এক্সটেনশনগুলির মধ্যে একটি থাকতে হবে: :values.',
    'file' => ':attribute ক্ষেত্রটি অবশ্যই একটি ফাইল হতে হবে।',
    'filled' => ':attribute ক্ষেত্রের একটি মান থাকতে হবে।',
    'gt' => [
        'array' => ':attribute ফিল্ডে অবশ্যই :value আইটেমের থেকে বেশি হতে হবে।',
        'file' => ':attribute ক্ষেত্রটি অবশ্যই :value কিলোবাইটের থেকে বেশি হতে হবে।',
        'numeric' => ':attribute ক্ষেত্রটি অবশ্যই :value-এর চেয়ে বড় হতে হবে।',
        'string' => ':attribute ক্ষেত্রটি অবশ্যই :value অক্ষরের চেয়ে বড় হতে হবে।',
    ],
    'gte' => [
        'array' => ':attribute ফিল্ডে অবশ্যই :value আইটেম বা তার বেশি থাকতে হবে।',
        'file' => ':attribute ক্ষেত্রটি অবশ্যই :value কিলোবাইটের থেকে বড় বা সমান হতে হবে।',
        'numeric' => ':attribute ক্ষেত্রটি অবশ্যই :value এর থেকে বড় বা সমান হতে হবে।',
        'string' => ':attribute ক্ষেত্রটি অবশ্যই :value অক্ষরের চেয়ে বড় বা সমান হতে হবে।',
    ],
    'hex_color' => ':attribute ক্ষেত্রটি অবশ্যই একটি বৈধ হেক্সাডেসিমেল রঙ হতে হবে।',
    'image' => ':attribute ক্ষেত্রটি অবশ্যই একটি চিত্র হতে হবে।',
    'in' => 'নির্বাচিত :attribute টি অবৈধ।',
    'in_array' => ':attribute ক্ষেত্রটি অবশ্যই :other মধ্যে বিদ্যমান থাকতে হবে।',
    'integer' => ':attribute ক্ষেত্রটি অবশ্যই একটি পূর্ণসংখ্যা হতে হবে।',
    'ip' => ':attribute ক্ষেত্রটি অবশ্যই একটি বৈধ IP ঠিকানা হতে হবে।',
    'ipv4' => ':attribute ক্ষেত্রটি অবশ্যই একটি বৈধ IPv4 ঠিকানা হতে হবে।',
    'ipv6' => ':attribute ক্ষেত্রটি অবশ্যই একটি বৈধ IPv6 ঠিকানা হতে হবে।',
    'json' => ':attribute ক্ষেত্রটি অবশ্যই একটি বৈধ JSON স্ট্রিং হতে হবে।',
    'list' => ':attribute ক্ষেত্রটি অবশ্যই একটি তালিকা হতে হবে।',
    'lowercase' => ':attribute ক্ষেত্রটি ছোট হাতের হতে হবে।',
    'lt' => [
        'array' => ':attribute ফিল্ডে অবশ্যই :value আইটেম থেকে কম হতে হবে।',
        'file' => ':attribute ক্ষেত্রটি অবশ্যই :value কিলোবাইটের চেয়ে কম হতে হবে।',
        'numeric' => ':attribute ক্ষেত্রটি অবশ্যই :value এর চেয়ে কম হতে হবে।',
        // 'string' => ':attribute ইনপুট ফিল্ড অবশই :value অক্ষরের কম হতে হবে।',
        'string' => ':এই তথ্যটি অবশই :value অক্ষরের কম হতে হবে।',
    ],
    'lte' => [
        'array' => ':attribute ফিল্ডে অবশ্যই :value আইটেম এর বেশি হবে না।',
        'file' => ':attribute ক্ষেত্রটি অবশ্যই :value কিলোবাইটের থেকে কম বা সমান হতে হবে।',
        'numeric' => ':attribute ক্ষেত্রটি অবশ্যই :value এর থেকে কম বা সমান হতে হবে।',
        // 'string' => ':attribute ক্ষেত্রটি অবশ্যই :value অক্ষরের চেয়ে কম বা সমান হতে হবে।',
        'string' => 'এই তথ্যটি অবশ্যই :value অক্ষরের চেয়ে কম বা সমান হতে হবে।',
    ],
    'mac_address' => ':attribute ক্ষেত্রটি অবশ্যই একটি বৈধ MAC ঠিকানা হতে হবে।',
    'max' => [
        'array' => ':attribute ফিল্ডে অবশ্যই :max এর বেশি আইটেম হবে না।',
        'file' => ':attribute ক্ষেত্রটি অবশ্যই :max kilobytes-এর থেকে বেশি হওয়া উচিত নয়৷',
        'numeric' => ':attribute ক্ষেত্রটি অবশ্যই :max এর থেকে বেশি হওয়া উচিত নয়।',
        // 'string' => ':attribute ক্ষেত্রটি অবশ্যই :max অক্ষরের বেশি হওয়া উচিত নয়।',
        'string' => 'এই তথ্যটি অবশ্যই :max অক্ষরের বেশি হওয়া উচিত নয়।',
    ],
    'max_digits' => ':attribute ফিল্ডে অবশ্যই :max সংখ্যার বেশি হবে না।',
    'mimes' => ':attribute ক্ষেত্রটি অবশ্যই টাইপ: :values ​​ফাইল হতে হবে।',
    'mimetypes' => ':attribute ক্ষেত্রটি অবশ্যই টাইপ: :values ​​ফাইল হতে হবে।',
    'min' => [
        'array' => ':attribute ফিল্ডে কমপক্ষে :min আইটেম থাকতে হবে।',
        'file' => ':attribute ক্ষেত্রটি অন্তত :min কিলোবাইট হতে হবে।',
        // 'numeric' => ':attribute ক্ষেত্রটি অবশ্যই কমপক্ষে :min হতে হবে।',
        // 'numeric' => ':attribute ক্ষেত্রটি অবশ্যই কমপক্ষে :min হতে হবে।',
        'numeric' => 'এই তথ্যটি কমপক্ষে :min ডিজিটের হতে হবে।',
        'string' => 'এই তথ্যটি কমপক্ষে :min অক্ষরের হতে হবে।',
    ],
    'min_digits' => ':attribute ফিল্ডে কমপক্ষে :min ডিজিট থাকতে হবে।',
    'missing' => ':attribute ক্ষেত্রটি অবশ্যই অনুপস্থিত।',
    'missing_if' => ':attribute ক্ষেত্রটি অবশ্যই অনুপস্থিত যখন :other হল :value।',
    'missing_unless' => 'The :attribute field must be missing unless :other is :value.',
    'missing_unless' => ':attribute ক্ষেত্রটি অবশ্যই অনুপস্থিত যদি না :other হল :value।',
    'missing_with' => ':values ​​উপস্থিত থাকলে :attribute ক্ষেত্রটি অবশ্যই অনুপস্থিত।',
    'missing_with_all' => ':values ​​উপস্থিত থাকলে :attribute ক্ষেত্রটি অবশ্যই অনুপস্থিত থাকবে।',
    'multiple_of' => ':attribute ক্ষেত্রটি অবশ্যই :value-এর গুনিতক হতে হবে।',
    'not_in' => 'নির্বাচিত :attribute টি অবৈধ।',
    // 'not_regex' => ':attribute ক্ষেত্রের বিন্যাসটি অবৈধ।',
    'not_regex' => 'এই তথ্যটির বিন্যাস সঠিক নয়।',
    'numeric' => ':attribute ক্ষেত্রটি অবশ্যই একটি সংখ্যা হতে হবে।',
    'password' => [
        'letters' => ':attribute ফিল্ডে অন্তত একটি অক্ষর থাকতে হবে।',
        'mixed' => ':attribute ক্ষেত্রে অন্তত একটি বড় হাতের এবং একটি ছোট হাতের অক্ষর থাকতে হবে।',
        'numbers' => ':attribute ফিল্ডে অন্তত একটি সংখ্যা থাকতে হবে।',
        'symbols' => ':attribute ফিল্ডে অন্তত একটি চিহ্ন থাকতে হবে।',
        'uncompromised' => 'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
        'uncompromised' => 'প্রদত্ত :attribute একটি ডেটা ফাঁসের মধ্যে উপস্থিত হয়েছে। অনুগ্রহ করে একটি ভিন্ন :attribute চয়ন করুন।',
    ],
    'present' => ':attribute ক্ষেত্রটি অবশ্যই উপস্থিত থাকতে হবে।',
    'present_if' => ':attribute ক্ষেত্রটি অবশ্যই উপস্থিত থাকতে হবে যখন :other হল :value।',
    'present_unless' => ':attribute ক্ষেত্রটি অবশ্যই উপস্থিত থাকতে হবে যদি না :other হল :value থাকে।',
    'present_with' => ':values ​​উপস্থিত থাকলে :attribute ক্ষেত্রটি অবশ্যই উপস্থিত থাকতে হবে৷',
    'present_with_all' => 'যখন :values ​​থাকে তখন :attribute ক্ষেত্রটি অবশ্যই উপস্থিত থাকতে হবে।',
    'prohibited' => ':attribute ক্ষেত্রটি নিষিদ্ধ।',
    'prohibited_if' => ':attribute ক্ষেত্রটি নিষিদ্ধ যখন :other হল :value।',
    'prohibited_unless' => ':attribute ক্ষেত্রটি নিষিদ্ধ যদি না :other এর :values থাকে।',
    'prohibits' => ':attribute ক্ষেত্রটি :other উপস্থিত হতে নিষেধ করে।',
    // 'regex' => ':attribute ক্ষেত্রের বিন্যাসটি অবৈধ।',
    'regex' => 'এই তথ্যটির বিন্যাস সঠিক নয়।',
    // 'required' => ':attribute অবশ্যই পূরণীয়।',
    'required' => 'এই তথ্যটি অবশ্যই পূরণীয়।',
    'required_array_keys' => ':attribute ফিল্ডে অবশ্যই: :values ​​এর জন্য এন্ট্রি থাকতে হবে।',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_if' => ':attribute ফিল্ডের প্রয়োজন হয় যখন :other হল :value।',
    'required_if_accepted' => 'যখন :other গৃহীত হয় তখন :attribute ফিল্ডের প্রয়োজন হয়।',
    'required_if_declined' => 'যখন :other প্রত্যাখ্যান করা হয় তখন :attribute ফিল্ডের প্রয়োজন হয়।',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_unless' => ':attribute ক্ষেত্রটি আবশ্যক যদি না :other এর মান :values থাকে।',
    'required_with' => 'যখন :values ​​উপস্থিত থাকে তখন :attribute ফিল্ডের প্রয়োজন হয়।',
    'required_with_all' => 'যখন :values ​​উপস্থিত থাকে তখন :attribute ফিল্ডের প্রয়োজন হয়।',
    'required_without' => 'যখন :values ​​উপস্থিত না থাকে তখন :attribute ক্ষেত্রের প্রয়োজন হয়।',
    'required_without_all' => ':values কোনোটি উপস্থিত না থাকলে :attribute ক্ষেত্রের প্রয়োজন হয়৷',
    'same' => ':attribute ফিল্ড অবশ্যই মিলবে :other এর সাথে।',
    'size' => [
        'array' => ':attribute ক্ষেত্রে অবশ্যই :size আইটেম থাকতে হবে।',
        'file' => ':attribute ক্ষেত্রটি অবশ্যই :size কিলোবাইট হতে হবে।',
        'numeric' => ':attribute ক্ষেত্রটি অবশ্যই :size হতে হবে।',
        'string' => ':attribute ক্ষেত্রটি অবশ্যই :size অক্ষরের হতে হবে।',
    ],
    'starts_with' => ':attribute ক্ষেত্রটি অবশ্যই নিম্নলিখিতগুলির একটি দিয়ে শুরু করতে হবে: :values৷',
    'string' => ':attribute ক্ষেত্রটি অবশ্যই একটি স্ট্রিং হতে হবে।',
    'timezone' => ':attribute ক্ষেত্রটি অবশ্যই একটি বৈধ টাইমজোন হতে হবে।',
    'unique' => ':attribute টি ইতিমধ্যে নেওয়া হয়েছে।',
    'uploaded' => ':attribute টি আপলোড করতে ব্যর্থ হয়েছে।',
    'uppercase' => ':attribute ক্ষেত্রটি অবশ্যই বড় হাতের হতে হবে।',
    'url' => ':attribute ক্ষেত্রটি অবশ্যই একটি বৈধ URL হতে হবে।',
    'ulid' => ':attribute ক্ষেত্রটি অবশ্যই একটি বৈধ ULID হতে হবে।',
    'uuid' => ':attribute ক্ষেত্রটি অবশ্যই একটি বৈধ UUID হতে হবে।',

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
