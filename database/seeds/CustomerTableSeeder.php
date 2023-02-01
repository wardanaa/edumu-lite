<?php


use App\Models\Customer;

class CustomerTableSeeder extends \Illuminate\Database\Seeder {
    use DisableForeignKeys, TruncateTable;

    public function run() {
        $this->disableForeignKeys();

        $this->truncateMultiple([
            'customer',
        ]);

        Customer::create([
            'username' => 'kontributor1',
            'password' => 'kontributor1',
            'name' => 'Kontributor 1',
            'no_reg' => '123456789',
            'position' => 'Guru',
            'company' => 'SMA 1 Hantu',
        ]);
        Customer::create([
            'username' => 'kontributor2',
            'password' => 'kontributor2',
            'name' => 'Kontributor 2',
            'no_reg' => '1234567891',
            'position' => 'Guru',
            'company' => 'SMA 1 Hantu',
        ]);

        $this->enableForeignKeys();
    }
}