<?php

Config::set('admin_email', 'daneourij@gmail.com');

Config::set('site_name', 'TAXI 838');

Config::set('language', array('ua', 'en'));

Config::set('Routes', array(
    'main/test1' => 'main/test1',
    'main' => 'main/index',
    'services/([0-9]+)' =>'services/index/$1',
    'services/information/([0-9]+)' => 'services/information/$1',
    'services' => 'services/index',
    'tariffs' => 'tariff/index',
    'cars/([a-z]+)/([0-9]+)' =>'autopark/show/$1/$2',
    'cars/([0-9]+)' =>'autopark/show/$1',
    'cars' => 'autopark/show',
    'about' => 'about/index',
    'user/registration' => 'user/registration',
    'registration' => 'user/registration',
    'user/password_recovery' => 'user/password_recovery',
    'user/login/([A-Za-z0-9]+)' => 'user/login/$1',
    'user/login' => 'user/login',
    'login' => 'user/login',
    'account/order' => 'account/order',
    'account/history' => 'account/history',
    'account/current_orders' => 'account/current_orders',
    'account/delete_order/([0-9]+)' => 'account/delete_order/$1',
    'account/personal_data' => 'account/personal_data',
    'account/logout' => 'account/logout',
    'admin/user/login' => 'admin/user/login',
    'admin/login' => 'admin/user/login',
    'admin/show/([A-z]+)' => 'admin/admin/show/$1',
    'admin/update/([A-z]+)/(.*)' => 'admin/admin/update/$1/$2',
    'admin/delete/([A-z]+)/(.*)' => 'admin/admin/delete/$1/$2',
    'admin/add/([A-z]+)' => 'admin/admin/add/$1',
    'admin/logout' => 'admin/account/logout',
    'admin' => 'admin/account/index',
    'account' => 'account/index',
    '' => 'main/index'
));

Config::set('routes', array(
    'default' => '',
    'admin' => 'admin_'
));

Config::set('default_route', 'default');

Config::set('default_language', 'ua');

Config::set('default_controller', 'main');

Config::set('default_action', 'index');

//Params to connect the database
Config::set('db.host', 'www.taxi838.local');

Config::set('db.user', 'root');

Config::set('db.password', '');

Config::set('db.db_name', 'taxi838');

Config::set('db.char', 'utf8');

//Set salt for password
Config::set('salt', 'd7t77zai8ch73l9d77c');


//Params for ReCaptcha
Config::set('re_captcha', array(
    'private_key' => '6Lfbh1kUAAAAAIYnOqOzZNsoAj62Bwc3qCSPPALl'
));


//Tables for manager admin panel

Config::set('adminTables', [
    "user" => ["name" => "Користувачі",
               "foreign" =>[],
               "fields" => [
                   "id" => ["name" => "Ідентифікатор",
                           "html_type" => "number",
                           "text_area" => false,
                           "update" => 1],
                   "name" => ["name" => "Ім'я",
                              "html_type" => "text",
                              "text_area" => false,
                              "update" => 1],
                   "surname" => ["name" => "Прізвище",
                                 "html_type" => "text",
                                 "text_area" => false,
                                 "update" => 1],
                   "email" => ["name" => "Емейл",
                               "html_type" => "email",
                               "text_area" => false,
                               "update" => 1],
                   "mobile" => ["name" => "Мобільний телефон",
                               "html_type" => "tel",
                               "text_area" => false,
                               "update" => 1],

                           ]
               ],

    "order" => ["name" => "Замовлення",
                "foreign" =>[],
                "fields" =>[
                   "number_order" =>["name" => "№",
                                     "html_type" => "number",
                                     "text_area" => false,
                                      "update" => 0],
                    "client" => ["name" => "Клієнт",
                                 "html_type" => "number",
                                 "text_area" => false,
                                 "update" => 0],
                    "where_" => ["name" => "Куди",
                                 "html_type" => "text",
                                 "text_area" => false,
                                 "update" => 0],
                    "whence" => ["name" => "Звідки",
                                 "html_type" => "text",
                                "text_area" => false,
                                  "update" => 0],
                    "when_" => ["name" => "Коли",
                                "html_type" => "text",
                                "text_area" => false,
                                 "update" => 0],
                    "time" => ["name" => "О котрій",
                               "html_type" => "text",
                               "text_area" => false,
                               "update" => 0],
                    "automobile" => ["name" => "Автомобіль",
                                     "html_type" => "text",
                                      "text_area" => false,
                                     "update" => 0],
                    "state_auto_number" => ["name" => "Держ. номер",
                                            "html_type" => "text",
                                           "text_area" => false,
                                            "update" => 0],
                    "service" => ["name" => "Послуга",
                                  "html_type" => "text",
                                  "text_area" => false,
                                  "update" => 0],
                    "mobile_number" => ["name" => "Моб. телефон",
                                        "html_type" => "text",
                                        "text_area" => false,
                                        "update" => 0],
                    "driver" => ["name" => "Водій",
                                 "html_type" => "text",
                                 "text_area" => false,
                                 "update" => 0],
                    "price" => ["name" => "Ціна",
                                "html_type" => "text",
                                "text_area" => false,
                                "update" => 0],
                    "distance" => ["name" => "Відстань",
                                   "html_type" => "text",
                                   "text_area" => false,
                                   "update" => 0],
                    "performance" => ["name" => "Виконано",
                                      "html_type" => "text",
                                      "text_area" => false,
                                      "update" => 1],
                ],

                "create" => ["view" => '../views/user/admin/subsidiary/add_order.php'],
                "pathForSaveImage" => []
    ],

    "service" => ["name" => "Послуги",
        "foreign" =>[],
        "fields" => [
            "id" => ["name" => "Ід.",
                "text_area" => false,
                "html_type" => "number",
                "update" => 1],
            "image" => ["name" => "Зображення",
                "text_area" => false,
                "html_type" => "file",
                "pathToImage" => "../../../webroot/img/services/",
                "update" => 1],
            "title" => ["name" => "Назва",
                "text_area" => false,
                "html_type" => "text",
                "update" => 1],
            "summary" => ["name" => "Короткий опис",
                "text_area" => true,
                "html_type" => "text",
                "update" => 1],
            "description" => ["name" => "Повний опис",
                "text_area" => true,
                "html_type" => "text",
                "update" => 1],
            "price" => ["name" => "Ціна послуги",
                "text_area" => false,
                "html_type" => "text",
                "update" => 1],

        ],

        "create" => ["view" => ''],

        "pathForSaveImage" => "F:\\xampp\\htdocs\\my_projects\\taxi838.local\\www\\webroot\\img\\services\\"
    ],

    "BodyType" => ["name" => "Типи автомобілей",
        "foreign" =>[],
        "fields" => [
            "title" => ["name" => "Тип кузова",
                "text_area" => false,
                "html_type" => "text",
                "update" => 1],
            "image" => ["name" => "Зображення",
                "text_area" => false,
                "html_type" => "file",
                "pathToImage" => "../../../webroot/img/autopark/icon_auto_type/",
                "update" => 1],
            "description" => ["name" => "Опис",
                "text_area" => true,
                "html_type" => "text",
                "update" => 1],
            "price_behind_km" => ["name" => "Ціна проїду за км",
                "text_area" => false,
                "html_type" => "number",
                "update" => 1],

        ],

        "create" => ["view" => ''],

        "pathForSaveImage" => "F:\\xampp\\htdocs\\my_projects\\taxi838.local\\www\\webroot\\img\\autopark\\icon_auto_type\\"
    ],


    "car" => ["name" => "Автомобілі",
        "foreign" => [
            "html_type" => "foreign",
            "update" => 1,
            "foreign_table" => "BodyType",
            "foreign_field" => "title"
            ],
        "fields" => [
            "state_auto_number" => ["name" => "Держ. номер",
                "text_area" => false,
                "html_type" => "text",
                "update" => 1],
            "mark" => ["name" => "Марка",
                "text_area" => false,
                "html_type" => "text",
                "update" => 1],
            "model" => ["name" => "Модель",
                "text_area" => false,
                "html_type" => "text",
                "update" => 1],
            "body_type" => ["name" => "Тип кузова",
                "text_area" => false,
                "html_type" => "foreign",
                "update" => 1],
            "colour" => ["name" => "Колір",
                "text_area" => false,
                "html_type" => "text",
                "update" => 1],
            "number_of_doors" => ["name" => "К-сть дверей",
                "text_area" => false,
                "html_type" => "number",
                "update" => 1],
            "number_of_seats" => ["name" => "К-сть місць",
                "text_area" => false,
                "html_type" => "number",
                "update" => 1],
            "manufacturer" => ["name" => "Виробник",
                "text_area" => false,
                "html_type" => "text",
                "update" => 1],
            "year_of_issue" => ["name" => "Рік виходу",
                "text_area" => false,
                "html_type" => "text",
                "update" => 1],
            "is_free" => ["name" => "Вільна",
                "text_area" => false,
                "html_type" => "number",
                "update" => 1],
        ],

        "create" => ["view" => ''],

        "pathForSaveImage" => "",

    ],

    "driver" => ["name" => "Водії",
        "foreign" => [],
        "fields" => ["callsign" => ["name" => "Ідентифікатор водія",
                "text_area" => false,
                "html_type" => "number",
                "update" => 1],
            "name" => ["name" => "Ім'я",
                "text_area" => false,
                "html_type" => "text",
                "update" => 1],
            "surname" => ["name" => "Прізвище",
                "text_area" => false,
                "html_type" => "text",
                "update" => 1],
            "patronymic" => ["name" => "По батькові",
                "text_area" => false,
                "html_type" => "text",
                "update" => 1],
            "passport" => ["name" => "Паспорт",
                "text_area" => false,
                "html_type" => "text",
                "update" => 1],
            "licence" => ["name" => "Ліцензія",
                "text_area" => false,
                "html_type" => "number",
                "update" => 1],
            "is_free" => ["name" => "Вільний",
                "text_area" => false,
                "html_type" => "number",
                "update" => 1],

        ],

        "create" => ["view" => ''],

        "pathForSaveImage" => ""
    ],


    "DiscountCards" => ["name" => "Дисконтні картки",
        "foreign" => [],
        "fields" => ["count_travels" => ["name" => "Кількість поїздок",
            "text_area" => false,
            "html_type" => "number",
            "update" => 1],
            "discount" => ["name" => "Знижка(%)",
                "text_area" => false,
                "html_type" => "number",
                "update" => 1]
             ],

        "create" => ["view" => ''],

        "pathForSaveImage" => ""
    ]


]);