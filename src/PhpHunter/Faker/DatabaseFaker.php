<?php

namespace PhpHunter\Framework\Faker;

class DatabaseFaker
{
    /**
     * @description Data Faker
     * @param string $db_faker #Mandatory
     */
    public static function dataFaker(string $db_faker): array
    {
        if ($db_faker == 'users') {
            return self::users();
        }

        if ($db_faker == 'secrets') {
            return self::secrets();
        }

        if ($db_faker == 'customers') {
            return self::customers();
        }

        if ($db_faker == 'products') {
            return self::products();
        }

        return ["error" => "Invalid Faker"];
    }

    /**
     * @description Data Faker
     * @param string $db_faker #Mandatory
     * @param array $fields #Optional
     */
    public static function dataFakerOnlyFields(string $db_faker, array $fields = []): array
    {
        if ($db_faker == 'users') {
            return self::users($fields);
        }

        if ($db_faker == 'secrets') {
            return self::secrets($fields);
        }

        if ($db_faker == 'customers') {
            return self::customers($fields);
        }

        if ($db_faker == 'products') {
            return self::products($fields);
        }

        return ["error" => "Invalid Faker"];
    }

    /**
     * @description Users
     * @param array $fields #Optional
     */
    private static function users(array $fields = []): array
    {
        $result = [
            [
                "id" => 1,
                "name" => "Mathias Kajima",
                "password" => "1234567890",
                "age" => 30,
                "phone" => "1298822113",
                "email" => "mathias@email.com"
            ],
            [
                "id" => 2,
                "name" => "Franco Rocha",
                "age" => 32,
                "password" => "8884567890",
                "phone" => "1298822901",
                "email" => "franco@email.com"
            ],
            [
                "id" => 3,
                "name" => "Joel Santana",
                "age" => 54,
                "password" => "8884567890",
                "phone" => "1298822906",
                "email" => "joel@email.com"
            ],
        ];

        /**
         * @description  SQL SELECT SIMULATE BY FILTER FIELDS
         * @example see the code below
            $fi = implode(', ', $fields);
            $sql = "
                SELECT
                    {$fi}
                FROM
                    products p
                    JOIN categories c ON c.id = p.id
                    JOIN stock s ON s.id = p.id
                WHERE
                p.active = 1";
         */

        /*SQL SELECT SIMULATE BY FILTER FIELDS*/
        if (count($fields) > 0) {
            $select = [];
            for ($i = 0; $i < count($result); $i++) {
                foreach ($result[$i] as $key => $item) {
                    if (in_array($key, $fields)) {
                        $select[$i][$key] = $item;
                    }
                }
            }
            return $select;
        }

        return $result;
    }

    /**
     * @description Secrets
     * @param array $fields #Optional
     */
    private static function secrets(array $fields = []): array
    {
        $result = [
            "DATA" => [
                "id" => 123456,
                "description" => "This is only a test",
                "list" => [
                    "object1" => "cama",
                    "object2" => "sofa",
                    "password" => "123teste"
                ]
            ],
            "SUB-DATA" => "WEBDEV4ALL",
            "SECRET0" => [
                "password" => "123128312U2H12821YH822U",
                "SECRET1" => [
                    "username" => "New Username Test",
                    "password" => "PASSWORD-1111111111111111111",
                    "SECRET2" => [
                        "password" => "PASSWORD-2222222222222222",
                        "SECRET3" => [
                            "password" => "PASSWORD-333333333",
                            "SECRET4" => [
                                "password" => "PASSWORD-444444444444444",
                                "SECRET5" => [
                                    "password" => "PASSWORD-55555",
                                    "SECRET6" => [
                                        "password" => "PASSWORD-666",
                                        "SECRET7" => [
                                            "password" => "PASSWORD-777777777777777777",
                                            "SECRET8" => [
                                                "password" => "PASSWORD-8888888",
                                                "SECRET9" => [
                                                    "password" => "PASSWORD-9999",
                                                    "SECRET10" => [
                                                        "password" => "PASSWORD-1101010101010",
                                                        "SECRET11" => [
                                                            "password" => "PASSWORD-111111"
                                                        ],
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            "POS-SECRET" => [
                "password" => "1234567890XXXXXXXXXXXXXXXXXXXXX"
            ]
        ];

        /**
         * @description  SQL SELECT SIMULATE BY FILTER FIELDS
         * @example see the code below
            $fi = implode(', ', $fields);
            $sql = "
                SELECT
                {$fi}
            FROM
                products p
                JOIN categories c ON c.id = p.id
                JOIN stock s ON s.id = p.id
            WHERE
                p.active = 1";
         */

        /*SQL SELECT SIMULATE BY FILTER FIELDS*/
        if (count($fields) > 0) {
            $select = [];
            for ($i = 0; $i < count($result); $i++) {
                foreach ($result[$i] as $key => $item) {
                    if (in_array($key, $fields)) {
                        $select[$i][$key] = $item;
                    }
                }
            }
            return $select;
        }

        return $result;
    }

    /**
     * @description Customers
     * @param array $fields #Optional
     */
    private static function customers(array $fields = []): array
    {
        $result = [
            "datafirst" => "data-test",
            [
                "id" => 1,
                "name" => "Mathias Kajima",
                "password" => "1234567890",
                "age" => 30,
                "phone" => "1298822113",
                "midias" => [
                    "facebook" => "profile.facebook.com",
                    "whatsapp" => "90211290909",
                    "youtube" => "youtube.com/profile/123456"
                ],
                "address" => [
                    "rua" => "Rua teste",
                    "numero" => 123,
                    "bairro" => "JARDIM TESTE"
                ]
            ],
            [
                "id" => 2,
                "name" => "Joeh Biden",
                "age" => 40,
                "password" => "8884567890",
                "phone" => "1298822901"
            ],
            "password" => "0x9AOI8AEYFHIUGSHDGJKDGHDSJKFHDJK",
            "others" => [
                "password" => "0x1AOI8AEYFHIUGSHDGJKDGHDSJKFHDJK"
            ],
            "data" => [
                "user" => [
                    "restrict" => [
                        "password" => "123FSFOIDJFDKLGSGSH",
                        "name" => "Hugo Boss"
                    ]
                ]
            ],
            "password2" => [
                "value" => "0x4AOI8AEYFHIUGSHDGJKDGHDSJKFHDJK"
            ],

        ];

        /**
         * @description  SQL SELECT SIMULATE BY FILTER FIELDS
         * @example see the code below
            $fi = implode(', ', $fields);
            $sql = "
                SELECT
                    {$fi}
                FROM
                    products p
                    JOIN categories c ON c.id = p.id
                    JOIN stock s ON s.id = p.id
                WHERE
                    p.active = 1";
         */

        /*SQL SELECT SIMULATE BY FILTER FIELDS*/
        if (count($fields) > 0) {
            $select = [];
            for ($i = 0; $i < count($result); $i++) {
                foreach ($result[$i] as $key => $item) {
                    if (in_array($key, $fields)) {
                        $select[$i][$key] = $item;
                    }
                }
            }
            return $select;
        }

        return $result;
    }

    /**
     * @description Products
     * @param array $fields #Optional
     */
    private static function products(array $fields = []): array
    {
        $result = [
            [
                "id" => 0001,
                "description" => "White Rice",
                "price" => "5.00",
                "stock" => 12
            ],
            [
                "id" => 0002,
                "description" => "Black Bean",
                "price" => "6.80",
                "stock" => 2
            ],
            [
                "id" => 0003,
                "description" => "Spaghetti Noodles",
                "price" => "2.00",
                "stock" => 44
            ],
            [
                "id" => 0004,
                "description" => "White Eggs",
                "price" => "8.99",
                "stock" => 21
            ],
        ];

        /**
         * @description  SQL SELECT SIMULATE BY FILTER FIELDS
         * @example see the code below
            $fi = implode(', ', $fields);
            $sql = "
                SELECT
                    {$fi}
                FROM
                    products p
                    JOIN categories c ON c.id = p.id
                    JOIN stock s ON s.id = p.id
                WHERE
                    p.active = 1";
         */

        if (count($fields) > 0) {
            $select = [];
            for ($i = 0; $i < count($result); $i++) {
                foreach ($result[$i] as $key => $item) {
                    if (in_array($key, $fields)) {
                        $select[$i][$key] = $item;
                    }
                }
            }
            return $select;
        }

        return $result;
    }
}
