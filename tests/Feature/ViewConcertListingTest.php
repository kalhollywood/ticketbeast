<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Concert;
use Tests\TestCase;
use Illuminate\Support\Carbon;

class ViewConcertListingTest extends TestCase
{
    use DatabaseMigrations;

    protected $baseUrl = 'http://localhost';

    /** test */
    public function test_user_can_view_a_concert_listing()
    {
        // Arrange
        // Creat a concert
        $concert = Concert::create([
            'title' => 'The Red Chord',
            'subtitle' => 'with Animosity and Lethargy',
            'date' => Carbon::parse('13th December 2023 8:00pm'),
            'ticket_price' => 3250,
            'venue' => 'The Most Pit',
            'venue_address' => '123 Example Lane',
            'city' => 'Laraville',
            'state' => 'ON',
            'zip' => '17916',
            'additional_information' => 'For tickets call 555-5555.'
        ]);

        // Act
        // View the concert listing
        $this->visit('/concerts' . $concert->id);

        // Assert
        // See the concert details
        $this->see('The Red Chord');
        $this->see('with Animosity and Lethargy');
        $this->see('13th December 2023');
        $this->see('8:00pm');
        $this->see('32.50');
        $this->see('The Mosh Pitt');
        $this->see('123 Example Lane');
        $this->see('The Mosh Pitt');
        $this->see('Laraville, ON, 17916');
        $this->see('For tickets call 555-5555.');
    }
}
