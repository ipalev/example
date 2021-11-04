<?namespace Its\CPManager\Project;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class UserFieldScope {
    public static $enumValues = [
        'ITS_CPM_PROPOSAL' => [
            'UF_HIDE_PRICES' => [
                ['XML_ID' => 'y', 'VALUE' => 'Не показывать цены'],
            ],
            'UF_DOC_TYPE' => [
                ['XML_ID' => 'simple_cpm', 'VALUE' => 'Простое КП'],
//                ['XML_ID' => 'wine_card', 'VALUE' => 'Карта вин'],
                ['XML_ID' => 'chain', 'VALUE' => 'Для сетей (только Excel)'],
            ],
            'UF_ADD_FIELDS' => [
                ['XML_ID' => 'ELEMENT.NAME', 'VALUE' => 'Название'],
                ['XML_ID' => 'ELEMENT.DETAIL_PICTURE', 'VALUE' => 'Фотография'],
                ['XML_ID' => 'ELEMENT.DETAIL_TEXT', 'VALUE' => 'Описание'],
                ['XML_ID' => 'ELEMENT.PROPERTY_TIP', 'VALUE' => 'Тип'],
                ['XML_ID' => 'ELEMENT.PROPERTY_OBEM', 'VALUE' => 'Объём'],
                ['XML_ID' => 'ELEMENT.PROPERTY_KLASS', 'VALUE' => 'Класс'],
                ['XML_ID' => 'ELEMENT.PROPERTY_BREND', 'VALUE' => 'Бренд'],
                ['XML_ID' => 'ELEMENT.PROPERTY_SAKHAR', 'VALUE' => 'Сахар'],
                ['XML_ID' => 'ELEMENT.PROPERTY_STRANA', 'VALUE' => 'Страна'],
                ['XML_ID' => 'ELEMENT.PROPERTY_LABEL', 'VALUE' => 'Лейбл'],
                ['XML_ID' => 'ELEMENT.PROPERTY_REGION', 'VALUE' => 'Регион'],
                ['XML_ID' => 'ELEMENT.PROPERTY_TIP_TSVET', 'VALUE' => 'Цвет'],
                ['XML_ID' => 'ELEMENT.PROPERTY_KREPOST', 'VALUE' => 'Крепость'],
                ['XML_ID' => 'ELEMENT.PROPERTY_VINOGRAD', 'VALUE' => 'Виноград'],
                ['XML_ID' => 'ELEMENT.PROPERTY_CML2_BAR_CODE', 'VALUE' => 'Штрих-код'],
                ['XML_ID' => 'ELEMENT.PROPERTY_PROIZVODITEL', 'VALUE' => 'Производитель'],
                ['XML_ID' => 'ELEMENT.PROPERTY_SORTOVOY_SOSTAV', 'VALUE' => 'Сортовой состав'],
                ['XML_ID' => 'ELEMENT.PROPERTY_KOLICHESTVO_V_UPAKOVKE', 'VALUE' => 'Кол-во в упаковке'],
                ['XML_ID' => 'ELEMENT.PROPERTY_SORTA_VINOGRADA_S_PROTSENTAMI', 'VALUE' => 'Сортовой состав (с процентами)'],
                ['XML_ID' => 'ELEMENT.PROPERTY_DEGUSTATSIONNYE_KHARAKTERISTIKI', 'VALUE' => 'Дегустационные характеристики'],
                ['XML_ID' => 'ELEMENT.PROPERTY_GASTRONOMICHESKOE_SOPROVOZHDENIE', 'VALUE' => 'Гастрономическое сопровождение'],

                ['XML_ID' => 'EXPR.AWARDS', 'VALUE' => 'Награды'],
                ['XML_ID' => 'EXPR.FINAL_PRICE', 'VALUE' => 'Цена'],
                ['XML_ID' => 'EXPR.TOTAL_PRICE', 'VALUE' => 'Сумма'],

                ['XML_ID' => 'PRICE', 'VALUE' => 'Прайс-лист'],
                ['XML_ID' => 'QUANTITY', 'VALUE' => 'Количество'],
                ['XML_ID' => 'UF_DISCOUNT_PRCNT', 'VALUE' => 'Скидка'],
            ],
            'UF_NO_COND_INFO' => [
                ['XML_ID' => 'y', 'VALUE' => 'Не выводить титульный лист'],
            ],
        ],
        'ITS_CPM_PRODUCT' => [
            'UF_WINE_TO_GLASS' => [
                ['XML_ID' => 'y', 'VALUE' => 'Вино по бокалам'],
            ],
        ]
    ];

    public static $proposal = [
        [
            'ENTITY_ID'         => 'ITS_CPM_PROPOSAL',
            'FIELD_NAME'        => 'UF_DISCOUNT_PRCNT',
            'USER_TYPE_ID'      => \CUserTypeDouble::USER_TYPE_ID,
            'MULTIPLE'          => 'N',
            'MANDATORY'         => 'N',
            'SHOW_FILTER'       => 'Y',
            'IS_SEARCHABLE'     => 'N',
            'SETTINGS'          => [
                'PRECISION'         => '3',
            ],

            'EDIT_FORM_LABEL'   => ['ru' => 'Скидка на все товары'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Скидка на все товары'],
            'LIST_FILTER_LABEL' => ['ru' => 'Скидка на все товары'],
        ],
        [
            'ENTITY_ID'         => 'ITS_CPM_PROPOSAL',
            'FIELD_NAME'        => 'UF_HIDE_PRICES',
            'USER_TYPE_ID'      => 'enumeration',
            'MULTIPLE'          => 'N',
            'MANDATORY'         => 'N',
            'SHOW_FILTER'       => 'Y',
            'IS_SEARCHABLE'     => 'N',

            'EDIT_FORM_LABEL'   => ['ru' => 'Не показывать цены'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Не показывать цены'],
            'LIST_FILTER_LABEL' => ['ru' => 'Не показывать цены'],
        ],
        [
            'ENTITY_ID'         => 'ITS_CPM_PROPOSAL',
            'FIELD_NAME'        => 'UF_DOC_TYPE',
            'USER_TYPE_ID'      => 'enumeration',
            'MULTIPLE'          => 'N',
            'MANDATORY'         => 'N',
            'SHOW_FILTER'       => 'Y',
            'IS_SEARCHABLE'     => 'N',

            'EDIT_FORM_LABEL'   => ['ru' => 'Тип документа'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Тип документа'],
            'LIST_FILTER_LABEL' => ['ru' => 'Тип документа'],
        ],
        [
            'ENTITY_ID'         => 'ITS_CPM_PROPOSAL',
            'FIELD_NAME'        => 'UF_ADD_FIELDS',
            'USER_TYPE_ID'      => 'enumeration',
            'MULTIPLE'          => 'Y',
            'MANDATORY'         => 'N',
            'SHOW_FILTER'       => 'Y',
            'IS_SEARCHABLE'     => 'N',

            'EDIT_FORM_LABEL'   => ['ru' => 'Дополнительные поля'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Дополнительные поля'],
            'LIST_FILTER_LABEL' => ['ru' => 'Дополнительные поля'],
        ],
        [
            'ENTITY_ID'         => 'ITS_CPM_PROPOSAL',
            'FIELD_NAME'        => 'UF_NO_COND_INFO',
            'USER_TYPE_ID'      => 'enumeration',
            'MULTIPLE'          => 'N',
            'MANDATORY'         => 'N',
            'SHOW_FILTER'       => 'Y',
            'IS_SEARCHABLE'     => 'N',

            'EDIT_FORM_LABEL'   => ['ru' => 'Не выводить титульный лист'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Не выводить титульный лист'],
            'LIST_FILTER_LABEL' => ['ru' => 'Не выводить титульный лист'],
        ],
        [
            'ENTITY_ID'         => 'ITS_CPM_PROPOSAL',
            'FIELD_NAME'        => 'UF_INF_TERMS',
            'SORT'              => '501',
            'USER_TYPE_ID'      => 'string',
            'MULTIPLE'          => 'N',
            'MANDATORY'         => 'N',
            'SHOW_FILTER'       => 'Y',
            'IS_SEARCHABLE'     => 'N',
            'SETTINGS'          => [
                'ROWS' => '5'
            ],

            'EDIT_FORM_LABEL'   => ['ru' => 'Коммерческие условия'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Коммерческие условия'],
            'LIST_FILTER_LABEL' => ['ru' => 'Коммерческие условия'],
        ],
        [
            'ENTITY_ID'         => 'ITS_CPM_PROPOSAL',
            'FIELD_NAME'        => 'UF_CONTACT_NAME',
            'SORT'              => '502',
            'USER_TYPE_ID'      => 'string',
            'MULTIPLE'          => 'N',
            'MANDATORY'         => 'N',
            'SHOW_FILTER'       => 'Y',
            'IS_SEARCHABLE'     => 'N',

            'EDIT_FORM_LABEL'   => ['ru' => 'Имя'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Имя'],
            'LIST_FILTER_LABEL' => ['ru' => 'Имя'],
        ],
        [
            'ENTITY_ID'         => 'ITS_CPM_PROPOSAL',
            'FIELD_NAME'        => 'UF_CONTACT_POS',
            'SORT'              => '503',
            'USER_TYPE_ID'      => 'string',
            'MULTIPLE'          => 'N',
            'MANDATORY'         => 'N',
            'SHOW_FILTER'       => 'Y',
            'IS_SEARCHABLE'     => 'N',

            'EDIT_FORM_LABEL'   => ['ru' => 'Должность'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Должность'],
            'LIST_FILTER_LABEL' => ['ru' => 'Должность'],
        ],
        [
            'ENTITY_ID'         => 'ITS_CPM_PROPOSAL',
            'FIELD_NAME'        => 'UF_CONTACT_COMPANY',
            'SORT'              => '504',
            'USER_TYPE_ID'      => 'string',
            'MULTIPLE'          => 'N',
            'MANDATORY'         => 'N',
            'SHOW_FILTER'       => 'Y',
            'IS_SEARCHABLE'     => 'N',

            'EDIT_FORM_LABEL'   => ['ru' => 'Компания'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Компания'],
            'LIST_FILTER_LABEL' => ['ru' => 'Компания'],
        ],
        [
            'ENTITY_ID'         => 'ITS_CPM_PROPOSAL',
            'FIELD_NAME'        => 'UF_CONTACT_EMAIL',
            'SORT'              => '505',
            'USER_TYPE_ID'      => 'string',
            'MULTIPLE'          => 'N',
            'MANDATORY'         => 'N',
            'SHOW_FILTER'       => 'Y',
            'IS_SEARCHABLE'     => 'N',

            'EDIT_FORM_LABEL'   => ['ru' => 'E-mail'],
            'LIST_COLUMN_LABEL' => ['ru' => 'E-mail'],
            'LIST_FILTER_LABEL' => ['ru' => 'E-mail'],
        ],
        [
            'ENTITY_ID'         => 'ITS_CPM_PROPOSAL',
            'FIELD_NAME'        => 'UF_CONTACT_PHONE',
            'SORT'              => '506',
            'USER_TYPE_ID'      => 'string',
            'MULTIPLE'          => 'N',
            'MANDATORY'         => 'N',
            'SHOW_FILTER'       => 'Y',
            'IS_SEARCHABLE'     => 'N',

            'EDIT_FORM_LABEL'   => ['ru' => 'Номер телефона'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Номер телефона'],
            'LIST_FILTER_LABEL' => ['ru' => 'Номер телефона'],
        ],
    ];

    public static $smpProposal = [
        [
            'ENTITY_ID'         => 'ITS_CPM_SMP_PROPOSAL',
            'FIELD_NAME'        => 'UF_INF_TERMS',
            'SORT'              => '102',
            'USER_TYPE_ID'      => 'string',
            'MULTIPLE'          => 'N',
            'MANDATORY'         => 'N',
            'SHOW_FILTER'       => 'Y',
            'IS_SEARCHABLE'     => 'N',
            'SETTINGS'          => [
                'ROWS' => '5'
            ],

            'EDIT_FORM_LABEL'   => ['ru' => 'Коммерческие условия'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Коммерческие условия'],
            'LIST_FILTER_LABEL' => ['ru' => 'Коммерческие условия'],
        ],
        [
            'ENTITY_ID'         => 'ITS_CPM_SMP_PROPOSAL',
            'FIELD_NAME'        => 'UF_CONTACT_NAME',
            'SORT'              => '201',
            'USER_TYPE_ID'      => 'string',
            'MULTIPLE'          => 'N',
            'MANDATORY'         => 'N',
            'SHOW_FILTER'       => 'Y',
            'IS_SEARCHABLE'     => 'N',

            'EDIT_FORM_LABEL'   => ['ru' => 'Имя'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Имя'],
            'LIST_FILTER_LABEL' => ['ru' => 'Имя'],
        ],
        [
            'ENTITY_ID'         => 'ITS_CPM_SMP_PROPOSAL',
            'FIELD_NAME'        => 'UF_CONTACT_POS',
            'SORT'              => '202',
            'USER_TYPE_ID'      => 'string',
            'MULTIPLE'          => 'N',
            'MANDATORY'         => 'N',
            'SHOW_FILTER'       => 'Y',
            'IS_SEARCHABLE'     => 'N',

            'EDIT_FORM_LABEL'   => ['ru' => 'Должность'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Должность'],
            'LIST_FILTER_LABEL' => ['ru' => 'Должность'],
        ],
        [
            'ENTITY_ID'         => 'ITS_CPM_SMP_PROPOSAL',
            'FIELD_NAME'        => 'UF_CONTACT_COMPANY',
            'SORT'              => '203',
            'USER_TYPE_ID'      => 'string',
            'MULTIPLE'          => 'N',
            'MANDATORY'         => 'N',
            'SHOW_FILTER'       => 'Y',
            'IS_SEARCHABLE'     => 'N',

            'EDIT_FORM_LABEL'   => ['ru' => 'Компания'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Компания'],
            'LIST_FILTER_LABEL' => ['ru' => 'Компания'],
        ],
        [
            'ENTITY_ID'         => 'ITS_CPM_SMP_PROPOSAL',
            'FIELD_NAME'        => 'UF_CONTACT_EMAIL',
            'SORT'              => '204',
            'USER_TYPE_ID'      => 'string',
            'MULTIPLE'          => 'N',
            'MANDATORY'         => 'N',
            'SHOW_FILTER'       => 'Y',
            'IS_SEARCHABLE'     => 'N',

            'EDIT_FORM_LABEL'   => ['ru' => 'E-mail'],
            'LIST_COLUMN_LABEL' => ['ru' => 'E-mail'],
            'LIST_FILTER_LABEL' => ['ru' => 'E-mail'],
        ],
        [
            'ENTITY_ID'         => 'ITS_CPM_SMP_PROPOSAL',
            'FIELD_NAME'        => 'UF_CONTACT_PHONE',
            'SORT'              => '205',
            'USER_TYPE_ID'      => 'string',
            'MULTIPLE'          => 'N',
            'MANDATORY'         => 'N',
            'SHOW_FILTER'       => 'Y',
            'IS_SEARCHABLE'     => 'N',

            'EDIT_FORM_LABEL'   => ['ru' => 'Номер телефона'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Номер телефона'],
            'LIST_FILTER_LABEL' => ['ru' => 'Номер телефона'],
        ],
    ];

    public static $product = [
        [
            'ENTITY_ID'         => 'ITS_CPM_PRODUCT',
            'FIELD_NAME'        => 'UF_DISCOUNT_PRCNT',
            'USER_TYPE_ID'      => \CUserTypeDouble::USER_TYPE_ID,
            'MULTIPLE'          => 'N',
            'MANDATORY'         => 'N',
            'SHOW_FILTER'       => 'Y',
            'IS_SEARCHABLE'     => 'N',

            'EDIT_FORM_LABEL'   => ['ru' => 'Скидка'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Скидка'],
            'LIST_FILTER_LABEL' => ['ru' => 'Скидка'],
        ],
        [
            'ENTITY_ID'         => 'ITS_CPM_PRODUCT',
            'FIELD_NAME'        => 'UF_WINE_TO_GLASS',
            'USER_TYPE_ID'      => 'enumeration',
            'MULTIPLE'          => 'N',
            'MANDATORY'         => 'N',
            'SHOW_FILTER'       => 'Y',
            'IS_SEARCHABLE'     => 'N',

            'EDIT_FORM_LABEL'   => ['ru' => 'Вино по бокалам'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Вино по бокалам'],
            'LIST_FILTER_LABEL' => ['ru' => 'Вино по бокалам'],
        ],

    ];

    public static $proposalCategory = [
        [
            'ENTITY_ID'         => 'ITS_CPM_PROPOSAL_CAT',
            'FIELD_NAME'        => 'UF_DISCOUNT_PRCNT',
            'USER_TYPE_ID'      => \CUserTypeDouble::USER_TYPE_ID,
            'MULTIPLE'          => 'N',
            'MANDATORY'         => 'N',
            'SHOW_FILTER'       => 'Y',
            'IS_SEARCHABLE'     => 'N',

            'EDIT_FORM_LABEL'   => ['ru' => 'Скидка'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Скидка'],
            'LIST_FILTER_LABEL' => ['ru' => 'Скидка'],
        ],
    ];
}