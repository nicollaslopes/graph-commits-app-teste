<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CommitController extends Controller
{
    public function getNumbersCommits() {

        $repos = CommitController::getRepos();

        $arr = [];

        foreach($repos as $key => $repo) {
            
            $response = Http::get("https://api.github.com/repos/nicollaslopes/$repo/commits");
            $commitsArray = json_decode($response->getBody());
            $quantityCommits = count($commitsArray);

            $arr[$key]['name'] = $repo;
            $arr[$key]['qt'] = $quantityCommits;
            
            $dateToday = new \Datetime();

            foreach ($commitsArray as $keyDate => $commit) {
                $dateCommit = date('d-m-Y', strtotime($commit->commit->committer->date));
                $dateCommitFormat = new \Datetime($dateCommit);

                $interval = $dateToday->diff($dateCommitFormat);

                if ($interval->days < 90) {
                    $arr[$key][$keyDate]['date'] = $dateCommit;
                }
            }

        }

        return view('dashboard', [
            'arr' => $arr 
        ]);
    }

    public static function getRepos() {

        $repos = Http::get('https://api.github.com/users/nicollaslopes/repos');

        $reposJson = json_decode($repos->getBody());

        $arrayRepos = [];

        foreach($reposJson as $repo) {
            if ($repo->name) {
                array_push($arrayRepos, $repo->name);
            }
        }

        return $arrayRepos;
    }
}
