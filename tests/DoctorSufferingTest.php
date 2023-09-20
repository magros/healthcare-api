<?php
//
//use App\Models\Doctor;
//use Laravel\Lumen\Testing\DatabaseMigrations;
//use Laravel\Lumen\Testing\DatabaseTransactions;
//
//class DoctorSufferingTest extends TestCase
//{
//    use DatabaseMigrations;
//
//    /**
//     * @test
//     */
//    public function it_test_that_i_can_add_a_new_doctor_suffering_to_an_existing_doctor()
//    {
//        $this->seedDatabase();
//
//        $doctor = factory(Doctor::class)->create();
//
//        $doctor->medicalServices()->attach(1, ['cost' => 100, 'duration' => '5']);
//
//        $data = $this->authenticate()->makePost("/api/doctors/{$doctor->id}/sufferings", [
//            'name' => 'Diarrea',
//        ]);
//
//        $suffering = $doctor->sufferings()->first();
//
//        $this->assertEquals($suffering->name, 'Diarrea');
//    }
//}
