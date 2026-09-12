<?php

namespace Tests\Feature;

use App\Models\Account;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class FrameworkUpgradeTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_pages_render_the_expected_inertia_components(): void
    {
        foreach (['/' => 'Home', '/about' => 'About', '/login' => 'Login', '/register' => 'Register', '/events' => 'Events', '/facilities' => 'Facilities', '/forgotpassword' => 'PasswordForgot'] as $url => $component) {
            $this->get($url)->assertOk()->assertInertia(fn (Assert $page) => $page->component($component));
        }
    }

    public function test_guest_access_requires_authentication(): void
    {
        $this->get('/account')->assertRedirect('/login');
        $this->getJson('/api/account')->assertUnauthorized();
    }

    public function test_login_rehashes_the_custom_password_column_and_logout_ends_the_session(): void
    {
        $account = $this->account();
        config(['hashing.bcrypt.rounds' => 5]);

        $this->postJson('/login', ['email' => $account->EMAIL, 'password' => 'TestingPassword123', 'remember' => false])->assertOk();
        $this->assertAuthenticatedAs($account);
        $this->assertFalse(Hash::needsRehash($account->fresh()->PASSWORD));
        $this->assertNull($account->fresh()->REMEMBER_TOKEN);
        $this->get('/account')->assertOk()->assertInertia(fn (Assert $page) => $page->component('Account')->where('auth.user.EMAIL', $account->EMAIL)->missing('auth.user.PASSWORD'));
        $this->postJson('/logout')->assertOk();
        $this->assertGuest();
    }

    public function test_api_tokens_authenticate_with_sanctum(): void
    {
        $account = $this->account();
        $token = $this->postJson('/api/login', ['email' => $account->EMAIL, 'password' => 'TestingPassword123'])->assertOk()->json('token');
        auth()->forgetGuards();
        $this->withToken($token)->getJson('/api/account')->assertOk()->assertJsonPath('EMAIL', $account->EMAIL)->assertJsonMissingPath('PASSWORD');
    }

    public function test_registration_and_email_verification_use_the_custom_account_fields(): void
    {
        Notification::fake();
        $this->postJson('/register', ['name' => 'New account', 'email' => 'new@example.test', 'password' => 'TestingPassword123', 'password_confirmation' => 'TestingPassword123', 'terms' => true])->assertOk();
        $account = Account::where('EMAIL', 'new@example.test')->firstOrFail();
        $this->assertTrue(Hash::check('TestingPassword123', $account->PASSWORD));
        $this->assertFalse($account->hasVerifiedEmail());
        $account->markEmailAsVerified();
        $this->assertTrue($account->fresh()->hasVerifiedEmail());
        $account->markEmailAsUnverified();
        $this->assertFalse($account->fresh()->hasVerifiedEmail());
        Notification::assertSentTo($account, \App\Notifications\VerifyEmailNotification::class);
    }

    public function test_editing_an_event_preserves_its_existing_category(): void
    {
        $account = $this->account();
        $account->markEmailAsVerified();
        $facilityBookmark = \App\Models\Bookmark::create();
        $facility = \App\Models\Facility::create([
            'FACILITY_ID' => $facilityBookmark->BOOKMARK_ID,
            'NAME' => 'Test school', 'DESCRIPTION' => 'School description',
            'WEBSITE_URL' => 'https://example.test', 'PHONE_NR' => '123456',
            'EMAIL' => 'school@example.test', 'POSTAL_CODE' => '3500',
            'CITY' => 'Krems', 'ADDRESS' => 'School Street',
            'FACILITY_TYPE' => 'Schule', 'IMAGE_PATH' => 'placeholder.webp',
        ]);
        $bookmark = \App\Models\Bookmark::create();
        $event = \App\Models\Event::create([
            'EVENT_ID' => $bookmark->BOOKMARK_ID, 'ACCOUNT_ID' => $account->ACCOUNT_ID,
            'FACILITY_ID' => $facility->FACILITY_ID, 'TITLE' => 'Test workshop',
            'DESCRIPTION' => 'A test workshop description', 'EVENT_TYPE' => 'Bildung',
            'STARTING_TIME' => '2026-10-01 18:00:00', 'POSTAL_CODE' => '3500',
            'CITY' => 'Krems', 'ADDRESS' => 'School Street', 'IMAGE_PATH' => 'placeholder.webp',
        ]);
        $this->actingAs($account)->postJson('/events/'.$event->EVENT_ID, [
            'TITLE' => 'Updated workshop', 'DESCRIPTION' => $event->DESCRIPTION,
            'STARTING_TIME' => '2026-10-01T18:00', 'POSTAL_CODE' => '3500',
            'CITY' => 'Krems', 'ADDRESS' => 'School Street',
        ])->assertOk();
        $this->assertSame('Bildung', $event->fresh()->EVENT_TYPE);
        $this->assertSame('Updated workshop', $event->fresh()->TITLE);
    }

    public function test_dashboard_pages_render_for_a_verified_administrator(): void
    {
        $account = $this->account();
        $account->markEmailAsVerified();
        $account->update(['ACCOUNT_TYPE' => 'Systemverwalter']);
        $this->actingAs($account);
        foreach (['' => 'Dashboard', '/accounts' => 'Dashboard/Accounts', '/events' => 'Dashboard/Events', '/facilities' => 'Dashboard/Facilities', '/requests' => 'Dashboard/Requests'] as $path => $component) {
            $this->get('/dashboard'.$path)->assertOk()->assertInertia(fn (Assert $page) => $page->component($component));
        }
    }

    private function account(): Account
    {
        return Account::create(['name' => 'Test account', 'email' => 'test@example.test', 'password' => Hash::make('TestingPassword123')]);
    }
}
