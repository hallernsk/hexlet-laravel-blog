<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test index method.
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

    /**
     * Test create method.
     *
     * @return void
     */
    public function testCreate()
    {
        $response = $this->get(route('articles.create'));

        $response->assertStatus(200)
                 ->assertViewIs('article.create');
    }

    /**
     * Test store method.
     *
     * @return void
     */
    public function testStore()
    {
        $data = [
            'name' => 'Test Article',
            'body' => 'Lorem ipsum dolor sit amet',
        ];

        $response = $this->post(route('articles.store'), $data);

        $response->assertRedirect(route('articles.index'));
        $this->assertDatabaseHas('articles', $data);
    }

    /**
     * Test show method.
     *
     * @return void
     */
    public function testShow()
    {
        $article = Article::factory()->create();

        $response = $this->get(route('articles.show', $article->id));

        $response->assertStatus(200)
                 ->assertViewIs('article.show')
                 ->assertViewHas('article', $article);
    }

    /**
     * Test edit method.
     *
     * @return void
     */
    public function testEdit()
    {
        $article = Article::factory()->create();

        $response = $this->get(route('articles.edit', $article->id));

        $response->assertStatus(200)
                 ->assertViewIs('article.edit')
                 ->assertViewHas('article', $article);
    }

    /**
     * Test update method.
     *
     * @return void
     */
    public function testUpdate()
    {
        $article = Article::factory()->create();

        $data = [
            'name' => 'Updated Article',
            'body' => 'Updated content',
        ];

        $response = $this->put(route('articles.update', $article->id), $data);

        $response->assertRedirect(route('articles.index'));
        $this->assertDatabaseHas('articles', $data);
    }

    /**
     * Test destroy method.
     *
     * @return void
     */
    public function testDestroy()
    {
        $article = Article::factory()->create();

        $response = $this->delete(route('articles.destroy', $article->id));

        $response->assertRedirect(route('articles.index'));
        $this->assertDeleted($article);
    }
}
