<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/git-pull',
        'admin/campaign/crop-image',
        'admin/campaign/crop-image2',
        'admin/campaign/crop-image3',
        'admin/campaign/crop-image4',

        'admin/campaign/edit/crop-image',
        'admin/campaign/edit/crop-image2',
        'admin/campaign/edit/crop-image3',
        'admin/campaign/edit/crop-image4',

        'admin/campaign/influencerlist',
        'admin/campaign/influencers',
        'admin/campaign/radiussearch',
        'admin/campaign/circulationlist/update-price',
        'admin/campaign/circulationlist/sendmessage',
        'admin/campaign/circulationlist/showmessage',
        'admin/campaign/userbygenre',
        'admin/campaign/userbyage',
        
        'admin/gift/crop-image',
        'admin/gift/crop-image2',
        'admin/gift/crop-image3',
        'admin/gift/crop-image4',
        'admin/gift/influencerlist',
        'admin/gift/influencers',
        'admin/gift/radiussearch',
        'admin/gift/circulationlist/sendmessage',
        'admin/gift/circulationlist/showmessage',

        'admin/event/crop-image',
        'admin/event/crop-image2',
        'admin/event/crop-image3',
        'admin/event/crop-image4',
        'admin/event/influencerlist',
        'admin/event/influencers',
        'admin/event/radiussearch',
        'admin/event/circulationlist/sendmessage',
        'admin/event/circulationlist/showmessage',

        'admin/notification/read',
    ];
}
