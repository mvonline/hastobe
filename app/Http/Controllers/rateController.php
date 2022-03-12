<?php

namespace App\Http\Controllers;

use App\Http\Requests\rateRequest;
use App\Http\Resources\rateResource;
use App\Jobs\rateCalculator;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 *
 */
class rateController extends Controller
{
    /**
     * Watt to KW Rate
     */
    const WATT_TO_KW_RATE = 1000;
    /**
     * Seconds to Minute
     */
    const SECONDS_IN_MEETING = 60;
    /**
     * Seconds to Hour
     */
    const SECONDS_IN_HOUR = self::SECONDS_IN_MEETING * self::SECONDS_IN_MEETING;

    /**
     * @OA\Post(
     *      path="/api/rate",
     *      operationId="rate",
     *      tags={"CDR"},
     *      summary="Calculate CDR Cost based on Rates",
     *      description="Returns Overall Cost",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 ref="#/components/schemas/rateRequest",
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *     )
     */
    public function rateCalculator(rateRequest $request): array
    {
        $consumedEnergy = $this->calculateConsumedEnergy($request->cdr['meterStart'], $request->cdr['meterStop']);
        $consumedTime = Carbon::parse($request->cdr['timestampStart'])
            ->diffInSeconds(Carbon::parse($request->cdr['timestampStop']));

        $totalHour = $this->secondsToHMS($consumedTime);

        $result = $this->getResult($request, $consumedEnergy, $totalHour);

        return (new rateResource($request))->toArray($result);
    }

    /**
     * @param $meterStart
     * @param $meterStop
     * @return float|int
     */
    private static function calculateConsumedEnergy($meterStart, $meterStop)
    {
        return ($meterStop - $meterStart) / self::WATT_TO_KW_RATE;
    }

    /**
     * @param $consumedTime
     * @return float
     */
    private static  function secondsToHMS($consumedTime)
    {
        return $consumedTime / self::SECONDS_IN_HOUR;
    }

    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    /**
     * @param rateRequest $request
     * @param $consumedEnergy
     * @param $totalHour
     * @return array
     */
    private function getResult(rateRequest $request, $consumedEnergy, $totalHour): array
    {
        $result['transactionPrice'] = $request->rate['transaction'];
        $result['energyPrice'] = round($consumedEnergy * $request->rate['energy'], 3);
        $result['timePrice'] = round($totalHour * $request->rate['time'], 3);
        $result['overall'] = round($result['energyPrice'] + $result['timePrice'] + $result['transactionPrice'], 2);
        return $result;
    }

    public function rateCalculatorAsync(rateRequest $request){
        rateCalculator::dispatch($request);
        return response()->json(['msg'=>'add to queue'],200);
    }
}
