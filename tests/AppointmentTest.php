<?php

use App\Models\Doctor;
use App\Models\Appointment;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AppointmentTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_test_than_an_patient_can_make_an_appointment()
    {
        $this->seedDatabase();

        $patient = $this->createPatient();
        $doctor = factory(Doctor::class)->create();
        $doctor->medicalServices()->attach(1, ['cost' => 100, 'duration' => '5']);
        $office = $doctor->offices()->create(['state_id' => 1]);

        $data = $this->authenticate($patient->user)->makePost('/api/patients/' . $patient->id . '/appointments', [
            'office_id' => $office->id,
            'hour' => '12:20',
            'date' => '2019-12-27',
            'doctor_medical_service_id' => 1
        ]);

        $this->assertEquals($data->office->id, $office->id);
        $this->assertEquals($data->hour, '12:20');
        $this->assertEquals($data->date, '2019-12-27');
    }

    /**
     * @test
     */
    public function it_test_that_i_can_fetch_schedule_from_a_office()
    {
        $this->seedDatabase();

        $today = \Carbon\Carbon::now();
        $patient = $this->createPatient();
        $doctor = factory(Doctor::class)->create();
        $office = $doctor->offices()->create(['state_id' => 1]);
        $doctor->medicalServices()->attach(1, ['cost' => 100, 'duration' => 60]);
        $doctorMedicalService = $doctor->medicalServices->first();

        $office->schedule()->create(['weekday' => $today->dayOfWeekIso, 'start_hour' => '07:00', 'end_hour' => '14:00', 'medical_service_id' => 1]);
        $office->schedule()->create(['weekday' => $today->dayOfWeekIso, 'start_hour' => '16:00', 'end_hour' => '21:00', 'medical_service_id' => 1]);

        $office->appointments()->create(['date' => $today->format('d/m/Y'), 'hour' => '07:00', 'doctor_medical_service_id' => $doctorMedicalService->pivot->id, 'patient_id' => $patient->id]);
        $office->appointments()->create(['date' => $today->format('d/m/Y'), 'hour' => '08:00', 'doctor_medical_service_id' => $doctorMedicalService->pivot->id, 'patient_id' => $patient->id]);
        $office->appointments()->create(['date' => $today->format('d/m/Y'), 'hour' => '09:00', 'doctor_medical_service_id' => $doctorMedicalService->pivot->id, 'patient_id' => $patient->id]);
        $office->appointments()->create(['date' => $today->format('d/m/Y'), 'hour' => '18:00', 'doctor_medical_service_id' => $doctorMedicalService->pivot->id, 'patient_id' => $patient->id]);


        $res = $this->authenticate($patient->user)->makeGet('/api/offices/' . $office->id . '/schedule', [
            'date' => $today->format('d-m-Y'),
            'doctorMedicalServiceId' => $doctorMedicalService->pivot->id,
            'officeId' => $office->id
        ]);

        $todaySchedule = $res[0]->schedule;

        $this->assertEquals($today->format('d/m/Y'), $res[0]->date);

        $at1400 = $this->findScheduleHour('14:00', $todaySchedule);
        $this->assertEquals('unavailable', $at1400->status);

        $at0700 = $this->findScheduleHour('07:00', $todaySchedule);

        $this->assertEquals('available', $at0700->status);

        $at1500 = $this->findScheduleHour('16:00', $todaySchedule);

        $this->assertEquals('available', $at1500->status);
    }

    /**
     * @test
     */
    public function it_test_that_i_can_retrieve_appointments_from_a_patient()
    {
        $this->seedDatabase();

        $today = \Carbon\Carbon::now();
        $patient = $this->createPatient();
        $doctor = factory(Doctor::class)->create();
        $office = $doctor->offices()->create(['state_id' => 1]);
        $doctor->medicalServices()->attach(1, ['cost' => 100, 'duration' => 60]);
        $doctorMedicalService = $doctor->medicalServices->first();
        $office->appointments()->create([
            'date' => $today->format('d/m/Y'), 'hour' => '07:00',
            'doctor_medical_service_id' => $doctorMedicalService->pivot->id, 'patient_id' => $patient->id
        ]);

        $res = $this->authenticate($patient->user)->makeGet('/api/patients/' . $patient->id . '/appointments');

        $this->assertEquals(count($res), 1);
    }

    private function findScheduleHour($hour, $schedule)
    {
        $index = $this->findScheduleIndex($hour, $schedule);

        return $schedule[$index];
    }

    private function findScheduleIndex($hour, $schedule)
    {
        foreach ($schedule as $key => $val) {
            if ($val->hour === $hour) {
                return $key;
            }
        }
        return null;
    }
}
