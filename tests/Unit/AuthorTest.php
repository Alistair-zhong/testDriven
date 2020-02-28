<?php

namespace Tests\Unit;

use App\Models\Author;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorTest extends TestCase
{
    use RefreshDatabase;

   /**
   *@test
   */
   public function a_author_can_be_created_only_name(){

        Author::firstOrCreate([
            'name'  =>  'Hony',

        ]);


        $this->assertCount(1,Author::all());
   }
}
