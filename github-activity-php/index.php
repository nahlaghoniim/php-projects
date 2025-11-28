<?php


if (PHP_SAPI !== 'cli') {
    echo "This script must be run from the command line.\n";
    exit(1);
}

// Get username from CLI
if ($argc < 2) {
    echo "Usage: php index.php <github-username>\n";
    exit(1);
}

$username = $argv[1];

// Prepare GitHub API URL
$apiUrl = "https://api.github.com/users/$username/events";
$options = [
    "http" => [
        "header" => "User-Agent: PHP CLI\r\n"
    ]
];
$context = stream_context_create($options);

// Fetch data
$data = @file_get_contents($apiUrl, false, $context);
if ($data === false) {
    echo "Error: Could not fetch data. Check the username or try again later.\n";
    exit(1);
}

$events = json_decode($data, true);
if ($events === null) {
    echo "Error: Failed to decode JSON response.\n";
    exit(1);
}

//  Display recent activity
if (empty($events)) {
    echo "No recent activity found for user '$username'.\n";
} else {
    echo "Recent GitHub activity for '$username':\n\n";

    foreach (array_slice($events, 0, 10) as $event) { // Show latest 10 events
        $type = $event['type'];
        $repo = $event['repo']['name'] ?? "unknown repo";

        switch ($type) {
            case 'PushEvent':
                $commits = $event['payload']['commits'] ?? [];
                $numCommits = is_array($commits) ? count($commits) : 0;

                if ($numCommits > 0) {
                    echo "- Pushed $numCommits commit" . ($numCommits != 1 ? 's' : '') . " to $repo:\n";
                    foreach ($commits as $commit) {
                        $msg = $commit['message'] ?? 'No message';
                        echo "   • $msg\n";
                    }
                } else {
                    echo "- Pushed commits to $repo (no commit details available)\n";
                }
                break;

            case 'IssuesEvent':
                $action = $event['payload']['action'] ?? "performed an action";
                echo "- " . ucfirst($action) . " an issue in $repo\n";
                break;

            case 'WatchEvent':
                echo "- Starred $repo\n";
                break;

            case 'PullRequestEvent':
                $action = $event['payload']['action'] ?? "performed an action";
                echo "- " . ucfirst($action) . " a pull request in $repo\n";
                break;

            case 'CreateEvent':
                $refType = $event['payload']['ref_type'] ?? 'something';
                echo "- Created $refType in $repo\n";
                break;

            case 'ForkEvent':
                $forkedRepo = $event['payload']['forkee']['full_name'] ?? 'unknown';
                echo "- Forked $repo to $forkedRepo\n";
                break;

            case 'DeleteEvent':
                $refType = $event['payload']['ref_type'] ?? 'something';
                echo "- Deleted $refType in $repo\n";
                break;

            default:
                echo "- $type in $repo\n";
                break;
        }
    }

    echo "\n"; 
}
