<?php

use App\Models\Admin;
use App\Models\PageAbout;
use App\Models\PageAuth;
use App\Models\PageContact;
use App\Models\PageHome;
use App\Models\PagePrivacy;
use App\Models\PageRefund;
use App\Models\PageTnc;
use App\Models\Slider1;

beforeEach(function () {
    $this->admin = Admin::unguarded(function () {
        return Admin::create([
            'name' => 'Admin User',
            'email' => 'admin.pages@example.com',
            'phone' => '9000000701',
            'password' => 'password',
        ]);
    });

    PageAuth::unguarded(function () {
        PageAuth::create(['id' => 1]);
    });

    PageHome::unguarded(function () {
        PageHome::create(['id' => 1]);
    });

    PageAbout::unguarded(function () {
        PageAbout::create(['id' => 1]);
    });

    PageContact::unguarded(function () {
        PageContact::create(['id' => 1]);
    });

    PageTnc::unguarded(function () {
        PageTnc::create(['id' => 1]);
    });

    PagePrivacy::unguarded(function () {
        PagePrivacy::create(['id' => 1]);
    });

    PageRefund::unguarded(function () {
        PageRefund::create(['id' => 1]);
    });

    Slider1::unguarded(function () {
        Slider1::create([
            'heading1' => 'Hero',
            'is_active' => true,
        ]);
    });
});

test('admin can view page edit screens', function () {
    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.pages.authPage'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.pages.homePage'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.pages.aboutPage'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.pages.contactPage'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.pages.tncPage'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.pages.privacyPage'))
        ->assertOk();

    $this->actingAs($this->admin, 'admin')
        ->get(route('admin.pages.refundPage'))
        ->assertOk();
});

test('admin can update auth and home pages', function () {
    $this->actingAs($this->admin, 'admin')
        ->patch(route('admin.pages.updateAuthPage'), [])
        ->assertRedirect(route('admin.dashboard'));

    $this->actingAs($this->admin, 'admin')
        ->patch(route('admin.pages.updateHomePage'), [
            'banner_heading' => 'Banner',
            'banner_description' => 'Description',
        ])
        ->assertRedirect(route('admin.dashboard'));
});

test('admin can update about and contact pages', function () {
    $this->actingAs($this->admin, 'admin')
        ->patch(route('admin.pages.updateAboutPage'), [
            'para1' => 'About text',
        ])
        ->assertRedirect(route('admin.dashboard'));

    $this->actingAs($this->admin, 'admin')
        ->from(route('admin.pages.contactPage'))
        ->patch(route('admin.pages.updateContactPage'), [
            'form_heading1' => 'Contact',
            'form_paragraph1' => 'Contact paragraph',
            'map_embad_url' => 'https://example.com/map',
            'working_hour' => 'Mon-Fri 9-5',
        ])
        ->assertRedirect(route('admin.pages.contactPage'));
});

test('admin can update tnc, privacy, and refund pages', function () {
    $this->actingAs($this->admin, 'admin')
        ->from(route('admin.pages.tncPage'))
        ->patch(route('admin.pages.updateTncPage'), [
            'title' => 'Terms',
            'content' => 'Terms content',
        ])
        ->assertRedirect(route('admin.pages.tncPage'));

    $this->actingAs($this->admin, 'admin')
        ->from(route('admin.pages.privacyPage'))
        ->patch(route('admin.pages.updatePrivacyPage'), [
            'title' => 'Privacy',
            'content' => 'Privacy content',
        ])
        ->assertRedirect(route('admin.pages.privacyPage'));

    $this->actingAs($this->admin, 'admin')
        ->from(route('admin.pages.refundPage'))
        ->patch(route('admin.pages.updateRefundPage'), [
            'title' => 'Refund',
            'content' => 'Refund content',
        ])
        ->assertRedirect(route('admin.pages.refundPage'));
});
