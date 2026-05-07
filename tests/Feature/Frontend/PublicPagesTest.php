<?php

namespace Tests\Feature\Frontend;

use App\Models\Post;
use App\Models\Page;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->category = Category::factory()->create();
        $this->post = Post::factory()->create([
            'status' => 'published',
            'published_at' => now(),
        ]);
        $this->page = Page::factory()->create([
            'is_published' => true,
        ]);
    }

    public function test_homepage_loads(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Gobernación');
    }

    public function test_blog_page_loads(): void
    {
        $response = $this->get('/blog');
        $response->assertStatus(200);
    }

    public function test_post_page_loads(): void
    {
        $response = $this->get("/blog/{$this->post->slug}");
        $response->assertStatus(200);
        $response->assertSee($this->post->title);
    }

    public function test_post_returns_404_for_non_existent_slug(): void
    {
        $response = $this->get('/blog/this-post-does-not-exist');
        $response->assertStatus(404);
    }

    public function test_contact_page_loads(): void
    {
        $response = $this->get('/contacto');
        $response->assertStatus(200);
    }

    public function test_search_page_loads(): void
    {
        $response = $this->get('/buscar?q=test');
        $response->assertStatus(200);
    }

    public function test_dynamic_page_loads(): void
    {
        $response = $this->get("/{$this->page->slug}");
        $response->assertStatus(200);
        $response->assertSee($this->page->title);
    }

    public function test_sitemap_returns_valid_xml(): void
    {
        $response = $this->get('/sitemap.xml');
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/xml; charset=utf-8');
    }
}