<?php

use yii\db\Migration;
use Faker\Factory;
use Faker\Generator;
use yii\db\Query;

class m250803_013448_add_data extends Migration
{
    private Generator $faker;
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->faker = Factory::create();
        $this->createCountries();
        $this->createCities();
        $this->createServices();
        $this->createBanks();
        $this->createBanksServices();
        $this->createBanksCities();
    }

    private function createCountries()
    {
        $this->createTable('countries', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
        for ($i = 0; $i < 5; $i++) {
            $this->insert('countries', ['name' => $this->faker->country()]);
        }
    }

    private function createCities()
    {
        $this->createTable('cities', [
            'id' => $this->primaryKey(),
            'country_id' => $this->integer()->notNull(),
            'city' => $this->string()->notNull(),
        ]);
        $this->addForeignKey(
            'cities__country_id',
            'cities',
            'country_id',
            'countries',
            'id'
        );
        $countryIds = (new Query())->select('id')->from('countries')->column();
        foreach ($countryIds as $countryId) {
            for ($i = 0; $i < 3; $i++) {
                $this->insert('cities', ['city' => $this->faker->city(), 'country_id' => $countryId]);
            }
        }
    }

    private function createBanks()
    {
        $this->createTable('banks', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'full_description' => $this->text()->notNull(),
            'short_description' => $this->string()->notNull(),
            'is_active' => $this->boolean()->notNull()->defaultValue(1),
        ]);
        for ($i = 0; $i < 23; $i++) {
            $this->insert('banks', [
                'name' => $this->faker->company(),
                'full_description' => $this->faker->text(300),
                'short_description' => $this->faker->text(50),
            ]);
        }
    }

    private function createServices()
    {
        $this->createTable('services', [
            'id' => $this->primaryKey(),
            'service' => $this->string()->notNull(),
        ]);
        for ($i = 0; $i < 15; $i++) {
            $this->insert('services', ['service' => $this->faker->text(50)]);
        }
    }

    private function createBanksServices()
    {
        $this->createTable('banks_services', [
            'bank_id' => $this->integer()->notNull(),
            'service_id' => $this->integer()->notNull(),
        ]);
        $this->addPrimaryKey('banks_services', 'banks_services', ['bank_id', 'service_id']);
        $this->addForeignKey(
            'fk-banks_services__bank_id',
            'banks_services',
            'bank_id',
            'banks',
            'id'
        );
        $this->addForeignKey(
            'fk-banks_services__service_id',
            'banks_services',
            'service_id',
            'services',
            'id'
        );
        $bankIds = (new Query())->select('id')->from('banks')->column();
        $serviceIds = (new Query())->select('id')->from('services')->column();
        foreach ($bankIds as $bankId) {
            for ($i = 0; $i < count($bankIds); $i++) {
                $serviceKey = rand(0, count($serviceIds) - 1);
                try {
                    $this->insert('banks_services', ['bank_id' => $bankId, 'service_id' => $serviceIds[$serviceKey]]);
                } catch (Exception $e) {
                    continue;
                }
            }
        }
    }

    private function createBanksCities()
    {
        $this->createTable('banks_cities', [
            'bank_id' => $this->integer()->notNull(),
            'city_id' => $this->integer()->notNull(),
        ]);
        $this->addPrimaryKey('banks_cities', 'banks_cities', ['bank_id', 'city_id']);
        $this->addForeignKey(
            'fk-banks_cities_bank__bank_id',
            'banks_cities',
            'bank_id',
            'banks',
            'id'
        );
        $this->addForeignKey(
            'fk-banks_cities_city__city_id',
            'banks_cities',
            'city_id',
            'cities',
            'id'
        );
        $bankIds = (new Query())->select('id')->from('banks')->column();
        $countryIds = (new Query())->select('id')->from('countries')->column();
        foreach ($bankIds as $bankId) {
            for ($i = 0; $i < count($bankIds); $i++) {
                $countryKey = rand(0, count($countryIds) - 1);
                $cityIds = (new Query())
                    ->select('id')
                    ->from('cities')
                    ->where(['country_id' => $countryKey])
                    ->column();
                try {
                    foreach ($cityIds as $cityId) {
                        $this->insert('banks_cities', ['bank_id' => $bankId, 'city_id' => $cityId]);
                    }
                } catch (Exception $e) {
                    continue;
                }
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250803_013448_add_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250803_013448_add_data cannot be reverted.\n";

        return false;
    }
    */
}
