<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191014133036 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE dispense ADD medical_treatment_id INT DEFAULT NULL, ADD pet_id INT DEFAULT NULL, ADD veterinary_clinic_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dispense ADD CONSTRAINT FK_2CB2B94762E12809 FOREIGN KEY (medical_treatment_id) REFERENCES medical_treatment (id)');
        $this->addSql('ALTER TABLE dispense ADD CONSTRAINT FK_2CB2B947966F7FB6 FOREIGN KEY (pet_id) REFERENCES pet (id)');
        $this->addSql('ALTER TABLE dispense ADD CONSTRAINT FK_2CB2B94743DA3F0C FOREIGN KEY (veterinary_clinic_id) REFERENCES veterinary_clinic (id)');
        $this->addSql('CREATE INDEX IDX_2CB2B94762E12809 ON dispense (medical_treatment_id)');
        $this->addSql('CREATE INDEX IDX_2CB2B947966F7FB6 ON dispense (pet_id)');
        $this->addSql('CREATE INDEX IDX_2CB2B94743DA3F0C ON dispense (veterinary_clinic_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE dispense DROP FOREIGN KEY FK_2CB2B94762E12809');
        $this->addSql('ALTER TABLE dispense DROP FOREIGN KEY FK_2CB2B947966F7FB6');
        $this->addSql('ALTER TABLE dispense DROP FOREIGN KEY FK_2CB2B94743DA3F0C');
        $this->addSql('DROP INDEX IDX_2CB2B94762E12809 ON dispense');
        $this->addSql('DROP INDEX IDX_2CB2B947966F7FB6 ON dispense');
        $this->addSql('DROP INDEX IDX_2CB2B94743DA3F0C ON dispense');
        $this->addSql('ALTER TABLE dispense DROP medical_treatment_id, DROP pet_id, DROP veterinary_clinic_id');
    }
}
