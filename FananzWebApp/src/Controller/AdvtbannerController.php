<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Advtbanner Controller
 *
 * @property \App\Model\Table\AdvtbannerTable $Advtbanner
 */
class AdvtbannerController extends AppController {

    public function addNewAdvtBanner() {
        $this->apiInitialize();
        $requestData = $this->request->data;
        $bannerImageUrl = $requestData['banner-pic-file'];
        $uploadedImageUrl = \App\Utils\ImageFileUploader::uploadMultipartImage($this->_getWebrootDir(), $bannerImageUrl);
        if (!$uploadedImageUrl) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(233));
            return;
        }

        $bannerSaveRequest = new \App\Dto\AdvtBannerSaveRequestDto();
        $bannerSaveRequest->bannerImageUrl = $uploadedImageUrl;
        $bannerSaveRequest->bannerLocation = $requestData['banner-location'];
        $bannerSaveRequest->bannerClickUrl = $requestData['banner-url'];

        $addOrUpdateSuccess = $this->Advtbanner->addOrUpdateNewBanner($bannerSaveRequest);
        if ($addOrUpdateSuccess) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareSuccessMessage(129));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(234));
        }
    }

    public function deleteBanner() {
        $this->apiInitialize();
        $bannerLocation = $this->request->data['bannerLocation'];

        $deleteSuccess = $this->Advtbanner->deleteBanner($bannerLocation);
        if ($deleteSuccess) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareSuccessMessage(130));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(235));
        }
    }
    
    public function bannerDetails($bannerLocation){
        $this->apiInitialize();
        $bannerDetails = $this->Advtbanner->getDetails($bannerLocation);
        
        if($bannerDetails){
            $this->response->body(\App\Dto\BaseResponseDto::prepareJsonSuccessMessage(131, $bannerDetails));
        }
        else{
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(236));
        }
    }


}
