<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


/**
 * @OA\Schema()
 */
class rateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @OA\Property(
     *     property="rate",
     *      @OA\Property(format="integer", default=0.3, description="energy rate", property="energy"),
     *      @OA\Property(format="integer", default=2, description="time rate", property="time"),
     *      @OA\Property(format="integer", default=1, description="transaction rate", property="transaction")
     * ,description="Rate"),
     * @OA\Property(
     *     property="cdr",
     *      @OA\Property(format="integer", default=1204307, description="meterStart", property="meterStart"),
     *      @OA\Property(format="string", default="2021-04-05T10:04:00Z", description="timestampStart", property="timestampStart"),
     *      @OA\Property(format="integer", default=1215230, description="meterStop", property="meterStop"),
     *      @OA\Property(format="string", default="2021-04-05T11:27:00Z", description="timestampStop", property="timestampStop")
     * )
     */
    public function rules()
    {
        return [
            'rate' => 'required',
            'rate.energy' => 'required|numeric',
            'rate.time' => 'required|numeric',
            'rate.transaction' => 'required|numeric',
            'cdr' => 'required',
            'cdr.meterStart' => 'required|numeric',
            'cdr.timestampStart' => 'required|date',
            'cdr.meterStop' => 'required|numeric',
            'cdr.timestampStop' => 'required|date',
        ];
    }
}
