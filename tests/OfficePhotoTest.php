<?php

use App\Models\Office;
use Illuminate\Http\UploadedFile;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class OfficePhotoTest extends TestCase
{
  use DatabaseMigrations;

  /**
   * @test
   */
  public function it_test_that_i_can_fetch_office_photos()
  {
    $this->seedDatabase();

    $office = factory(Office::class)->create();

    $office->photos()->create(['name' => 'office.png']);

    $data = $this->authenticate()->makeGet("/api/offices/{$office->id}/photos");
    
    $this->assertEquals(1, count($data));
  }

  /**
   * @test
   */
  public function it_test_that_i_can_save_an_office_photo()
  {
    $this->seedDatabase();

    $office = factory(Office::class)->create();

    $res = $this->authenticate($office->doctor->user)->makePost("/api/offices/{$office->id}/photos", [
      'photo' => UploadedFile::fake()->image('avatar.jpg')
    ]);

    $this->assertEquals(1, count($res));
  }

  /**
   * @test
   */
  public function it_test_that_i_can_delete_an_office_photo()
  {
    $this->seedDatabase();

    $office = factory(Office::class)->create();

    $photo = $office->photos()->create(['name' => 'office.png']);

    $res = $this->authenticate($office->doctor->user)->makeDelete("/api/offices/{$office->id}/photos/{$photo->id}");

    $this->assertEquals(0, count($res));
  }
}
