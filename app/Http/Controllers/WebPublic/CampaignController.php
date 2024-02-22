<?php

namespace App\Http\Controllers\WebPublic;

use App\Models\CampaignUser;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class CampaignController extends Controller
{
    /**
     * Shows campaign invoice
     */
    public function campaignInvoice(Request $request)
    {
        $campaignUserInfo = CampaignUser::getPostById($request->campaignUserRowId);
        $influencerInfo = User::getPostById($campaignUserInfo['influencer_id']);

        $data['campaignUserInfo'] = $campaignUserInfo;
        $data['influencerInfo'] = $influencerInfo;
        $pdf = Pdf::loadView('influencer.invoice', $data);
        return $pdf->download('Invoice-'.$campaignUserInfo['id'].'.pdf');
    }
}
