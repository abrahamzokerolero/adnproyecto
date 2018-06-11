<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        
        factory(App\User::class, 50)->create();
        factory(App\Categoria::class, 15)->create()->each(function(App\Categoria $categoria){
            factory(App\Etiqueta::class, 20)->create([
                'categoria_id' => $categoria->id,
            ]);
        });
        
        
        /*factory(App\User::class, 50)->create()->each(function(App\User $user){
            factory(App\Messages::class, 20)->create([
                'user_id' => $user->id,
            ]);
        });*/
    }
}
