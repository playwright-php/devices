<?php

declare(strict_types=1);

/*
 * This file is part of the community-maintained Playwright PHP project.
 * It is not affiliated with or endorsed by Microsoft.
 *
 * (c) 2025-Present - Playwright PHP <https://github.com/playwright-php>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'Blackberry PlayBook' => [
        'ua' => 'Mozilla/5.0 (PlayBook; U; RIM Tablet OS 2.1.0; en-US) AppleWebKit/536.2+ (KHTML like Gecko) Version/26.0 Safari/536.2+',
        'dbt' => 'webkit',
        'sf' => 1.0,
        'vp' => [
            0 => 600,
            1 => 1024,
        ],
        'vp_l' => [
            0 => 1024,
            1 => 600,
        ],
    ],
    'BlackBerry Z30' => [
        'ua' => 'Mozilla/5.0 (BB10; Touch) AppleWebKit/537.10+ (KHTML, like Gecko) Version/26.0 Mobile Safari/537.10+',
        'dbt' => 'webkit',
        'sf' => 2.0,
        'vp' => [
            0 => 360,
            1 => 640,
        ],
        'vp_l' => [
            0 => 640,
            1 => 360,
        ],
    ],
    'Desktop Chrome' => [
        'ua' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.41 Safari/537.36',
        'dbt' => 'chromium',
        'sf' => 1.0,
        'vp' => [
            0 => 1280,
            1 => 720,
        ],
        'sc' => [
            0 => 1920,
            1 => 1080,
        ],
        'm' => false,
        't' => false,
    ],
    'Desktop Chrome HiDPI' => [
        'ua' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.41 Safari/537.36',
        'dbt' => 'chromium',
        'sf' => 2.0,
        'vp' => [
            0 => 1280,
            1 => 720,
        ],
        'sc' => [
            0 => 1792,
            1 => 1120,
        ],
        'm' => false,
        't' => false,
    ],
    'Desktop Edge' => [
        'ua' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.41 Safari/537.36 Edg/140.0.7339.41',
        'dbt' => 'chromium',
        'sf' => 1.0,
        'vp' => [
            0 => 1280,
            1 => 720,
        ],
        'sc' => [
            0 => 1920,
            1 => 1080,
        ],
        'm' => false,
        't' => false,
    ],
    'Desktop Edge HiDPI' => [
        'ua' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.41 Safari/537.36 Edg/140.0.7339.41',
        'dbt' => 'chromium',
        'sf' => 2.0,
        'vp' => [
            0 => 1280,
            1 => 720,
        ],
        'sc' => [
            0 => 1792,
            1 => 1120,
        ],
        'm' => false,
        't' => false,
    ],
    'Desktop Firefox' => [
        'ua' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0',
        'dbt' => 'firefox',
        'sf' => 1.0,
        'vp' => [
            0 => 1280,
            1 => 720,
        ],
        'sc' => [
            0 => 1920,
            1 => 1080,
        ],
        'm' => false,
        't' => false,
    ],
    'Desktop Firefox HiDPI' => [
        'ua' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0',
        'dbt' => 'firefox',
        'sf' => 2.0,
        'vp' => [
            0 => 1280,
            1 => 720,
        ],
        'sc' => [
            0 => 1792,
            1 => 1120,
        ],
        'm' => false,
        't' => false,
    ],
    'Desktop Safari' => [
        'ua' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Safari/605.1.15',
        'dbt' => 'webkit',
        'sf' => 2.0,
        'vp' => [
            0 => 1280,
            1 => 720,
        ],
        'sc' => [
            0 => 1792,
            1 => 1120,
        ],
        'm' => false,
        't' => false,
    ],
    'Galaxy A55' => [
        'ua' => 'Mozilla/5.0 (Linux; Android 14; SM-A556B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.41 Mobile Safari/537.36',
        'dbt' => 'chromium',
        'sf' => 2.25,
        'vp' => [
            0 => 480,
            1 => 1040,
        ],
        'vp_l' => [
            0 => 1040,
            1 => 480,
        ],
    ],
    'Galaxy Note 3' => [
        'ua' => 'Mozilla/5.0 (Linux; U; Android 4.3; en-us; SM-N900T Build/JSS15J) AppleWebKit/534.30 (KHTML, like Gecko) Version/26.0 Mobile Safari/534.30',
        'dbt' => 'webkit',
        'sf' => 3.0,
        'vp' => [
            0 => 360,
            1 => 640,
        ],
        'vp_l' => [
            0 => 640,
            1 => 360,
        ],
    ],
    'Galaxy Note II' => [
        'ua' => 'Mozilla/5.0 (Linux; U; Android 4.1; en-us; GT-N7100 Build/JRO03C) AppleWebKit/534.30 (KHTML, like Gecko) Version/26.0 Mobile Safari/534.30',
        'dbt' => 'webkit',
        'sf' => 2.0,
        'vp' => [
            0 => 360,
            1 => 640,
        ],
        'vp_l' => [
            0 => 640,
            1 => 360,
        ],
    ],
    'Galaxy S5' => [
        'ua' => 'Mozilla/5.0 (Linux; Android 5.0; SM-G900P Build/LRX21T) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.41 Mobile Safari/537.36',
        'dbt' => 'chromium',
        'sf' => 3.0,
        'vp' => [
            0 => 360,
            1 => 640,
        ],
        'vp_l' => [
            0 => 640,
            1 => 360,
        ],
    ],
    'Galaxy S8' => [
        'ua' => 'Mozilla/5.0 (Linux; Android 7.0; SM-G950U Build/NRD90M) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.41 Mobile Safari/537.36',
        'dbt' => 'chromium',
        'sf' => 3.0,
        'vp' => [
            0 => 360,
            1 => 740,
        ],
        'vp_l' => [
            0 => 740,
            1 => 360,
        ],
    ],
    'Galaxy S9+' => [
        'ua' => 'Mozilla/5.0 (Linux; Android 8.0.0; SM-G965U Build/R16NW) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.41 Mobile Safari/537.36',
        'dbt' => 'chromium',
        'sf' => 4.5,
        'vp' => [
            0 => 320,
            1 => 658,
        ],
        'vp_l' => [
            0 => 658,
            1 => 320,
        ],
    ],
    'Galaxy S24' => [
        'ua' => 'Mozilla/5.0 (Linux; Android 14; SM-S921U) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.41 Mobile Safari/537.36',
        'dbt' => 'chromium',
        'sf' => 3.0,
        'vp' => [
            0 => 360,
            1 => 780,
        ],
        'vp_l' => [
            0 => 780,
            1 => 360,
        ],
    ],
    'Galaxy S III' => [
        'ua' => 'Mozilla/5.0 (Linux; U; Android 4.0; en-us; GT-I9300 Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/26.0 Mobile Safari/534.30',
        'dbt' => 'webkit',
        'sf' => 2.0,
        'vp' => [
            0 => 360,
            1 => 640,
        ],
        'vp_l' => [
            0 => 640,
            1 => 360,
        ],
    ],
    'Galaxy Tab S4' => [
        'ua' => 'Mozilla/5.0 (Linux; Android 8.1.0; SM-T837A) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.41 Safari/537.36',
        'dbt' => 'chromium',
        'sf' => 2.25,
        'vp' => [
            0 => 712,
            1 => 1138,
        ],
        'vp_l' => [
            0 => 1138,
            1 => 712,
        ],
    ],
    'Galaxy Tab S9' => [
        'ua' => 'Mozilla/5.0 (Linux; Android 14; SM-X710) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.41 Safari/537.36',
        'dbt' => 'chromium',
        'sf' => 2.5,
        'vp' => [
            0 => 640,
            1 => 1024,
        ],
        'vp_l' => [
            0 => 1024,
            1 => 640,
        ],
    ],
    'iPad (gen 5)' => [
        'ua' => 'Mozilla/5.0 (iPad; CPU OS 12_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1',
        'dbt' => 'webkit',
        'sf' => 2.0,
        'vp' => [
            0 => 768,
            1 => 1024,
        ],
        'vp_l' => [
            0 => 1024,
            1 => 768,
        ],
    ],
    'iPad (gen 6)' => [
        'ua' => 'Mozilla/5.0 (iPad; CPU OS 12_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1',
        'dbt' => 'webkit',
        'sf' => 2.0,
        'vp' => [
            0 => 768,
            1 => 1024,
        ],
        'vp_l' => [
            0 => 1024,
            1 => 768,
        ],
    ],
    'iPad (gen 7)' => [
        'ua' => 'Mozilla/5.0 (iPad; CPU OS 12_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1',
        'dbt' => 'webkit',
        'sf' => 2.0,
        'vp' => [
            0 => 810,
            1 => 1080,
        ],
        'vp_l' => [
            0 => 1080,
            1 => 810,
        ],
    ],
    'iPad (gen 11)' => [
        'ua' => 'Mozilla/5.0 (iPad; CPU OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/19E241 Safari/604.1',
        'dbt' => 'webkit',
        'sf' => 2.5,
        'vp' => [
            0 => 656,
            1 => 944,
        ],
        'vp_l' => [
            0 => 944,
            1 => 656,
        ],
    ],
    'iPad Mini' => [
        'ua' => 'Mozilla/5.0 (iPad; CPU OS 12_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1',
        'dbt' => 'webkit',
        'sf' => 2.0,
        'vp' => [
            0 => 768,
            1 => 1024,
        ],
        'vp_l' => [
            0 => 1024,
            1 => 768,
        ],
    ],
    'iPad Pro 11' => [
        'ua' => 'Mozilla/5.0 (iPad; CPU OS 12_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1',
        'dbt' => 'webkit',
        'sf' => 2.0,
        'vp' => [
            0 => 834,
            1 => 1194,
        ],
        'vp_l' => [
            0 => 1194,
            1 => 834,
        ],
    ],
    'iPhone 6' => [
        'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/26.0 Mobile/15A372 Safari/604.1',
        'dbt' => 'webkit',
        'sf' => 2.0,
        'vp' => [
            0 => 375,
            1 => 667,
        ],
        'vp_l' => [
            0 => 667,
            1 => 375,
        ],
    ],
    'iPhone 6 Plus' => [
        'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/26.0 Mobile/15A372 Safari/604.1',
        'dbt' => 'webkit',
        'sf' => 3.0,
        'vp' => [
            0 => 414,
            1 => 736,
        ],
        'vp_l' => [
            0 => 736,
            1 => 414,
        ],
    ],
    'iPhone 7' => [
        'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/26.0 Mobile/15A372 Safari/604.1',
        'dbt' => 'webkit',
        'sf' => 2.0,
        'vp' => [
            0 => 375,
            1 => 667,
        ],
        'vp_l' => [
            0 => 667,
            1 => 375,
        ],
    ],
    'iPhone 7 Plus' => [
        'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/26.0 Mobile/15A372 Safari/604.1',
        'dbt' => 'webkit',
        'sf' => 3.0,
        'vp' => [
            0 => 414,
            1 => 736,
        ],
        'vp_l' => [
            0 => 736,
            1 => 414,
        ],
    ],
    'iPhone 8' => [
        'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/26.0 Mobile/15A372 Safari/604.1',
        'dbt' => 'webkit',
        'sf' => 2.0,
        'vp' => [
            0 => 375,
            1 => 667,
        ],
        'vp_l' => [
            0 => 667,
            1 => 375,
        ],
    ],
    'iPhone 8 Plus' => [
        'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/26.0 Mobile/15A372 Safari/604.1',
        'dbt' => 'webkit',
        'sf' => 3.0,
        'vp' => [
            0 => 414,
            1 => 736,
        ],
        'vp_l' => [
            0 => 736,
            1 => 414,
        ],
    ],
    'iPhone 11' => [
        'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 12_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1',
        'dbt' => 'webkit',
        'sf' => 2.0,
        'vp' => [
            0 => 414,
            1 => 715,
        ],
        'sc' => [
            0 => 414,
            1 => 896,
        ],
        'vp_l' => [
            0 => 800,
            1 => 364,
        ],
    ],
    'iPhone 11 Pro' => [
        'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 12_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1',
        'dbt' => 'webkit',
        'sf' => 3.0,
        'vp' => [
            0 => 375,
            1 => 635,
        ],
        'sc' => [
            0 => 375,
            1 => 812,
        ],
        'vp_l' => [
            0 => 724,
            1 => 325,
        ],
    ],
    'iPhone 11 Pro Max' => [
        'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 12_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1',
        'dbt' => 'webkit',
        'sf' => 3.0,
        'vp' => [
            0 => 414,
            1 => 715,
        ],
        'sc' => [
            0 => 414,
            1 => 896,
        ],
        'vp_l' => [
            0 => 808,
            1 => 364,
        ],
    ],
    'iPhone 12' => [
        'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_4 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1',
        'dbt' => 'webkit',
        'sf' => 3.0,
        'vp' => [
            0 => 390,
            1 => 664,
        ],
        'sc' => [
            0 => 390,
            1 => 844,
        ],
        'vp_l' => [
            0 => 750,
            1 => 340,
        ],
    ],
    'iPhone 12 Mini' => [
        'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_4 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1',
        'dbt' => 'webkit',
        'sf' => 3.0,
        'vp' => [
            0 => 375,
            1 => 629,
        ],
        'sc' => [
            0 => 375,
            1 => 812,
        ],
        'vp_l' => [
            0 => 712,
            1 => 325,
        ],
    ],
    'iPhone 12 Pro' => [
        'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_4 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1',
        'dbt' => 'webkit',
        'sf' => 3.0,
        'vp' => [
            0 => 390,
            1 => 664,
        ],
        'sc' => [
            0 => 390,
            1 => 844,
        ],
        'vp_l' => [
            0 => 750,
            1 => 340,
        ],
    ],
    'iPhone 12 Pro Max' => [
        'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_4 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1',
        'dbt' => 'webkit',
        'sf' => 3.0,
        'vp' => [
            0 => 428,
            1 => 746,
        ],
        'sc' => [
            0 => 428,
            1 => 926,
        ],
        'vp_l' => [
            0 => 832,
            1 => 378,
        ],
    ],
    'iPhone 13' => [
        'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1',
        'dbt' => 'webkit',
        'sf' => 3.0,
        'vp' => [
            0 => 390,
            1 => 664,
        ],
        'sc' => [
            0 => 390,
            1 => 844,
        ],
        'vp_l' => [
            0 => 750,
            1 => 342,
        ],
    ],
    'iPhone 13 Mini' => [
        'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1',
        'dbt' => 'webkit',
        'sf' => 3.0,
        'vp' => [
            0 => 375,
            1 => 629,
        ],
        'sc' => [
            0 => 375,
            1 => 812,
        ],
        'vp_l' => [
            0 => 712,
            1 => 327,
        ],
    ],
    'iPhone 13 Pro' => [
        'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1',
        'dbt' => 'webkit',
        'sf' => 3.0,
        'vp' => [
            0 => 390,
            1 => 664,
        ],
        'sc' => [
            0 => 390,
            1 => 844,
        ],
        'vp_l' => [
            0 => 750,
            1 => 342,
        ],
    ],
    'iPhone 13 Pro Max' => [
        'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1',
        'dbt' => 'webkit',
        'sf' => 3.0,
        'vp' => [
            0 => 428,
            1 => 746,
        ],
        'sc' => [
            0 => 428,
            1 => 926,
        ],
        'vp_l' => [
            0 => 832,
            1 => 380,
        ],
    ],
    'iPhone 14' => [
        'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1',
        'dbt' => 'webkit',
        'sf' => 3.0,
        'vp' => [
            0 => 390,
            1 => 664,
        ],
        'sc' => [
            0 => 390,
            1 => 844,
        ],
        'vp_l' => [
            0 => 750,
            1 => 340,
        ],
    ],
    'iPhone 14 Plus' => [
        'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1',
        'dbt' => 'webkit',
        'sf' => 3.0,
        'vp' => [
            0 => 428,
            1 => 746,
        ],
        'sc' => [
            0 => 428,
            1 => 926,
        ],
        'vp_l' => [
            0 => 832,
            1 => 378,
        ],
    ],
    'iPhone 14 Pro' => [
        'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1',
        'dbt' => 'webkit',
        'sf' => 3.0,
        'vp' => [
            0 => 393,
            1 => 660,
        ],
        'sc' => [
            0 => 393,
            1 => 852,
        ],
        'vp_l' => [
            0 => 734,
            1 => 343,
        ],
    ],
    'iPhone 14 Pro Max' => [
        'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1',
        'dbt' => 'webkit',
        'sf' => 3.0,
        'vp' => [
            0 => 430,
            1 => 740,
        ],
        'sc' => [
            0 => 430,
            1 => 932,
        ],
        'vp_l' => [
            0 => 814,
            1 => 380,
        ],
    ],
    'iPhone 15' => [
        'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1',
        'dbt' => 'webkit',
        'sf' => 3.0,
        'vp' => [
            0 => 393,
            1 => 659,
        ],
        'sc' => [
            0 => 393,
            1 => 852,
        ],
        'vp_l' => [
            0 => 734,
            1 => 343,
        ],
    ],
    'iPhone 15 Plus' => [
        'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1',
        'dbt' => 'webkit',
        'sf' => 3.0,
        'vp' => [
            0 => 430,
            1 => 739,
        ],
        'sc' => [
            0 => 430,
            1 => 932,
        ],
        'vp_l' => [
            0 => 814,
            1 => 380,
        ],
    ],
    'iPhone 15 Pro' => [
        'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1',
        'dbt' => 'webkit',
        'sf' => 3.0,
        'vp' => [
            0 => 393,
            1 => 659,
        ],
        'sc' => [
            0 => 393,
            1 => 852,
        ],
        'vp_l' => [
            0 => 734,
            1 => 343,
        ],
    ],
    'iPhone 15 Pro Max' => [
        'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1',
        'dbt' => 'webkit',
        'sf' => 3.0,
        'vp' => [
            0 => 430,
            1 => 739,
        ],
        'sc' => [
            0 => 430,
            1 => 932,
        ],
        'vp_l' => [
            0 => 814,
            1 => 380,
        ],
    ],
    'iPhone SE' => [
        'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_1 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/26.0 Mobile/14E304 Safari/602.1',
        'dbt' => 'webkit',
        'sf' => 2.0,
        'vp' => [
            0 => 320,
            1 => 568,
        ],
        'vp_l' => [
            0 => 568,
            1 => 320,
        ],
    ],
    'iPhone SE (3rd gen)' => [
        'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/26.0 Mobile/19E241 Safari/602.1',
        'dbt' => 'webkit',
        'sf' => 2.0,
        'vp' => [
            0 => 375,
            1 => 667,
        ],
        'vp_l' => [
            0 => 667,
            1 => 375,
        ],
    ],
    'iPhone X' => [
        'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/26.0 Mobile/15A372 Safari/604.1',
        'dbt' => 'webkit',
        'sf' => 3.0,
        'vp' => [
            0 => 375,
            1 => 812,
        ],
        'vp_l' => [
            0 => 812,
            1 => 375,
        ],
    ],
    'iPhone XR' => [
        'ua' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 12_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Mobile/15E148 Safari/604.1',
        'dbt' => 'webkit',
        'sf' => 3.0,
        'vp' => [
            0 => 414,
            1 => 896,
        ],
        'vp_l' => [
            0 => 896,
            1 => 414,
        ],
    ],
    'Kindle Fire HDX' => [
        'ua' => 'Mozilla/5.0 (Linux; U; en-us; KFAPWI Build/JDQ39) AppleWebKit/535.19 (KHTML, like Gecko) Silk/3.13 Safari/535.19 Silk-Accelerated=true',
        'dbt' => 'webkit',
        'sf' => 2.0,
        'vp' => [
            0 => 800,
            1 => 1280,
        ],
        'vp_l' => [
            0 => 1280,
            1 => 800,
        ],
    ],
    'LG Optimus L70' => [
        'ua' => 'Mozilla/5.0 (Linux; U; Android 4.4.2; en-us; LGMS323 Build/KOT49I.MS32310c) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/140.0.7339.41 Mobile Safari/537.36',
        'dbt' => 'chromium',
        'sf' => 1.25,
        'vp' => [
            0 => 384,
            1 => 640,
        ],
        'vp_l' => [
            0 => 640,
            1 => 384,
        ],
    ],
    'Microsoft Lumia 550' => [
        'ua' => 'Mozilla/5.0 (Windows Phone 10.0; Android 4.2.1; Microsoft; Lumia 550) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.41 Mobile Safari/537.36 Edge/14.14263',
        'dbt' => 'chromium',
        'sf' => 2.0,
        'vp' => [
            0 => 360,
            1 => 640,
        ],
        'vp_l' => [
            0 => 640,
            1 => 360,
        ],
    ],
    'Microsoft Lumia 950' => [
        'ua' => 'Mozilla/5.0 (Windows Phone 10.0; Android 4.2.1; Microsoft; Lumia 950) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.41 Mobile Safari/537.36 Edge/14.14263',
        'dbt' => 'chromium',
        'sf' => 4.0,
        'vp' => [
            0 => 360,
            1 => 640,
        ],
        'vp_l' => [
            0 => 640,
            1 => 360,
        ],
    ],
    'Moto G4' => [
        'ua' => 'Mozilla/5.0 (Linux; Android 7.0; Moto G (4)) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.41 Mobile Safari/537.36',
        'dbt' => 'chromium',
        'sf' => 3.0,
        'vp' => [
            0 => 360,
            1 => 640,
        ],
        'vp_l' => [
            0 => 640,
            1 => 360,
        ],
    ],
    'Nexus 4' => [
        'ua' => 'Mozilla/5.0 (Linux; Android 4.4.2; Nexus 4 Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.41 Mobile Safari/537.36',
        'dbt' => 'chromium',
        'sf' => 2.0,
        'vp' => [
            0 => 384,
            1 => 640,
        ],
        'vp_l' => [
            0 => 640,
            1 => 384,
        ],
    ],
    'Nexus 5' => [
        'ua' => 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.41 Mobile Safari/537.36',
        'dbt' => 'chromium',
        'sf' => 3.0,
        'vp' => [
            0 => 360,
            1 => 640,
        ],
        'vp_l' => [
            0 => 640,
            1 => 360,
        ],
    ],
    'Nexus 5X' => [
        'ua' => 'Mozilla/5.0 (Linux; Android 8.0.0; Nexus 5X Build/OPR4.170623.006) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.41 Mobile Safari/537.36',
        'dbt' => 'chromium',
        'sf' => 2.625,
        'vp' => [
            0 => 412,
            1 => 732,
        ],
        'vp_l' => [
            0 => 732,
            1 => 412,
        ],
    ],
    'Nexus 6' => [
        'ua' => 'Mozilla/5.0 (Linux; Android 7.1.1; Nexus 6 Build/N6F26U) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.41 Mobile Safari/537.36',
        'dbt' => 'chromium',
        'sf' => 3.5,
        'vp' => [
            0 => 412,
            1 => 732,
        ],
        'vp_l' => [
            0 => 732,
            1 => 412,
        ],
    ],
    'Nexus 6P' => [
        'ua' => 'Mozilla/5.0 (Linux; Android 8.0.0; Nexus 6P Build/OPP3.170518.006) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.41 Mobile Safari/537.36',
        'dbt' => 'chromium',
        'sf' => 3.5,
        'vp' => [
            0 => 412,
            1 => 732,
        ],
        'vp_l' => [
            0 => 732,
            1 => 412,
        ],
    ],
    'Nexus 7' => [
        'ua' => 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 7 Build/MOB30X) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.41 Safari/537.36',
        'dbt' => 'chromium',
        'sf' => 2.0,
        'vp' => [
            0 => 600,
            1 => 960,
        ],
        'vp_l' => [
            0 => 960,
            1 => 600,
        ],
    ],
    'Nexus 10' => [
        'ua' => 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 10 Build/MOB31T) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.41 Safari/537.36',
        'dbt' => 'chromium',
        'sf' => 2.0,
        'vp' => [
            0 => 800,
            1 => 1280,
        ],
        'vp_l' => [
            0 => 1280,
            1 => 800,
        ],
    ],
    'Nokia Lumia 520' => [
        'ua' => 'Mozilla/5.0 (compatible; MSIE 10.0; Windows Phone 8.0; Trident/6.0; IEMobile/10.0; ARM; Touch; NOKIA; Lumia 520)',
        'dbt' => 'chromium',
        'sf' => 1.5,
        'vp' => [
            0 => 320,
            1 => 533,
        ],
        'vp_l' => [
            0 => 533,
            1 => 320,
        ],
    ],
    'Nokia N9' => [
        'ua' => 'Mozilla/5.0 (MeeGo; NokiaN9) AppleWebKit/534.13 (KHTML, like Gecko) NokiaBrowser/8.5.0 Mobile Safari/534.13',
        'dbt' => 'webkit',
        'sf' => 1.0,
        'vp' => [
            0 => 480,
            1 => 854,
        ],
        'vp_l' => [
            0 => 854,
            1 => 480,
        ],
    ],
    'Pixel 2' => [
        'ua' => 'Mozilla/5.0 (Linux; Android 8.0; Pixel 2 Build/OPD3.170816.012) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.41 Mobile Safari/537.36',
        'dbt' => 'chromium',
        'sf' => 2.625,
        'vp' => [
            0 => 411,
            1 => 731,
        ],
        'vp_l' => [
            0 => 731,
            1 => 411,
        ],
    ],
    'Pixel 2 XL' => [
        'ua' => 'Mozilla/5.0 (Linux; Android 8.0.0; Pixel 2 XL Build/OPD1.170816.004) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.41 Mobile Safari/537.36',
        'dbt' => 'chromium',
        'sf' => 3.5,
        'vp' => [
            0 => 411,
            1 => 823,
        ],
        'vp_l' => [
            0 => 823,
            1 => 411,
        ],
    ],
    'Pixel 3' => [
        'ua' => 'Mozilla/5.0 (Linux; Android 9; Pixel 3 Build/PQ1A.181105.017.A1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.41 Mobile Safari/537.36',
        'dbt' => 'chromium',
        'sf' => 2.75,
        'vp' => [
            0 => 393,
            1 => 786,
        ],
        'vp_l' => [
            0 => 786,
            1 => 393,
        ],
    ],
    'Pixel 4' => [
        'ua' => 'Mozilla/5.0 (Linux; Android 10; Pixel 4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.41 Mobile Safari/537.36',
        'dbt' => 'chromium',
        'sf' => 3.0,
        'vp' => [
            0 => 353,
            1 => 745,
        ],
        'vp_l' => [
            0 => 745,
            1 => 353,
        ],
    ],
    'Pixel 4a (5G)' => [
        'ua' => 'Mozilla/5.0 (Linux; Android 11; Pixel 4a (5G)) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.41 Mobile Safari/537.36',
        'dbt' => 'chromium',
        'sf' => 2.63,
        'vp' => [
            0 => 412,
            1 => 765,
        ],
        'sc' => [
            0 => 412,
            1 => 892,
        ],
        'vp_l' => [
            0 => 840,
            1 => 312,
        ],
    ],
    'Pixel 5' => [
        'ua' => 'Mozilla/5.0 (Linux; Android 11; Pixel 5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.41 Mobile Safari/537.36',
        'dbt' => 'chromium',
        'sf' => 2.75,
        'vp' => [
            0 => 393,
            1 => 727,
        ],
        'sc' => [
            0 => 393,
            1 => 851,
        ],
        'vp_l' => [
            0 => 802,
            1 => 293,
        ],
    ],
    'Pixel 7' => [
        'ua' => 'Mozilla/5.0 (Linux; Android 14; Pixel 7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.41 Mobile Safari/537.36',
        'dbt' => 'chromium',
        'sf' => 2.625,
        'vp' => [
            0 => 412,
            1 => 839,
        ],
        'sc' => [
            0 => 412,
            1 => 915,
        ],
        'vp_l' => [
            0 => 863,
            1 => 360,
        ],
    ],
];
