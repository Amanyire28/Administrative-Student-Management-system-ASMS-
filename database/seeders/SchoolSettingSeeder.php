<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SchoolSetting;

class SchoolSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing settings (optional - use with caution)
        // SchoolSetting::truncate();

        $this->command->info('Seeding school settings...');

        // ========================================
        // A. BASIC INFORMATION
        // ========================================
        $this->seedBasicInformation();

        // ========================================
        // B. CONTACT INFORMATION
        // ========================================
        $this->seedContactInformation();

        // ========================================
        // C. ACADEMIC STRUCTURE
        // ========================================
        $this->seedAcademicStructure();

        // ========================================
        // D. EMAIL CONFIGURATION
        // ========================================
        $this->seedEmailConfiguration();

        // ========================================
        // E. REPORT CARD SETTINGS
        // ========================================
        $this->seedReportCardSettings();

        $this->command->info('✅ School settings seeded successfully!');
        $this->command->info('📊 Total settings: ' . SchoolSetting::count());
    }

    /**
     * Seed basic information settings
     */
    private function seedBasicInformation(): void
    {
        $settings = [
            [
                'key' => 'school_name',
                'value' => 'ASMS High School',
                'type' => 'text',
                'group' => 'basic',
                'description' => 'Official name of the school',
            ],
            [
                'key' => 'school_motto',
                'value' => 'Excellence in Education',
                'type' => 'text',
                'group' => 'basic',
                'description' => 'School motto or tagline',
            ],
            [
                'key' => 'school_logo',
                'value' => null,
                'type' => 'image',
                'group' => 'basic',
                'description' => 'Path to school logo image',
            ],
            [
                'key' => 'registration_number',
                'value' => 'REG-2024-001',
                'type' => 'text',
                'group' => 'basic',
                'description' => 'School registration or license number',
            ],
            [
                'key' => 'established_year',
                'value' => '2020',
                'type' => 'integer',
                'group' => 'basic',
                'description' => 'Year the school was established',
            ],
        ];

        foreach ($settings as $setting) {
            SchoolSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        $this->command->info('  ✓ Basic information settings');
    }

    /**
     * Seed contact information settings
     */
    private function seedContactInformation(): void
    {
        $settings = [
            [
                'key' => 'physical_address',
                'value' => 'Plot 123, School Road, Central Division',
                'type' => 'text',
                'group' => 'contact',
                'description' => 'Physical address of the school',
            ],
            [
                'key' => 'city',
                'value' => 'Kampala',
                'type' => 'text',
                'group' => 'contact',
                'description' => 'City or district',
            ],
            [
                'key' => 'country',
                'value' => 'Uganda',
                'type' => 'text',
                'group' => 'contact',
                'description' => 'Country',
            ],
            [
                'key' => 'phone_primary',
                'value' => '+256700000000',
                'type' => 'text',
                'group' => 'contact',
                'description' => 'Primary phone number',
            ],
            [
                'key' => 'phone_secondary',
                'value' => null,
                'type' => 'text',
                'group' => 'contact',
                'description' => 'Secondary phone number (optional)',
            ],
            [
                'key' => 'official_email',
                'value' => 'info@asms.ac.ug',
                'type' => 'text',
                'group' => 'contact',
                'description' => 'Official school email',
            ],
            [
                'key' => 'website_url',
                'value' => null,
                'type' => 'text',
                'group' => 'contact',
                'description' => 'School website URL (optional)',
            ],
        ];

        foreach ($settings as $setting) {
            SchoolSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        $this->command->info('  ✓ Contact information settings');
    }

    /**
     * Seed academic structure settings
     */
    private function seedAcademicStructure(): void
    {
        $currentYear = date('Y');
        $nextYear = $currentYear + 1;

        // Default term dates (example for 3-term system)
        $termDates = [
            '1' => [
                'name' => 'First Term',
                'start_date' => $currentYear . '-02-05',
                'end_date' => $currentYear . '-05-15',
            ],
            '2' => [
                'name' => 'Second Term',
                'start_date' => $currentYear . '-06-03',
                'end_date' => $currentYear . '-08-30',
            ],
            '3' => [
                'name' => 'Third Term',
                'start_date' => $currentYear . '-09-16',
                'end_date' => $currentYear . '-12-06',
            ],
        ];

        $settings = [
            [
                'key' => 'current_academic_year',
                'value' => $currentYear . '/' . $nextYear,
                'type' => 'text',
                'group' => 'academic',
                'description' => 'Current academic year',
            ],
            [
                'key' => 'term_system',
                'value' => '3_terms',
                'type' => 'text',
                'group' => 'academic',
                'description' => 'Term system: 3_terms or 2_semesters',
            ],
            [
                'key' => 'current_term',
                'value' => '1',
                'type' => 'integer',
                'group' => 'academic',
                'description' => 'Current term or semester number',
            ],
            [
                'key' => 'term_dates',
                'value' => json_encode($termDates),
                'type' => 'json',
                'group' => 'academic',
                'description' => 'Term/semester start and end dates',
            ],
        ];

        foreach ($settings as $setting) {
            SchoolSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        $this->command->info('  ✓ Academic structure settings');
    }

    /**
     * Seed email configuration settings
     */
    private function seedEmailConfiguration(): void
    {
        $settings = [
            [
                'key' => 'email_domain',
                'value' => 'asms.ac.ug',
                'type' => 'text',
                'group' => 'email',
                'description' => 'School email domain',
            ],
            [
                'key' => 'email_format',
                'value' => 'staffid',
                'type' => 'text',
                'group' => 'email',
                'description' => 'Email format: staffid or firstname.lastname',
            ],
        ];

        foreach ($settings as $setting) {
            SchoolSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        $this->command->info('  ✓ Email configuration settings');
    }

    /**
     * Seed report card settings
     */
    private function seedReportCardSettings(): void
    {
        $letterheadText = "ASMS HIGH SCHOOL\nP.O. Box 12345, Kampala, Uganda\nTel: +256700000000 | Email: info@asms.ac.ug\n\nEXCELLENCE IN EDUCATION";

        $footerText = "This is an official document of ASMS High School.\nFor verification, contact the school administration.";

        $settings = [
            [
                'key' => 'letterhead_text',
                'value' => $letterheadText,
                'type' => 'text',
                'group' => 'report',
                'description' => 'Text to appear on report card letterhead',
            ],
            [
                'key' => 'report_footer_text',
                'value' => $footerText,
                'type' => 'text',
                'group' => 'report',
                'description' => 'Footer text for report cards',
            ],
            [
                'key' => 'principal_name',
                'value' => 'Dr. John Doe',
                'type' => 'text',
                'group' => 'report',
                'description' => 'Name of the school principal',
            ],
            [
                'key' => 'principal_signature',
                'value' => null,
                'type' => 'image',
                'group' => 'report',
                'description' => 'Path to principal signature image',
            ],
            [
                'key' => 'headteacher_signature',
                'value' => null,
                'type' => 'image',
                'group' => 'report',
                'description' => 'Path to headteacher signature image (optional)',
            ],
        ];

        foreach ($settings as $setting) {
            SchoolSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        $this->command->info('  ✓ Report card settings');
    }
}
