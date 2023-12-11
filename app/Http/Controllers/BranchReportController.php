<?php

namespace App\Http\Controllers;

use App\Mail\BranchReportMail;
use App\Models\BranchReport;
use App\Models\BranchReportContribution;
use App\Models\BranchReportContributionAttachment;
use App\Models\Category;
use App\Traits\UserRole;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Mail;

class BranchReportController extends Controller
{
    use UserRole;
    function index(Request $request) {
        $rbd = $this->getRegionBranch();
        $query = BranchReport::query();
        $query->with('branchReportContributions.attachments');
        // if ($request->has('type')) {
        //     $query->where('type', $request->input('type'));
        // }
        if(!empty($rbd)){
            foreach($rbd as $k => $r){
                if($r !== 0){
                $query->where($k,$r);
                }
            }
        }
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('invoice_no', 'LIKE', "%$search%")
            ->orWhere('branch_name', 'like', "%$search%")
            ->orWhere('brought_by', 'like', "%$search%")
            ->orWhere('grand_total', 'like', "%$search%");
        }

        if ($request->has('is_approved')) {
            $query->where('is_approved', $request->input('is_approved'));
        }
        $query->orderBy('created_at', 'desc');
        $branch_reports = $query->paginate(10);
        return response()->json(['status'=>true,'data' => $branch_reports], 201); 

    }
    public function store(Request $request)
    {
        // Validate the request data
     
        $validated = $request->validate([
            'invoice_no' => 'required|string',
            // 'branch_name' => 'required|string',
            // 'category_id' => 'required|exists:categories,id',
            'brought_by' => 'required|string',
            'grand_total' => 'required|numeric',
            'justification' => 'sometimes|string|min:3',
            'billing_date' => 'required|date_format:Y-m-d',
            'date' => 'required|date_format:Y-m-d',
            'contributions.*.contribution_id' => 'required|integer|exists:categories,id',
            'contributions.*.amount' => 'required|numeric',
            'contributions.*.justification' => 'sometimes|string|min:6',
            'contributions.*.attachments.*' => 'sometimes|file|mimes:docx,pdf|max:2048',
        ]);
         $user = auth('user')->user();
         $validated['user_id'] = $user->id;
         $validated = array_merge($validated,$this->getRegionBranch());
       
        // dd($validated);
        // return response()->json(['message' => $validated], 201);

        // Create a new withdrawal
        $branchReport = BranchReport::create($validated);
        if(isset($validated['contributions'])){
            foreach($validated['contributions'] as $contribution) {
                $contribution['branch_report_id'] = $branchReport->id;
                $bContribution = BranchReportContribution::create($contribution);
        if (isset($contribution['attachments'])) {
            foreach($contribution['attachments'] as $document) {
                $documentPath = $document->store('branch_reports/contributions/attachments','public'); 
                $fileName = basename($documentPath);
                $documentCreate = [
                    'branch_report_contribution_id'=> $bContribution->id,
                    'file_name'=> $fileName,
                    'file_path'=> $documentPath,
                    'file_size'=> $document->getSize(),
                    'file_type'=> $document->getMimeType(),
                ];
                $documentModel = BranchReportContributionAttachment::create($documentCreate);
            }
        }
        }
    }

        return response()->json(['status'=>true,'message' => 'Branch Report created successfully'], 201);
    }

    function show(Request $request,$id) {
        $rbDt = $this->getRegionBranch();
        $report = BranchReport::with('branchReportContributions.attachments')->where('id',$id);
        if(!empty($rbDt)){
            foreach($rbDt as $k => $r){
                if($r !== 0){
                $report->where($k,$r);
                }
            }
        }
        if(!$report){
            return response()->json(['status'=>false,'message' => 'Report Not Found.']); 
        }
        return response()->json(['status'=>true,'data' => $report->first()], 201); 
    }

    function followup(Request $request) {
        $rbd = $this->getRegionBranch();
        $query = Category::query();
        // dd($rbd);
        if(!empty($rbd)){
            foreach($rbd as $k => $r){
                if($k == 'region_id' && $r !== 0){
                $query->where('type_id',$r);
                }
            }
        }
        // dd($query->toSql());
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%$search%");
        }
        $query->orderBy('created_at', 'desc');
        $branches = $query->paginate(10);
        return response()->json(['status'=>true,'data' => $branches], 201); 

    }

    public function downloadPdf($reportId)
    {
        return $this->generatePdf($reportId,'download');
    } 
    public function sendPdfByEmail($reportId)
    {
        $report = BranchReport::with('branchReportContributions.attachments')->find($reportId);
        if(!$report){
            return response()->json(['status'=>false,'message' => 'Report not Found.'], 201); 
  
        }
        // $pdfContent= $this->generatePdf($reportId,'mail');
        // dd($pdfContent);
        $user = auth('user')->user();

        Mail::to('gurinderjit.cloud@gmail.com')->send(new BranchReportMail($report));
        return response()->json(['status'=>true,'message' => 'Report on Email has been Sent.'], 201); 
    } 
    public function generatePdf($reportId,$action)
    {
        // Get report data from the model
        $report = BranchReport::with('branchReportContributions.attachments')->find($reportId);
        if(!$report){
            return response()->json(['status'=>false,'message' => 'Report not Found.'], 201); 
  
        }

        // Load the HTML content for the PDF
        $html = view('pdf.branch_report', ['report' => $report])->render();

        // Initialize dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);

        // Load HTML to dompdf
        $dompdf->loadHtml($html);

        // Set paper size
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (first parameter is to output to browser, true for download)
        $dompdf->render();

        // Output PDF to the browser
        if($action=='download'){
        return $dompdf->stream('branch_report.pdf');
        }elseif($action=='mail'){
        return $dompdf->output();
        }
    }


}
