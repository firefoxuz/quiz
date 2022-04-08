<?php
return [
    'site' => [
        'title' => 'Quiz',
        'login' => [
            'sign_in' => 'Tizimga kirish',
            'enter' => 'Kirish',
            'email' => 'Potcha manzili',
            'password' => 'Parol',
            'remember' => 'Eslab qolish',
        ],
        'logout' => 'Chiqish'
    ],
    'table' => [
        'count' => 'Soni',
        'actions' => 'Harakatlar',
        'delete' => 'O\'chirish',
        'save' => 'Saqlash',
    ],
    'user' => [
        'user' => 'Admin',
        'api_user' => 'Foydalanuvchilar',
        'list' => 'Ro\'yxat',
        'new' => 'Foydalanuvchi qo\'shish',
        'full_name' => 'F.I.O',
        'email' => 'Email',
        'date' => 'Sana',
        'face_model' => 'Face model',
    ],
    'api_user' => [
        'first_name' => 'Ism',
        'last_name' => 'Familiya',
        'phone' => 'Telefon',
        'email' => 'Email',
        'password' => 'Parol',
        'registered_at' => 'Ro\'yxatdan o\'tgan sana',
    ],
    'quiz' => [
        'import' => 'Import',
        'format' => 'Formatlash',
        'new' => 'Yangi qo\'shish',
        'quiz' => 'Quiz',
        'count' => 'Savollar soni',
        'attempts' => 'Urinishlar soni',
        'time_limit' => 'Vaqt cheklovi (minut)',
        'title' => 'Sarlavha',
        'slug' => 'Slug',
        'summary' => 'Qisqacha izoh',
        'type' => 'Turi',
        'score' => 'Ball',
        'published' => 'Published',
        'published_at' => 'Published at',
        'starts_at' => 'Boshlanish sanasi',
        'ends_at' => 'Tugatish sanasi',
        'content' => 'Mazmun',
        'created_at' => 'Yaratilgan sana',
        'updated_at' => 'Yangilangan sana',
        'template' =>
            'Question 1
====
Variant 1
====
#Variant 2 correct
====
Variant 3
====
Variant 4
++++
Question 2'
    ],
    'quiz_questions' => [
        'select' => 'Tanlang ...',
        'quiz_question' => 'Savollar',
        'type' => 'Turi',
        'active' => 'Faol',
        'level' => 'Daraja',
        'score' => 'Ball',
        'content' => 'Savol'
    ],
    'quiz_answers' => [
        'quiz_answer' => 'Javoblar',
        'correct' => 'To\'g\'ri javob',
        'content' => 'Javob',
    ],
    'face_data' => [
        'face_data' => 'Face data',
        'face_id' => 'Face id',
        'user_id' => 'User id',
        'created_at' => 'Yaratilgan sana',
        'updated_at' => 'Yangilangan sana',
        'photo' => 'Photo',
        'add' => 'Yangi qo\'shish',
        'add_face_model' => 'Yangi face model qo\'shish',
    ],
    'take' => [
        'statuses' => [
            '',
            'Started',
            'Finished'
        ],
        'take' => 'Take',
        'quiz_id' => 'Quiz id',
        'user_id' => 'User id',
        'created_at' => 'Yaratilgan sana',
        'updated_at' => 'Yangilangan sana',
        'started_at' => 'Boshlanish sanasi',
        'finished_at' => 'Tugatish sanasi',
        'score' => 'Ball',
        'status' => 'Status',
    ],
    'excel' => [
        'header' => [
            'full_name' => 'F.I.O',
            'correct_answers' => 'To\'g\'ri javoblar soni',
            'incorrect_answers' => 'Noto\'g\'ri javoblar soni',
            'score' => 'Ball',
            'status' => 'Status',
            'starts_at' => 'Boshlangan sanasi',
            'ends_at' => 'Tugatgan sanasi',
        ]
    ]
];
