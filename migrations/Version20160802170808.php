<?php

namespace ZendDbMigrations\Migrations;

use ZendDbMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160802170808 extends AbstractMigration {
    
    public function up(MetadataInterface $schema){
        $this->addSql("CREATE TABLE public.product
(
  id  NOT NULL,
  name text NOT NULL,
  description text,
  CONSTRAINT product_pkey PRIMARY KEY (id)
)");
    }
    
    public function down(MetadataInterface $schema){
        $this->addSql('DROP TABLE public.product');
    }
}