<?php


namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * Test si l'utilisateur est connecté.
     *
     * @return void
     */
    public function test_user_is_authenticated()
    {
        // Créer un utilisateur
        $user = User::factory()->create();

        // Définir l'utilisateur comme étant actuellement authentifié
        $this->actingAs($user);

        // Vérifier si l'utilisateur est authentifié
        $this->assertTrue(auth()->check());
    }
}
