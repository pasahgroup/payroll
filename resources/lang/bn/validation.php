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

    'accepted'             => 'এই :attribute গ্রহণযোগ্য হতে হবে।',
    'active_url'           => 'এই :attribute সঠিক URL নয়।',
    'after'                => ':date এর পরের একটি তারিখ হতে হবে :attribute।',
    'after_or_equal'       => ':date এর পর বা সমান তারিখ হতে হবে :attribute।',
    'alpha'                => ':attribute শুধুমাত্র অক্ষর ধারণ করতে পারে।',
    'alpha_dash'           => ':attribute শুধুমাত্র অক্ষর, সংখ্যা এবং ড্যাশ ধারণ করতে পারে।',
    'alpha_num'            => ':attribute শুধুমাত্র অক্ষর এবং সংখ্যা ধারণ করতে পারে।',
    'array'                => ':attribute একটি অ্যারে হতে হবে।',
    'before'               => ':date এর আগের একটি তারিখ হতে হবে :attribute।',
    'before_or_equal'      => ':date এর আগে বা সমান তারিখ হতে হবে :attribute।',
    'between'              => [
        'numeric' => ':attribute মানটি অবশ্যই :min থেকে :max এর মধ্যে হতে হবে।',
        'file'    => ':attribute আকারটি অবশ্যই :min থেকে :max কিলোবাইটের মধ্যে হতে হবে।',
        'string'  => ':attribute অবশ্যই :min থেকে :max টি অক্ষরের মধ্যে হতে হবে।',
        'array'   => ':attribute অবশ্যই :min থেকে :max আইটেম হতে হবে।',
    ],
    'boolean'              => ':attribute ফিল্ডটি সত্য বা মিথ্যা হতে হবে।',
    'confirmed'            => ':attribute নিশ্চিতকরণ মেলে না।',
    'date'                 => ':attribute একটি বৈধ তারিখ নয়।',
    'date_format'          => ':attribute ফরমেট :format এর সাথে মিলে না।',
    'different'            => ':attribute এবং :other একে অপর থাকা উচিত।',
    'digits'               => ':attribute :digits সংখ্যা হতে হবে।',
    'digits_between'       => ':attribute মধ্যে সংখ্যা :min এবং :max এর মধ্যে হতে হবে।',
    'dimensions'           => ':attribute অবৈধ চিত্র মাত্রা রয়েছে।',
    'distinct'             => ':attribute ফিল্ডটি একই মানটি ধারণ করে।',
    'email'                => ':attribute একটি বৈধ ইমেল ঠিকানা হতে হবে।',
    'exists'               => 'নির্বাচিত :attribute অবৈধ।',
    'file'                 => ':attribute একটি ফাইল হতে হবে।',
    'filled'               => ':attribute ফিল্ডটি একটি মান ধারণ করতে হবে।',
    'image'                => ':attribute একটি চিত্র হতে হবে।',
    'in'                   => 'নির্বাচিত :attribute অবৈধ।',
    'in_array'             => ':attribute ফিল্ডটি :other তে নেই।',
    'integer'              => ':attribute একটি পূর্ণসংখ্যা হতে হবে।',
    'ip'                   => ':attribute একটি বৈধ আইপি ঠিকানা হতে হবে।',
    'json'                 => ':attribute একটি বৈধ জেএসওএন স্ট্রিং হতে হবে।',
    'max'                  => [
        'numeric' => ':attribute অধিকতম :max হতে পারবে না।',
        'file'    => ':attribute অধিকতম :max কিলোবাইটের হতে পারবে না।',
        'string'  => ':attribute অধিকতম :max টি অক্ষর হতে পারবে না।',
        'array'   => ':attribute অধিকতম :max টি আইটেম হতে পারবে না।',
    ],
    'mimes'                => ':attribute এর ধরণটি হতে হবে: :values।',
    'mimetypes'            => ':attribute এর ধরণটি হতে হবে: :values।',
    'min'                  => [
        'numeric' => ':attribute কমপক্ষে :min হতে হবে।',
        'file'    => ':attribute কমপক্ষে :min কিলোবাইটের হতে হবে।',
        'string'  => ':attribute কমপক্ষে :min টি অক্ষর হতে হবে।',
        'array'   => ':attribute কমপক্ষে :min টি আইটেম হতে হবে।',
    ],
    'not_in'               => 'নির্বাচিত :attribute অবৈধ।',
    'numeric'              => ':attribute একটি সংখ্যা হতে হবে।',
    'present'              => ':attribute ক্ষেত্রটি উপস্থিত থাকতে হবে।',
    'regex'                => ':attribute ফরমেটটি অবৈধ।',
    'required'             => ':attribute ক্ষেত্রটি প্রয়োজন।',
    'required_if'          => ':attribute ক্ষেত্রটি :other হলে :value প্রয়োজন।',
    'required_unless'      => ':attribute ক্ষেত্রটি প্রয়োজন নয় যদি :other এ থাকে :values এর মধ্যে।',
    'required_with'        => 'যখন :values উপস্থিত হয় তখন :attribute ক্ষেত্র প্রয়োজন।',
    'required_with_all'    => 'যখন :values উপস্থিত হয় তখন :attribute ক্ষেত্র প্রয়োজন।',
    'required_without'     => 'যখন :values উপস্থিত নয় তখন :attribute ক্ষেত্র প্রয়োজন।',
    'required_without_all' => 'যখন :values কোনওটি উপস্থিত না থাকে তখন :attribute ক্ষেত্র প্রয়োজন।',
    'same'                 => ':attribute এবং :other মিলতে হবে।',
    'size'                 => [
        'numeric' => ':attribute অবশ্যই :size হতে হবে।',
        'file'    => ':attribute অবশ্যই :size কিলোবাইট হতে হবে।',
        'string'  => ':attribute অবশ্যই :size অক্ষর হতে হবে।',
        'array'   => ':attribute অবশ্যই :size আইটেম ধারণ করতে হবে।',
    ],
    'string'               => ':attribute অবশ্যই একটি স্ট্রিং হতে হবে।',
    'timezone'             => ':attribute একটি বৈধ জোন হতে হবে।',
    'unique'               => ':attribute ইতিমধ্যে নেওয়া হয়েছে।',
    'uploaded'             => ':attribute আপলোড করা ব্যর্থ হয়েছে।',
    'url'                  => ':attribute ফরম্যাটটি অবৈধ।',

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

    'custom'               => [
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

    'attributes'           => [],

];
