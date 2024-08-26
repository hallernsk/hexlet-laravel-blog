<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Article test
     *
     * @return void
     */

    public function testIndex()
    {
        $response = $this->get(route('articles.index'));
        $response->assertStatus(200)
                 ->assertViewIs('article.index')
                 ->assertViewHas('articles');
    }

    public function testShow()
    {
        $article = Article::factory()->create();
        $response = $this->get(route('articles.show', $article->id));

        $response->assertStatus(200)
                 ->assertViewIs('article.show')
                 ->assertViewHas('article', $article);

        $response->assertSeeText($article->name);
        $response->assertSeeText($article->body);
    }


    public function testStore()
    {
        $data = [
            'name' => 'test',
            'body' => '1234567891',
        ];

        $response = $this->post(route('articles.store'), $data);

        $response->assertRedirect(route('articles.index'));
        $this->assertDatabaseHas('articles', $data);
    }


    public function testCreate()
    {
        $response = $this->get(route('articles.create'));

        $response->assertStatus(200)
                 ->assertViewIs('article.create');
    }

    public function testEdit()
    {
        $article = Article::factory()->create();

        $response = $this->get(route('articles.edit', $article->id));

        $response->assertStatus(200)
                 ->assertViewIs('article.edit');
    }

    public function testUpdate()
    {
        $article = Article::factory()->create();
        // $data = Article::factory()->make()->only(['name', 'body']);

        $data = [
            'name' => 'Updated Article',
            'body' => 'Updated content',
        ];


        $response = $this->patch(route('articles.update', $article->id), $data);
        // $response = $this->patch('/articles/' . $article->id, $data);    // можно и так

        $response->assertRedirect(route('articles.index'));
        $this->assertDatabaseHas('articles', $data);

        $updatedArticle = Article::first(); // можно еще такие проверки добавить
        $this->assertEquals($updatedArticle->name, $data['name']);
        $this->assertEquals($updatedArticle->body, $data['body']);
    }

    public function testDestroy()
    {
        $article = Article::factory()->create();
        $response = $this->delete(route('articles.destroy', $article->id));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('articles.index'));
        $this->assertDatabaseMissing('articles', ['id' => $article->id]);
    }

}
