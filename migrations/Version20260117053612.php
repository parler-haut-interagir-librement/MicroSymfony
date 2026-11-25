<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Schema\Index;
use Doctrine\DBAL\Schema\Index\IndexType;
use Doctrine\DBAL\Schema\PrimaryKeyConstraint;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;
use Override;

/**
 * The user table, described through the schema API and written in the SQL of the platform the migration runs on, so
 * that the same migration creates it on SQLite, PostgreSQL and MySQL.
 *
 * @see https://symfony.com/bundles/DoctrineMigrationsBundle/current/index.html#generating-migrations-automatically
 */
final class Version20260117053612 extends AbstractMigration
{
    private const string TABLE = 'user';

    #[Override]
    public function getDescription(): string
    {
        return 'Initial migration';
    }

    public function up(Schema $schema): void
    {
        $table = Table::editor()
            ->setQuotedName(self::TABLE)
            ->setColumns(
                Column::editor()->setUnquotedName('id')->setTypeName(Types::INTEGER)->setAutoincrement(true)->create(),
                Column::editor()->setUnquotedName('email')->setTypeName(Types::STRING)->setLength(255)->create(),
                Column::editor()->setUnquotedName('password')->setTypeName(Types::STRING)->setLength(255)->create(),
                Column::editor()->setUnquotedName('username')->setTypeName(Types::STRING)->setLength(255)->create(),
                Column::editor()->setUnquotedName('created_at')->setTypeName(Types::DATETIME_IMMUTABLE)->create(),
                Column::editor()->setUnquotedName('updated_at')->setTypeName(Types::DATETIME_IMMUTABLE)->create(),
            )
            ->setPrimaryKeyConstraint(PrimaryKeyConstraint::editor()->setUnquotedColumnNames('id')->create())
            ->setIndexes(
                Index::editor()->setUnquotedName('UNIQ_8D93D649E7927C74')->setType(IndexType::UNIQUE)->setUnquotedColumnNames('email')->create(),
                Index::editor()->setUnquotedName('UNIQ_8D93D649F85E0677')->setType(IndexType::UNIQUE)->setUnquotedColumnNames('username')->create(),
            )
            ->create();

        foreach ($this->platform->getCreateTableSQL($table) as $sql) {
            $this->addSql($sql);
        }
    }

    #[Override]
    public function down(Schema $schema): void
    {
        $this->addSql($this->platform->getDropTableSQL($this->platform->quoteSingleIdentifier(self::TABLE)));
    }
}
