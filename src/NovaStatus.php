<?php

namespace Kingsley\NovaStatus;

use Throwable;
use Laravel\Nova\Card;
use Illuminate\Http\JsonResponse;

class NovaStatus extends Card
{
    /**
     * Array of statuses to check.
     *
     * @var array
     */
    protected static $statuses = [];

    /**
     * Get the component name for the card.
     *
     * @return string
     */
    public function component()
    {
        return 'nova-status';
    }

    /**
     * Registers the given status.
     *
     * @return $this
     */
    public function register(string $class)
    {
        static::$statuses[] = $class;

        return $this;
    }

    /**
     * Get additional meta information to merge with the element payload.
     *
     * @return array
     */
    public function meta()
    {
        return array_merge($this->meta, [
            'statuses' => static::$statuses,
        ]);
    }

    /**
     * Get the API response.
     */
    public static function response(): JsonResponse
    {
        $data = collect(static::$statuses)
            ->map(function ($class) {
                $status = resolve($class);
                $value = null;

                try {
                    $value = $status->check();
                } catch (Throwable $exception) {
                    $value = $exception->getMessage();
                }

                return [
                    'value' => $value,
                    'label' => $status->label,
                ];
            })
            ->all();

        return response()->json($data);
    }
}
