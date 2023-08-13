<?php

namespace Database\Factories;

use App\Models\Hospital;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Requisition>
 */
class RequisitionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => fake()->email(),
            'hospital_id' => Hospital::factory()->create()->id,
            'patient_name' => fake('en_IN')->name,
            'primary_contact' => fake('en_IN')->mobileNumber(),
            'secondary_contact' => fake('en_IN')->mobileNumber(),
            'emergency_contact' => fake('en_IN')->mobileNumber(),
            'blood_group' => fake()->numberBetween(1, 8),
            'donation_type' => 'whole_blood',
            'unit' => fake()->numberBetween(1, 4),
            'required_on' => fake()->dateTimeBetween('+1 day 12:00:00', '+2 days 11:59:59'),
            'status' => fake()->boolean(),
            'image' => fake()->image(),
            'urgent' => fake()->boolean(),
            'notes' => fake()->paragraph(),
        ];
    }
}
