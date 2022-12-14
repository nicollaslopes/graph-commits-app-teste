<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CommitController extends Controller
{
    public function getDataCommits() {

        $repo = explode('/', $_SERVER['PATH_INFO']);

        $repoName = $repo[2];

        $arr = [];
        
        $nickName = Auth::User()->getAttributes()['nickname'];
        $response = Http::get("https://api.github.com/repos/$nickName/$repoName/commits");
        $commitsArray = json_decode($response->getBody());

        $arr['name'] = $repoName;

        $dateToday = new \Datetime();

        foreach ($commitsArray as $keyDate => $commit) {
            $dateCommit = date('d-m-Y', strtotime($commit->commit->committer->date));
            $dateCommitFormat = new \Datetime($dateCommit);

            $interval = $dateToday->diff($dateCommitFormat);

            if ($interval->days < 90) {
                $arr['date'][$keyDate] = $dateCommit;
            }
        }

        return view('graphs', [
            'arr' => $arr
        ]);
    }

    public static function getRepos() {

        $nickName = Auth::User()->getAttributes()['nickname'];

        $repos = Http::get("https://api.github.com/users/$nickName/repos");

        $reposJson = json_decode($repos->getBody());

        $arrayRepos = [];

        foreach($reposJson as $repo) {
            if ($repo->name) {
                array_push($arrayRepos, $repo->name);
            }
        }

        return $arrayRepos;
    }

    public static function renderDashboard() {
        $repos = CommitController::getRepos();

        return view('dashboard', [
            'repos' => $repos
        ]);
    }
    
}
