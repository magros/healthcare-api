<?php

use App\Models\Doctor;
use Illuminate\Http\UploadedFile;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class DoctorPhotoTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_test_that_i_can_fetch_doctor_photos()
    {
        $this->seedDatabase();

        $doctor = factory(Doctor::class)->create();

        $doctor->photos()->create(['name' => 'doctor.png']);

        $data = $this->authenticate()->makeGet("/api/doctors/{$doctor->id}/photos");

        $this->assertEquals(1, count($data));
    }

    /**
     * @test
     */
    public function it_test_that_i_can_save_a_doctor_photo()
    {
        $this->seedDatabase();

        $doctor = factory(Doctor::class)->create();

        $res = $this->authenticate($doctor->user)->makePost("/api/doctors/{$doctor->id}/photos", [
            'photo' => UploadedFile::fake()->image('avatar.jpg')
        ]);

        $this->assertEquals(1, count($res));
    }

    /**
     * @test
     */
    public function it_test_that_i_can_delete_a_doctor_photo()
    {
        $this->seedDatabase();

        $doctor = factory(Doctor::class)->create();

        $photo = $doctor->photos()->create(['name' => 'doctor.png']);

        $res = $this->authenticate($doctor->user)->makeDelete("/api/doctors/{$doctor->id}/photos/{$photo->id}");

        $this->assertEquals(0, count($res));
    }
}
