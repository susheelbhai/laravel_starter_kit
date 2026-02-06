<?php

use App\Models\Admin;
use App\Models\Faq;
use App\Models\FaqCategory;

beforeEach(function () {
    $this->admin = Admin::unguarded(function () {
        return Admin::create([
            'name' => 'Admin User',
            'email' => 'admin.faq@example.com',
            'password' => 'password',
        ]);
    });

    $this->faqCategoryId = FaqCategory::query()->insertGetId([
        'title' => 'FAQ Category',
        'is_active' => true,
    ]);
});

test('admin can view faq pages', function () {
    $faq = Faq::unguarded(function () {
        return Faq::create([
            'faq_category_id' => $this->faqCategoryId,
            'question' => 'Question',
            'answer' => 'Answer',
            'is_active' => true,
        ]);
    });

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.faq.index'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.faq.create'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.faq.show', $faq->id))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.faq.edit', $faq->id))
        ->assertOk();
});

test('admin can create an faq', function () {
    $payload = [
        'faq_category_id' => $this->faqCategoryId,
        'question' => 'New Question',
        'answer' => 'New Answer',
        'is_active' => 1,
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->post(route('admin.faq.store'), $payload);

    $response->assertRedirect(route('admin.faq.index'));

    $this->assertDatabaseHas('faqs', [
        'question' => 'New Question',
    ]);
});

test('admin can update an faq', function () {
    $faq = Faq::unguarded(function () {
        return Faq::create([
            'faq_category_id' => $this->faqCategoryId,
            'question' => 'Old Question',
            'answer' => 'Old Answer',
            'is_active' => true,
        ]);
    });

    $payload = [
        'faq_category_id' => $this->faqCategoryId,
        'question' => 'Updated Question',
        'answer' => 'Updated Answer',
        'is_active' => 1,
    ];

    $response = $this->actingAs($this->admin, 'admin')
        ->put(route('admin.faq.update', $faq->id), $payload);

    $response->assertRedirect(route('admin.faq.index'));

    $this->assertDatabaseHas('faqs', [
        'id' => $faq->id,
        'question' => 'Updated Question',
    ]);
});
