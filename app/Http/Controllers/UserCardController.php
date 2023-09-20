<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Transformers\CardTransformer;

class UserCardController extends Controller
{
    use ApiResponser;

    /**
     * @var CardTransformer
     */
    private $cardTransformer;

    public function __construct(CardTransformer $cardTransformer)
    {
        $this->cardTransformer = $cardTransformer;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'number' => 'required|string',
            'expire_month' => 'required',
            'expire_year' => 'required',
            'type' => 'required|in:VISA,MASTERCARD,AMERICAN_EXPRESS,OTHER'
        ]);

        $user = $request->user();

        $card = $user->cards()->create($request->all())->toArray();

        return $this->successResponse($this->cardTransformer->transform($card));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $user = $request->user();

        return $this->successResponse($this->cardTransformer->transformCollection($user->cards->toArray()));
    }

    public function delete(Request $request, $userId, $cardId)
    {
        $user = $request->user();
        $user->cards()->find($cardId)->delete();

        return $this->successResponse('Card deleted');
    }
}
