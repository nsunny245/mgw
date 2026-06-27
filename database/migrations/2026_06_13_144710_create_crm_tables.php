<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Extend Users and Inquiries tables
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('Sales Agent')->after('password');
        });

        Schema::table('inquiries', function (Blueprint $table) {
            $table->string('status')->default('New Inquiry')->after('travel_date');
            $table->foreignId('assigned_to')->nullable()->after('status')->constrained('users')->nullOnDelete();
        });

        // 2. Suppliers Table
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type'); // Hotel, Airline, Transport, Visa Partner
            $table->text('contact_details')->nullable();
            $table->string('contract_file')->nullable();
            $table->timestamps();
        });

        // 3. Customers Table
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inquiry_id')->nullable()->constrained('inquiries')->nullOnDelete();
            $table->string('full_name');
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('nationality')->nullable();
            $table->text('address')->nullable();
            $table->date('date_birth')->nullable();
            
            $table->foreignId('package_id')->nullable()->constrained('packages')->nullOnDelete();
            $table->string('departure_city')->nullable();
            $table->date('travel_date')->nullable();
            $table->date('return_date')->nullable();

            $table->foreignId('agent_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('lead_source')->default('Organic');
            $table->string('status')->default('Lead'); // Lead, Active Booking, Travel Completed, Archived
            $table->decimal('package_value', 10, 2)->default(0.00);
            $table->decimal('deposit_amount', 10, 2)->default(0.00);
            $table->decimal('remaining_balance', 10, 2)->default(0.00);
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // 4. Timeline Events Table
        Schema::create('timeline_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete(); // Actor
            $table->string('event_type'); // Status Change, Document Uploaded, etc.
            $table->text('description');
            $table->json('metadata')->nullable();
            $table->timestamps();
        });

        // 5. Documents Table
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->string('type'); // Passport, Photograph, Visa Forms, Flight Documents, etc.
            $table->string('file_path');
            $table->text('notes')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('status')->default('Uploaded'); // Uploaded, Verified, Expired
            $table->timestamps();
        });

        // 6. Digital Signatures Table
        Schema::create('digital_signatures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->string('document_name');
            $table->string('file_path')->nullable();
            $table->string('status')->default('Draft'); // Draft, Sent, Viewed, Signed, Expired
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('viewed_at')->nullable();
            $table->timestamp('signed_at')->nullable();
            $table->timestamps();
        });

        // 7. Visa Cases Table
        Schema::create('visa_cases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->string('visa_type'); // Umrah Visa, Hajj Visa, etc.
            $table->string('application_number')->nullable();
            $table->date('submission_date')->nullable();
            $table->date('appointment_date')->nullable();
            $table->string('embassy')->nullable();
            $table->foreignId('officer_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status')->default('Documents Pending'); // Ready For Submission, Submitted, Approved, Rejected
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // 8. Flight Bookings Table
        Schema::create('flight_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->string('airline');
            $table->string('booking_reference');
            $table->date('departure_date')->nullable();
            $table->date('return_date')->nullable();
            $table->string('ticket_number')->nullable();
            $table->json('passenger_details')->nullable();
            $table->string('ticket_file_path')->nullable();
            $table->timestamps();
        });

        // 9. Hotel Bookings Table
        Schema::create('hotel_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->nullOnDelete();
            $table->string('hotel_name');
            $table->string('city')->nullable();
            $table->date('check_in')->nullable();
            $table->date('check_out')->nullable();
            $table->integer('number_rooms')->default(1);
            $table->json('guests')->nullable();
            $table->string('voucher_file_path')->nullable();
            $table->string('status')->default('Confirmed'); // Confirmed, Pending
            $table->timestamps();
        });

        // 10. Payments Table
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->decimal('amount', 10, 2);
            $table->date('payment_date');
            $table->string('payment_method'); // Card, Bank Transfer, Cash, etc.
            $table->string('receipt_file_path')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // 11. Tasks Table
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('due_date')->nullable();
            $table->string('priority')->default('Medium'); // Low, Medium, High
            $table->string('status')->default('Pending'); // Pending, In Progress, Completed, Overdue
            $table->timestamps();
        });

        // 12. Commissions Table
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->foreignId('agent_id')->nullable()->constrained('users')->nullOnDelete();
            $table->decimal('amount', 10, 2);
            $table->string('type'); // Agent, Supplier, Referral
            $table->string('status')->default('Pending'); // Pending, Paid
            $table->timestamps();
        });

        // 13. ATOL Compliances Table
        Schema::create('atol_compliances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->string('atol_certificate_number')->nullable();
            $table->date('protection_date')->nullable();
            $table->boolean('terms_accepted')->default(false);
            $table->string('acknowledgement_file')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('atol_compliances');
        Schema::dropIfExists('commissions');
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('hotel_bookings');
        Schema::dropIfExists('flight_bookings');
        Schema::dropIfExists('visa_cases');
        Schema::dropIfExists('digital_signatures');
        Schema::dropIfExists('documents');
        Schema::dropIfExists('timeline_events');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('suppliers');

        Schema::table('inquiries', function (Blueprint $table) {
            $table->dropForeign(['assigned_to']);
            $table->dropColumn(['status', 'assigned_to']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
