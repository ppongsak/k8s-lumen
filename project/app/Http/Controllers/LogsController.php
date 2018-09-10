<?php
namespace App\Http\Controllers;

require '../vendor/autoload.php';

use Google\Cloud\Logging\LoggingClient;

class LogsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {

        # Your Google Cloud Platform project ID
        $projectId = 'rebatemango-dev';

        # Instantiates a client
        $logging = new LoggingClient([
            'projectId' => $projectId,
            'keyFile'   => json_decode(file_get_contents(storage_path('rebatemango-dev-eb9d189f2b75.json')), true),
        ]);

        # The name of the log to write to
        $logName = 'pongsak-log';

        # Selects the log to write to
        $logger = $logging->logger($logName);

        for ($i = 1; $i <= 1000; $i++) {
            # The data to log
            $text = 'Hello, world!' . ' : ' . $i;
            $entry = $logger->entry($text);
            # Creates the log entry
            $logger->write($entry);
        }

        return 'done';
    }
}
