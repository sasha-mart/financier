<?php
declare(strict_types=1);

namespace App\Tests\Functional\ParserService;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Tests\Utils\RollbackDatabaseTrait;

class AlfaBankStrategyTest extends ApiTestCase
{
    use RollbackDatabaseTrait;

    public function testParsingPositive()
    {
        $base64 = base64_encode(file_get_contents(__DIR__ . '/../../Resources/alfabank_test_report.csv'));
        $response = static::createClient()->request(
            'POST',
            '/api/v1/parser/alfa',
            [
                'json' => [
                    'file' => $base64,
                    'dateFrom' => '2020-03-01',
                    'dateTo' => '2020-03-30',
                ],
                'headers' => [
                    'CONTENT_TYPE' => 'application/json',
                ],
            ]
        );

        self::assertResponseStatusCodeSame(201);
    }
}