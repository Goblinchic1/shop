<?php

namespace Tests\Feature\Auth\DTOs;

use App\Http\Requests\SignInFormRequest;
use Domain\Auth\DTOs\NewUserDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewUserDTOTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_instance_created_from_form_request(): void
    {
        $dto = NewUserDTO::fromRequest(new SignInFormRequest([
            'name' => 'test',
            'email' => 'test@mail.ru',
            'password' => '12345678'
        ]));

        $this->assertInstanceOf(NewUserDTO::class, $dto);
    }
}
