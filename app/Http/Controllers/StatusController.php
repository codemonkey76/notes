<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        return array_values(Note::STATUS);
    }
}
