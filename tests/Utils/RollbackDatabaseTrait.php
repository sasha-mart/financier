<?php

namespace App\Tests\Utils;

use LogicException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Трейт, необходимый для изоляции транзакций в бд, т.е. возвращения бд в исходное состояние после выполнения теста.
 */
trait RollbackDatabaseTrait
{

    /**
     * @var string|null The name of the Doctrine connection to use
     */
    protected static $connection;

    protected static function ensureKernelTestCase(): void
    {
        if (!is_a(static::class, KernelTestCase::class, true)) {
            throw new LogicException(sprintf('The test class must extend "%s" to use "%s".', KernelTestCase::class, static::class));
        }
    }

    protected static function bootKernel(array $options = [])
    {
        static::ensureKernelTestCase();
        $kernel = parent::bootKernel($options);

        $container = static::$container ?? static::$kernel->getContainer();
        $container->get('doctrine')->getConnection(static::$connection)->beginTransaction();

        return $kernel;
    }

    protected static function ensureKernelShutdown()
    {
        $container = static::$container ?? null;
        if (null === $container && null !== static::$kernel) {
            $container = static::$kernel->getContainer();
        }

        if (null !== $container) {
            $connection = $container->get('doctrine')->getConnection(static::$connection);
            if ($connection->isTransactionActive()) {
                $connection->rollback();
            }
        }

        parent::ensureKernelShutdown();
    }
}
