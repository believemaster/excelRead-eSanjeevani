<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\NetworkReport;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function index()
    {
        $reports = NetworkReport::all();

        // dd($reports);

        return view('welcome', compact('reports'));
    }

    public function uploadCsv(Request $request)
    {
        if ($request->file('csvFile') != null) {

            $file = $request->file('csvFile');

            // File Details 
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();

            // Valid File Extensions
            $valid_extension = array("csv");

            // Check file extension
            if (in_array(strtolower($extension), $valid_extension)) {

                // File upload location
                $location = 'uploads';

                // Upload file
                $file->move($location, $filename);

                // Import CSV to Database
                $filepath = public_path($location . "/" . $filename);

                NetworkReport::truncate();
                $csvData = fopen($filepath, "r");
                $transRow = true;
                while (($data = fgetcsv($csvData, 555, ',')) !== false) {
                    if (!$transRow) {
                        NetworkReport::create([
                            "State" => $data[0],
                            "Hub" => $data[1],
                            "Spoke" => $data[2],
                            "Doctors" => $data[3],
                            "CHO" => $data[4],
                            "OPD_V1" => $data[5],
                            "OPD_V2" => $data[6],
                            "Total_OPD" => $data[7],
                            "HWC_V1" => $data[8],
                            "HWC_V2" => $data[9],
                            "Total_HWC" => $data[10],
                            "Total_Consultation" => $data[11]
                        ]);
                    }
                    $transRow = false;
                }
                fclose($csvData);

                return back()->with(['message' => 'Import Successful.', 'class' => 'success', 'icon' => 'check-circle']);
            } else {
                return back()->with(['message' => 'Invalid File Extension. (Only .csv allowed)', 'class' => 'warning', 'icon' => 'times-circle']);
            }
        }

        return back()->with(['message' => 'Oops! You forgot to upload the file.', 'class' => 'danger', 'icon' => 'exclamation-triangle']);
    }

    public function truncatePrevData()
    {
        NetworkReport::query()->truncate();

        return back()->with(['message' => 'Previous Data Truncated', 'class' => 'success', 'icon' => 'check-circle']);
    }

    public function getFacts()
    {
        if (NetworkReport::exists()) {

            $totalConsultations = NetworkReport::where('State', 'India')->get('Total_Consultation');
            $totalHwc = NetworkReport::where('State', 'India')->get('Total_HWC');
            $leadingStatesHwc = NetworkReport::where('State', 'not like', "%India%")
                ->where("Total_Consultation", ">", 100)
                ->get(['State', 'Total_Consultation']);
            $opdServed = NetworkReport::where('State', 'India')->get('Total_OPD');
            $leadingStatesOpd = NetworkReport::where('State', 'not like', "%India%")
                ->where("Total_OPD", ">", 100)
                ->get(['State', 'Total_OPD']);

            $spoke = NetworkReport::where('State', 'India')->get('Spoke');
            $hub = NetworkReport::where('State', 'India')->get('Hub');

            // dd($leadingStatesOpd);

            // $data = ['totalConsultations', 'totalHwc', 'leadingStatesHwc', 'opdServed', 'leadingStatesOpd'];

            return view('factData', compact('spoke', 'hub', 'totalConsultations', 'totalHwc', 'leadingStatesHwc', 'opdServed', 'leadingStatesOpd'));
        } else {
            return back()->with(['message' => 'Oops! There is no data to get the fact. Please upload Network Report First.', 'class' => 'warning', 'icon' => 'exclamation-triangle']);
        }
    }
}
