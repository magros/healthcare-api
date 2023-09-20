<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Doctor;
use App\Models\Office;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Filters\DoctorFilter;
use App\Models\MedicalService;
use App\Transformers\OfficeTransformer;

class OfficeController extends Controller
{
    use ApiResponser;
    /**
     * @var OfficeTransformer
     */
    private $transformer;


    /**
     * OfficeController constructor.
     * @param OfficeTransformer $transformer
     */
    public function __construct(OfficeTransformer $transformer)
    {
        $this->transformer = $transformer;
    }


    /**
     * @param Request $request
     * @param $officeId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function schedule(Request $request, $officeId)
    {
        $this->validate($request, [
            'doctorMedicalServiceId' => 'required|integer',
            'date' => ['required', 'regex:/^(0[1-9]|1\d|2\d|3[01])-(0[1-9]|1[0-2])-(19|20)\d{2}$/i']
        ],  ['date.regex' => 'La fecha debe tener el formato d/m/Y']);

        $date = $request->get('date');
        $service = $request->get('doctorMedicalServiceId');


        $office = Office::findOrFail($officeId);

        $medicalService = Doctor::findOrFail($office->doctor->id)
            ->medicalServices()
            ->where('medical_service_id', $service)
            ->first();

        $date1 = Carbon::createFromFormat('d-m-Y', $date);
        $date2 = Carbon::createFromFormat('d-m-Y', $date)->addDay(1);
        $date3 = Carbon::createFromFormat('d-m-Y', $date)->addDay(2);

        $scheduleDate1 = $this->getScheduleByDate($office, $date1, $medicalService);
        $scheduleDate2 = $this->getScheduleByDate($office, $date2, $medicalService);
        $scheduleDate3 = $this->getScheduleByDate($office, $date3, $medicalService);

        return $this->successResponse([
            [
                'date' => $date1->format('d/m/Y'),
                'day' => $date1->day,
                'weekday' => ucfirst($date1->formatLocalized('%a')),
                'month' => ucfirst($date1->formatLocalized('%B')),
                'schedule' => $scheduleDate1
            ], [
                'date' => $date2->format('d/m/Y'),
                'day' => $date2->day,
                'weekday' => ucfirst($date2->formatLocalized('%a')),
                'month' => ucfirst($date2->formatLocalized('%B')),
                'schedule' => $scheduleDate2
            ], [
                'date' => $date3->format('d/m/Y'),
                'day' => $date3->day,
                'weekday' => ucfirst($date3->formatLocalized('%a')),
                'month' => ucfirst($date3->formatLocalized('%B')),
                'schedule' => $scheduleDate3
            ]
        ]);
    }

    private function getScheduleByDate($office, Carbon $date, $medicalService)
    {
        $interval = $medicalService->pivot->duration;
        $schedule = $office->scheduleByWeekDay($date->dayOfWeekIso);
        $appointments = $office->appointments()->where('date', $date->format('Y/m/d'))->get();

        $scheduleHours = [];
        $occupiedHours = [];

        $hours = [];

        foreach ($appointments as $appointment) {

            list($hour, $minutes) = explode(':', $appointment->hour);

            $tmpDate = (new Carbon())->setMinutes($minutes)->setSeconds(0)->setHour($hour)->addMinutes($interval);

            $nextHour = $tmpDate->format('H:i');

            $occupiedHours[] = $appointment->hour . '-' . $nextHour;
        }

        $minHour = '08:00';
        $maxHour = '22:00';

        foreach ($schedule as $av) {

            $start_hour = $av->start_hour;
            $end_hour = $av->end_hour;

            while ($this->isLower($start_hour, $end_hour)) {
                list($hour, $minutes) = explode(':', $start_hour);

                $tmpDate = (new Carbon())->setMinutes($minutes)->setSeconds(0)->setHour($hour)->addMinutes($interval);

                $tmpHour = $tmpDate->format('H:i');

                $scheduleHours[] = $start_hour . '-' . $tmpHour;

                if ($start_hour < $minHour) {
                    $minHour = $start_hour;
                }

                $start_hour = $tmpHour;

                if ($start_hour > $maxHour) {
                    $maxHour = $start_hour;
                }
            }
        }

        while ($this->isLower($minHour, $maxHour)) {

            list($hour, $minutes) = explode(':', $minHour);

            $tmpDate = (new Carbon())->setMinutes($minutes)->setSeconds(0)->setHour($hour)->addMinutes($interval);

            $tmpHour = $tmpDate->format('H:i');

            $hour = $minHour . '-' . $tmpHour;

            $isOccupied = array_search($hour, $occupiedHours) !== false;

            $available = array_search($hour, $scheduleHours) !== false;

            $status = !$isOccupied && $available ? 'available' : (($isOccupied) ? 'occupied' : 'unavailable');

            $hours[] = ['hour' => $minHour, 'status' => $status, 'init' => $minHour, 'end' => $tmpHour];

            $minHour = $tmpHour;
        }

        return $hours;
    }

    private function isLower($firstHour, $secondHour)
    {
        list($hour1, $minutes1) = explode(':', $firstHour);
        list($hour2, $minutes2) = explode(':', $secondHour);

        return ($hour1 < $hour2);
    }

    public function mockResponse()
    {
        return [
            [
                'date' => '12-05-2019',
                'day' => '12',
                'weekday' => 'Dom',
                'month' => 'Mayo',
                'schedule' => [
                    ['hour' => '9:30', 'status' => 'occupied'],
                    ['hour' => '10:30', 'status' => 'occupied'],
                    ['hour' => '11:30', 'status' => 'occupied'],
                    ['hour' => '12:30', 'status' => 'occupied'],
                    ['hour' => '13:30', 'status' => 'available'],
                    ['hour' => '14:30', 'status' => 'available'],
                    ['hour' => '14:30', 'status' => 'occupied'],
                ]
            ],
            [
                'date' => '01-06-2019',
                'day' => '01',
                'weekday' => 'Lun',
                'month' => 'Junio',
                'schedule' => [
                    ['hour' => '9:30', 'status' => 'occupied'],
                    ['hour' => '10:30', 'status' => 'available'],
                    ['hour' => '11:30', 'status' => 'occupied'],
                    ['hour' => '12:30', 'status' => 'occupied'],
                    ['hour' => '13:30', 'status' => 'available'],
                    ['hour' => '14:30', 'status' => 'available'],
                    ['hour' => '14:30', 'status' => 'occupied'],
                ]
            ],
            [
                'date' => '02-06-2019',
                'day' => '02',
                'weekday' => 'Dom',
                'month' => 'Junio',
                'schedule' => [
                    ['hour' => '9:30', 'status' => 'occupied'],
                    ['hour' => '10:30', 'status' => 'available'],
                    ['hour' => '11:30', 'status' => 'available'],
                    ['hour' => '12:30', 'status' => 'available'],
                    ['hour' => '13:30', 'status' => 'available'],
                    ['hour' => '14:30', 'status' => 'available'],
                    ['hour' => '14:30', 'status' => 'occupied'],
                ]
            ],
        ];
    }

    public function show($id)
    {
        $office = Office::find($id);
        $office->append('avatar_url');

        return $this->successResponse($this->transformer->transform($office->toArray()));
    }

    public function search()
    {
        $offices = Office::with(['doctor.user', 'doctor.specialities'])->get();
        $offices->each(function ($office) {
            $office->append('avatar_url');
            $office->doctor->user->append('avatar_url');
        });
        return $this->successResponse($this->transformer->transformCollection($offices->toArray()));
    }

    public function storeSchedule(Request $request, $officeId)
    {

        $office = Office::findOrFail($officeId);
        $schedule = $office->schedule()->where('weekday', $request->weekday)->get();
        if ($schedule) {
            $office->schedule()->update(['weekday' => $request->weekDay, 'start_hour' => $request->startHour, 'end_hour' => $request->endHour]);
        } else {
            $office->schedule()->create(['weekday' => $request->weekDay, 'start_hour' => $request->startHour, 'end_hour' => $request->endHour]);
        }
        return $this->successResponse('Schedule stored');
    }

    
    public function store(Request $request)
    {
        $this->validate($request, [
            'stateId' => 'required|integer',
            'doctorId' => 'required|integer',
            'hospitalId' => 'required|integer',
        ]);
        $office = Office::create([
            'state_id' => $request->stateId,
            'doctor_id' => $request->doctorId,
            'description' => $request->description,
            'address' => $request->address,
            'postal_code' => $request->postalCode,
            'suburb' => $request->suburb,
            'address_reference' => $request->addressReference,
            'city' => $request->city,
            'contact_phone' => $request->contactPhone,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'office_type' => $request->officeType,
            'hospital_id' => $request->hospitalId
        ]);
        return $this->successResponse($office);
    }
}
