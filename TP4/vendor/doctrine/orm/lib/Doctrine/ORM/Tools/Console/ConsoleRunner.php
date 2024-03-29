<?php

/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license. For more information, see
 * <http://www.doctrine-project.org>.
 */

namespace Doctrine\ORM\Tools\Console;

use Doctrine\DBAL\Tools\Console as DBALConsole;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\ConnectionFromManagerProvider;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\HelperSetManagerProvider;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use OutOfBoundsException;
use PackageVersions\Versions;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Helper\HelperSet;

/**
 * Handles running the Console Tools inside Symfony Console context.
 */
final class ConsoleRunner
{
    /**
     * Create a Symfony Console HelperSet
     */
    public static function createHelperSet(EntityManagerInterface $entityManager): HelperSet
    {
        return new HelperSet(
            [
                'db' => new DBALConsole\Helper\ConnectionHelper($entityManager->getConnection()),
                'em' => new EntityManagerHelper($entityManager),
            ]
        );
    }

    /**
     * Runs console with the given helper set.
     *
     * @param HelperSet|EntityManagerProvider $helperSetOrProvider
     * @param SymfonyCommand[]                $commands
     */
    public static function run($helperSetOrProvider, array $commands = []): void
    {
        $cli = self::createApplication($helperSetOrProvider, $commands);
        $cli->run();
    }

    /**
     * Creates a console application with the given helperset and
     * optional commands.
     *
     * @param HelperSet|EntityManagerProvider $helperSetOrProvider
     * @param SymfonyCommand[]                $commands
     *
     * @throws OutOfBoundsException
     */
    public static function createApplication($helperSetOrProvider, array $commands = []): Application
    {
        $cli = new Application('Doctrine Command Line Interface', Versions::getVersion('doctrine/orm'));
        $cli->setCatchExceptions(true);

        if ($helperSetOrProvider instanceof HelperSet) {
            $cli->setHelperSet($helperSetOrProvider);

            $helperSetOrProvider = new HelperSetManagerProvider($helperSetOrProvider);
        }

        self::addCommands($cli, $helperSetOrProvider);
        $cli->addCommands($commands);

        return $cli;
    }

    public static function addCommands(Application $cli, ?EntityManagerProvider $entityManagerProvider = null): void
    {
        if ($entityManagerProvider === null) {
            $entityManagerProvider = new HelperSetManagerProvider($cli->getHelperSet());
        }

        $connectionProvider = new ConnectionFromManagerProvider($entityManagerProvider);

        $cli->addCommands(
            [
                // DBAL Commands
                new DBALConsole\Command\ImportCommand(),
                new DBALConsole\Command\ReservedWordsCommand($connectionProvider),
                new DBALConsole\Command\RunSqlCommand($connectionProvider),

                // ORM Commands
                new Command\ClearCache\CollectionRegionCommand($entityManagerProvider),
                new Command\ClearCache\EntityRegionCommand($entityManagerProvider),
                new Command\ClearCache\MetadataCommand($entityManagerProvider),
                new Command\ClearCache\QueryCommand($entityManagerProvider),
                new Command\ClearCache\QueryRegionCommand($entityManagerProvider),
                new Command\ClearCache\ResultCommand($entityManagerProvider),
                new Command\SchemaTool\CreateCommand($entityManagerProvider),
                new Command\SchemaTool\UpdateCommand($entityManagerProvider),
                new Command\SchemaTool\DropCommand($entityManagerProvider),
                new Command\EnsureProductionSettingsCommand($entityManagerProvider),
                new Command\ConvertDoctrine1SchemaCommand(),
                new Command\GenerateRepositoriesCommand($entityManagerProvider),
                new Command\GenerateEntitiesCommand($entityManagerProvider),
                new Command\GenerateProxiesCommand($entityManagerProvider),
                new Command\ConvertMappingCommand($entityManagerProvider),
                new Command\RunDqlCommand($entityManagerProvider),
                new Command\ValidateSchemaCommand($entityManagerProvider),
                new Command\InfoCommand($entityManagerProvider),
                new Command\MappingDescribeCommand($entityManagerProvider),
            ]
        );
    }

    public static function printCliConfigTemplate(): void
    {
        echo <<<'HELP'
You are missing a "cli-conf.php" or "conf/cli-conf.php" file in your
project, which is required to get the Doctrine Console working. You can use the
following sample as a template:

<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;

// replace with file to your own project bootstrap
require_once 'bootstrap.php';

// replace with mechanism to retrieve EntityManager in your app
$entityManager = GetEntityManager();

return ConsoleRunner::createHelperSet($entityManager);

HELP;
    }
}
