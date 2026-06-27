<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_homepage_renders_airline_carousel(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Our Trusted Airline Partners');
    }

    public function test_inquiry_can_be_stored_successfully(): void
    {
        $response = $this->post('/inquiry-store', [
            'name' => 'John Doe',
            'phone' => '07700900077',
            'email' => 'john@example.com',
            'city' => 'London',
            'persons' => '3',
            'travel_date' => '2026-07-01',
            'package_type' => 'Premium Umrah Package',
            'message' => 'Please get in touch with me.',
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        
        $this->assertDatabaseHas('inquiries', [
            'name' => 'John Doe',
            'phone' => '07700900077',
            'email' => 'john@example.com',
            'city' => 'London',
            'persons' => '3',
            'travel_date' => '2026-07-01',
        ]);
    }

    public function test_package_detail_page_loads_successfully(): void
    {
        $package = \App\Models\Package::create([
            'title' => 'Test Umrah Package',
            'slug' => 'test-umrah-package',
            'price' => 1200.00,
            'duration' => '10',
            'star_rating' => '5 Star',
            'featured' => true,
        ]);

        $response = $this->get('/package/' . $package->slug);

        $response->assertStatus(200);
    }

    public function test_about_us_page_loads_successfully(): void
    {
        $this->seed(\Database\Seeders\PageSeeder::class);
        $response = $this->get('/about-us');

        $response->assertStatus(200);
    }

    public function test_contact_page_loads_successfully(): void
    {
        $this->seed(\Database\Seeders\PageSeeder::class);
        $response = $this->get('/contact');

        $response->assertStatus(200);
    }

    public function test_category_page_loads_successfully(): void
    {
        $category = \App\Models\Category::create([
            'name' => 'January Umrah Packages',
            'slug' => 'january-umrah-packages',
        ]);

        $response = $this->get('/category/' . $category->slug);

        $response->assertStatus(200);
        $response->assertSee('January Umrah Packages');
    }

    public function test_calendar_month_page_loads_successfully(): void
    {
        $package = \App\Models\Package::create([
            'title' => 'January Test Package',
            'slug' => 'january-test-package',
            'price' => 1500.00,
            'duration' => '12',
            'star_rating' => '4 Star',
            'featured' => true,
        ]);

        \App\Models\UmrahCalendar::create([
            'package_id' => $package->id,
            'month' => 'January',
            'year' => 2026,
            'start_date' => '2026-01-10',
            'end_date' => '2026-01-22',
            'price' => 1499.00,
            'status' => 'Available',
        ]);

        $response = $this->get('/umrah-calendar/january');

        $response->assertStatus(200);
        $response->assertSee('January Umrah Packages');
        $response->assertSee('January Test Package');
    }

    public function test_year_round_package_appears_in_calendar_automatically(): void
    {
        $package = \App\Models\Package::create([
            'title' => 'Year Round Super Package',
            'slug' => 'year-round-super-package',
            'price' => 1800.00,
            'duration' => '14',
            'star_rating' => '5 Star',
            'featured' => true,
            'available_all_year' => true,
        ]);

        $response = $this->get('/umrah-calendar/december');

        $response->assertStatus(200);
        $response->assertSee('December Umrah Packages');
        $response->assertSee('Year Round Super Package');
    }

    public function test_inquiry_conversion_creates_customer(): void
    {
        $inquiry = \App\Models\Inquiry::create([
            'name' => 'Lead conversion test',
            'phone' => '07700900011',
            'email' => 'lead@example.com',
            'city' => 'Manchester',
            'persons' => '2',
            'travel_date' => '2026-09-10',
            'package_type' => 'Standard Star',
            'message' => 'Convert me please.',
        ]);

        $customer = \App\Models\Customer::create([
            'inquiry_id' => $inquiry->id,
            'full_name' => $inquiry->name,
            'email' => $inquiry->email,
            'mobile' => $inquiry->phone,
            'departure_city' => $inquiry->city,
            'travel_date' => $inquiry->travel_date,
            'status' => 'Lead',
            'package_value' => 2000.00,
        ]);

        $this->assertDatabaseHas('customers', [
            'inquiry_id' => $inquiry->id,
            'full_name' => 'Lead conversion test',
            'package_value' => 2000.00,
        ]);
    }

    public function test_payment_updates_customer_balance(): void
    {
        $customer = \App\Models\Customer::create([
            'full_name' => 'Balance Test Customer',
            'email' => 'balance@example.com',
            'package_value' => 3000.00,
            'deposit_amount' => 500.00,
            'remaining_balance' => 3000.00,
        ]);

        $payment = \App\Models\Payment::create([
            'customer_id' => $customer->id,
            'amount' => 1200.00,
            'payment_date' => '2026-06-13',
            'payment_method' => 'Bank Transfer',
        ]);

        // Trigger balance calculations and check
        $customer->refresh();
        $this->assertEquals(1800.00, floatval($customer->remaining_balance));
    }

    public function test_customer_invoice_page_loads_successfully(): void
    {
        $customer = \App\Models\Customer::create([
            'full_name' => 'Invoice Test Customer',
            'email' => 'invoice@example.com',
            'package_value' => 2500.00,
            'deposit_amount' => 500.00,
            'remaining_balance' => 2000.00,
        ]);

        $response = $this->get('/customer/' . $customer->id . '/invoice');

        $response->assertStatus(200);
        $response->assertSee('Invoice Test Customer');
    }

    public function test_customer_atol_page_loads_successfully(): void
    {
        $customer = \App\Models\Customer::create([
            'full_name' => 'ATOL Test Customer',
            'email' => 'atol@example.com',
            'package_value' => 2500.00,
            'deposit_amount' => 500.00,
            'remaining_balance' => 2000.00,
        ]);

        $atol = \App\Models\AtolCompliance::create([
            'customer_id' => $customer->id,
            'atol_certificate_number' => 'ATOL-998877',
            'protection_date' => '2026-06-13',
            'terms_accepted' => true,
        ]);

        $response = $this->get('/customer/' . $customer->id . '/atol');

        $response->assertStatus(200);
        $response->assertSee('ATOL Test Customer');
        $response->assertSee('ATOL CERTIFICATE');
        $response->assertSee('ATOL-998877');
    }

    public function test_new_inquiry_assigned_to_support_staff(): void
    {
        $staff = \App\Models\User::create([
            'name' => 'Support Agent Jane',
            'email' => 'jane@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'Support Staff',
        ]);

        $response = $this->post('/inquiry-store', [
            'name' => 'Test Inquirer',
            'phone' => '07712345678',
            'email' => 'inquirer@example.com',
            'message' => 'Need help',
        ]);

        $this->assertDatabaseHas('inquiries', [
            'name' => 'Test Inquirer',
            'assigned_to' => $staff->id,
        ]);
    }

    public function test_chatbot_widget_renders_on_homepage(): void
    {
        $response = $this->get('/');
        $response->assertSee('id="mg-chat-widget"', false);
        $response->assertSee('Makkah Gateway Support');
    }

    public function test_terms_page_loads_successfully(): void
    {
        $response = $this->get('/terms-and-conditions');
        $response->assertStatus(200);
        $response->assertSee('Terms & Conditions', false);
        $response->assertSee('Hajj & Umrah Booking Terms', false);
    }

    public function test_disclaimer_page_loads_successfully(): void
    {
        $response = $this->get('/disclaimer');
        $response->assertStatus(200);
        $response->assertSee('Disclaimer', false);
        $response->assertSee('Scope of Responsibility', false);
    }
}
