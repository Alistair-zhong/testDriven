<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Author;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorManagementTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function a_author_can_be_added(){
        $this->withoutExceptionHandling();

        // 发送一个作者的信息
        $response = $this->post('/authors',[
            'name'  => 'jhonson',
            'birth'   => '1997-12-04'
        ]);

        // 数据库中会生成一条记录
        $authors = Author::all();
        $this->assertCount(1,$authors);
        $this->assertInstanceOf(Carbon::class,$authors->first()->birth);

        // 状态码会返回200
        $response->assertOk();
        $this->assertEquals('1997/12/04',$authors->first()->birth->format('Y/m/d'));
    }

}
