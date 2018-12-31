<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssetsController extends Controller
{
    /**
     * Renders all lang string into a Javascript file.
     */
    public function lang(Request $request)
    {
        $strings = \Cache::rememberForever('lang.js', function () use ($request) {
            $lang = $request->session()->has('locale')
                ? $request->session()->get('locale')
                : 'es';

            $files = glob(resource_path("lang/${lang}/*.php"));
            $strings = [];

            foreach ($files as $file) {
                $name = basename($file, '.php');
                $strings[$name] = require $file;
            }

            return $strings;
        });

        return response('window.i18n = ' . json_encode($strings) . ';', 200, ['Content-Type' => 'text/javascript']);
        /*
        header('Content-Type: text/javascript');
        echo 'window.i18n = ' . json_encode($strings) . ';';
        exit();
        */
    }

    /**
     * Renders a list of enum values.
     */
    public function enums()
    {
        $classes = [
            \App\Enums\CivilStatusType::class,
            \App\Enums\ExpedientKeyType::class,
            \App\Enums\FederalEntityType::class,
            \App\Enums\FileExtensionType::class,
            \App\Enums\MortgageCreditType::class,
            \App\Enums\OperationType::class,
            \App\Enums\PriorityType::class,
            \App\Enums\RoleType::class,
        ];

        $strings = \Cache::rememberForever('enums.js', function () use ($classes) {
            $strings = [];

            foreach ($classes as $class) {
                $keys = $class::getKeys();
                $values = $class::getValues();
                for ($i = 0; $i < count($keys); $i++) {
                    $strings[class_basename($class)][$keys[$i]] = $values[$i];
                }
            }

            return $strings;
        });

        return response('window.enums= ' . json_encode($strings) . ';', 200, ['Content-Type' => 'text/javascript']);
        /*
        header('Content-Type: text/javascript');
        echo 'window.enums= ' . json_encode($strings) . ';';
        exit();
        */
    }
}
