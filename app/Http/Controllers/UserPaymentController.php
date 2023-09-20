<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use App\Transformers\PaymentTransformer;
use Illuminate\Http\Request;

class UserPaymentController extends Controller
{
    use ApiResponser;

    /**
     * @var PaymentTransformer
     */
    private $paymentTransformer;

    /**
     * UserPaymentController constructor.
     * @param PaymentTransformer $paymentTransformer
     */
    public function __construct(PaymentTransformer $paymentTransformer)
    {
        $this->paymentTransformer = $paymentTransformer;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required',
            'concept' => 'required'
        ]);

        $user = $request->user();

        $payment = $user->payments()->create($request->all());

        return $this->successResponse($this->paymentTransformer->transform($payment));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $payments = $user->payments->toArray();

        return $this->successResponse($this->paymentTransformer->transformCollection($payments));
    }
}
