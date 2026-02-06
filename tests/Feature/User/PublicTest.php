<?php

use App\Events\ContactFormSubmitted;
use App\Events\ProductEnquirySubmitted;
use App\Models\Blog;
use App\Models\Faq;
use App\Models\FaqCategory;
use App\Models\PageAbout;
use App\Models\PageContact;
use App\Models\PageHome;
use App\Models\PagePrivacy;
use App\Models\PageRefund;
use App\Models\PageTnc;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Service;
use App\Models\User;
use App\Models\UserQueryStatus;
use Illuminate\Support\Facades\Event;

beforeEach(function () {
    PageHome::unguarded(function () {
        PageHome::create(['id' => 1]);
    });

    PageAbout::unguarded(function () {
        PageAbout::create([]);
    });

    PageContact::unguarded(function () {
        PageContact::create(['id' => 1]);
    });

    PagePrivacy::unguarded(function () {
        PagePrivacy::create(['id' => 1]);
    });

    PageTnc::unguarded(function () {
        PageTnc::create(['id' => 1]);
    });

    PageRefund::unguarded(function () {
        PageRefund::create(['id' => 1]);
    });

    $this->service = Service::unguarded(function () {
        return Service::create([
            'title' => 'Test Service',
            'slug' => 'test-service',
            'is_active' => true,
        ]);
    });

    $this->productCategory = ProductCategory::unguarded(function () {
        return ProductCategory::create([
            'title' => 'Test Category',
            'slug' => 'test-category',
            'is_active' => true,
        ]);
    });

    $this->product = Product::unguarded(function () {
        return Product::create([
            'product_category_id' => $this->productCategory->id,
            'title' => 'Test Product',
            'slug' => 'test-product',
            'is_active' => true,
        ]);
    });

    $this->blog = Blog::unguarded(function () {
        return Blog::create([
            'title' => 'Test Blog',
            'slug' => 'test-blog',
            'is_active' => true,
        ]);
    });

    $this->faqCategoryId = FaqCategory::query()->insertGetId([
        'title' => 'Test Category',
        'is_active' => true,
    ]);

    Faq::unguarded(function () {
        Faq::create([
            'faq_category_id' => $this->faqCategoryId,
            'question' => 'Test question',
            'answer' => 'Test answer',
            'is_active' => true,
        ]);
    });

    UserQueryStatus::query()->insert([
        'id' => 1,
        'name' => 'New',
    ]);
});

test('public pages are reachable', function (string $method, string $route, ?string $parameterKey) {
    $parameters = [];

    if ($parameterKey === 'blog') {
        $parameters = [$this->blog->slug];
    }

    if ($parameterKey === 'productCategory') {
        $parameters = [$this->productCategory->slug];
    }

    if ($parameterKey === 'product') {
        $parameters = [$this->product->slug];
    }

    if ($parameterKey === 'service') {
        $parameters = [$this->service->slug];
    }

    $url = str_starts_with($route, '/')
        ? $route
        : route($route, $parameters, false);

    $response = $this->call($method, $url);

    $response->assertOk();
})->with('userPublicGetRoutes');

test('public forms can be submitted', function (string $method, string $route, ?string $payloadKey) {
    Event::fake([
        ContactFormSubmitted::class,
        ProductEnquirySubmitted::class,
    ]);

    $payload = match ($payloadKey) {
        'blogComment' => [
            'name' => 'Test User',
            'email' => 'test.user@example.com',
            'phone' => '1234567890',
            'comment' => 'Nice post',
        ],
        'productEnquiry' => [
            'name' => 'Test User',
            'email' => 'test.user@example.com',
            'phone' => '1234567890',
            'message' => 'Interested',
            'product_id' => $this->product->id,
        ],
        'contact' => [
            'name' => 'Test User',
            'email' => 'test.user@example.com',
            'phone' => '1234567890',
            'subject' => 'Question',
            'message' => 'Hello',
        ],
        'newsletter' => [
            'email' => 'test.user@example.com',
        ],
        default => [],
    };

    if ($route === 'blog.comment') {
        $url = route($route, $this->blog->id, false);
        $user = User::factory()->create();
        $this->actingAs($user);
    } else {
        $url = str_starts_with($route, '/')
            ? $route
            : route($route, [], false);
    }

    $response = $this->call($method, $url, $payload);

    $response->assertStatus(302);
    $response->assertSessionHasNoErrors();
})->with('userPublicPostRoutes');

dataset('userPublicGetRoutes', [
    ['GET', '/', null],
    ['GET', 'about', null],
    ['GET', 'blog.index', null],
    ['GET', 'blog.show', 'blog'],
    ['GET', 'productCategory.show', 'productCategory'],
    ['GET', 'product.index', null],
    ['GET', 'product.show', 'product'],
    ['GET', 'services', null],
    ['GET', 'serviceDetail', 'service'],
    ['GET', 'contact', null],
    ['GET', 'privacy', null],
    ['GET', 'tnc', null],
    ['GET', 'refund', null],
    ['GET', 'faq', null],
]);

dataset('userPublicPostRoutes', [
    ['POST', 'blog.comment', 'blogComment'],
    ['POST', 'product.enquiry', 'productEnquiry'],
    ['POST', '/contact', 'contact'],
    ['POST', 'newsletter', 'newsletter'],
]);
