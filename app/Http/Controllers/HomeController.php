<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Process;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function home()
    {
        return Inertia::render("Dashboard", [
            "devices" => Inertia::lazy(fn() => $this->retrieveDevices()),
        ]);
    }

    private function retrieveDevices()
    {
        $nmap = Process::run("nmap -sP 192.168.1.0/24")->output();

        $pattern = '/([\w.-]+) \((\d{1,3}(?:\.\d{1,3}){3})\)/';
        $matches = [];

        preg_match_all($pattern, $nmap, $matches, PREG_SET_ORDER);

        return collect($matches)->map(function ($device) {
            return [
                "name" => $device[1],
                "ip" => $device[2],
            ];
        });
    }
}
