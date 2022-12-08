<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CommitController extends Controller
{
    public function getNumbersCommits() {

        $reposName = CommitController::getReposName();

        foreach($reposName as $repoName) {

        }

        $response = Http::get('https://api.github.com/repos/nicollaslopes/api-rest-node/commits');
        $commitsArray = json_decode($response->getBody());

        $quantityCommits = count($commitsArray);

        return view('welcome', ['quantityCommits' => $quantityCommits]);
    }

    public static function getReposName() {

        $response = Http::get('https://api.github.com/users/nicollaslopes/repos');

        $responseJson = json_decode($response->getBody());

        $arrayRepos = [];


        foreach($responseJson as $r) {
            array_push($arrayRepos, $r->name);
        }

        return $arrayRepos;

    }
}
