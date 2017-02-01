<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Portfolio Controller
 *
 * @property \App\Model\Table\PortfolioTable $Portfolio
 */
class PortfolioController extends AppController {

    /**
     * Website method
     * @param type $categorySubcategoryShortName
     */
    public function view($categorySubcategoryShortName) {
        $this->layout = 'home_layout';
        
        $eventCategoriesTable = new \App\Model\Table\EventcategoriesTable();
        $eventCategoryList = $eventCategoriesTable->getCategoriesAndSubcategories();

        $eventSubCategoryTable = New \App\Model\Table\SubcategoriesTable();

        $data = explode("--", $categorySubcategoryShortName);
        $categoryShortName = $data[0];
        $subCategoryShortName = $data[1];

        $categoryId = $eventCategoriesTable->getCategoryId($categoryShortName);
        $subCategoryId = $eventSubCategoryTable->getSubCategoryId($subCategoryShortName);

        $categoryWisePortfolioList = $this->Portfolio->getCategoryWisePortfolioList($categoryId, $subCategoryId);

        // $categoryWisePortfolioData = $this->paginate($categoryWisePortfolioList);

        if($this->sessionManager->isUserLoggedIn()){
            $this->set('isUserLoggedIn', true);
            $this->set('userName', $this->sessionManager->getUserName());
        }
        
        $this->set(['eventCategoryList' => $eventCategoryList,
            'categoryId' => $categoryId,
            'subCategoryId' => $subCategoryId,
            'portfolioDetails' => $categoryWisePortfolioList            
        ]);
    }

    public function add() {
        $this->layout = 'home_layout';

        $subscriberType = $this->sessionManager->getSubscriberType();
        $allowedImageCount = $this->_getAllowedImageCount($subscriberType);

        $eventCategoryTable = new \App\Model\Table\EventcategoriesTable();
        $categoryList = $eventCategoryTable->getCategories();

        $this->set([
            'allowedImageCount' => $allowedImageCount,
            'categoryList' => $categoryList
        ]);
    }

    public function update($portfolioId, $errorCode = null) {
        $errorDivClass = '';
        $errorMsg = '';

        if ($errorCode != null) {
            $errorMsg = \App\Dto\BaseResponseDto::getErrorText($errorCode);
            $errorDivClass = 'error-wrapper error-msg-display-block';
        } else {
            $errorDivClass = 'error-wrapper error-msg-display-none';
        }

        //$portfolioTable = new \App\Model\Table\PortfolioTable();
        $portfolioDetails = $this->Portfolio->getPortfolioData($portfolioId);

        $eventCategoryTable = new \App\Model\Table\EventcategoriesTable();
        $categoryList = $eventCategoryTable->getCategories();

        $subCategoriesTable = new \App\Model\Table\SubcategoriesTable();
        $subCategoryList = $subCategoriesTable->getSubCategoryList($portfolioDetails->categoryId);

        $subscriberType = $this->sessionManager->getSubscriberType();
        $allowedImageCount = $this->_getAllowedImageCount($subscriberType);

        $this->set([
            'allowedImageCount' => $allowedImageCount,
            'categoryList' => $categoryList,
            'subCategoryList' => $subCategoryList,
            'portfolioDetails' => $portfolioDetails,
            'errorDivClass' => $errorDivClass,
            'errorMsg' => $errorMsg
        ]);
    }

    public function saveupdate() {
        if (!$this->sessionManager->isSubscriberLoggedIn()) {
            $this->redirect('/subscribers/login');
            return;
        }

        $subscriberId = $this->sessionManager->getSubscriberId();

        $portfolio = $this->_buildPortfolioForUpdate($this->request->data);
        $portfolioPhotos = $this->_buildPortfolioPhotosForUpdate($this->request->data);

        $success = false;
        $portfolioTable = new \App\Model\Table\PortfolioTable();
        $updated = $portfolioTable->updatePortfolio($portfolio);

        $portfolioPhotosTable = new \App\Model\Table\PortfolioPhotosTable();
        $updatedPhotos = $portfolioPhotosTable->addOrdUpdatePhotos($portfolioPhotos, $portfolio->portfolioId);

        if ($updated && $updatedPhotos) {
            $this->redirect('/subscribers/portfolio');
        } else {
            $errorCode = 216;
            $this->redirect('/portfolio/update/' + $portfolio->portfolioId + '/' + $errorCode);
        }
    }

    private function _getAllowedImageCount($subscriberType) {
        $allowedImageCount = 0;
        if ($subscriberType == CORPORATE_SUB_TYPE) {
            $allowedImageCount = IMAGE_CORPORATE_LIMIT;
        } else {
            $allowedImageCount = IMAGE_FREELANCE_LIMIT;
        }
        return $allowedImageCount;
    }

    public function save() {

        if (!$this->sessionManager->isSubscriberLoggedIn()) {
            $this->redirect('/subscribers/login');
            return;
        }

        $subscriberId = $this->sessionManager->getSubscriberId();

        $portfolio = $this->_buildPortfolio($this->request->data);
        $portfolioPhotos = $this->_buildPortfolioPhotos($this->request->data);

        $success = false;
        $portfolioTable = new \App\Model\Table\PortfolioTable();
        $portfolioId = $portfolioTable->addPortfolio($portfolio, $subscriberId);

        if ($portfolioId != 0) {
            $portfolioPhotosTable = new \App\Model\Table\PortfolioPhotosTable();
            $success = $portfolioPhotosTable->addPortfolioPhotos($portfolioPhotos, $portfolioId);
        }

        if ($success) {
            $this->redirect('/subscribers/portfolio');
        }
        //$resultPhotoId = $this->PortfolioPhotos->addSubscriberPhoto($photoUploadRequest->portfolioId, $uploadedFilePath, $photoUploadRequest->isCoverImageUpload);
    }

    private function _buildPortfolio($requestData) {
        $portfolio = new \App\Dto\PortfolioAdditionDto();
        $portfolio->categoryId = $requestData['select-cat-id'];
        $portfolio->subCategoryId = $requestData['select-subcat-id'];
        $portfolio->fbLink = $requestData['cor_fb_link'];
        $portfolio->youtubeLink = $requestData['cor_yt_link'];
        $portfolio->minPrice = $requestData['min_price'];
        $portfolio->maxPrice = $requestData['max_price'];
        $portfolio->aboutUs = $requestData['corpo_self'];
        return $portfolio;
    }

    private function _buildPortfolioForUpdate($requestData) {
        $portfolio = new \App\Dto\PortfolioUpdateRequestDto();
        $portfolio->categoryId = $requestData['select-cat-id'];
        $portfolio->subCategoryId = $requestData['select-subcat-id'];
        $portfolio->fbLink = $requestData['cor_fb_link'];
        $portfolio->youtubeLink = $requestData['cor_yt_link'];
        $portfolio->minPrice = $requestData['min_price'];
        $portfolio->maxPrice = $requestData['max_price'];
        $portfolio->aboutUs = $requestData['corpo_self'];
        $portfolio->portfolioId = $requestData['hdnPortfolioId'];
        $portfolio->isActive = $requestData['rd_active'];
        return $portfolio;
    }

    /**
     * Build portfolio photos from request
     * @param RequestData $requestData
     * @return array
     */
    private function _buildPortfolioPhotos($requestData) {
        $portfolioList = [];
        $coverImageTmpName = '';

        $portfolioCoverPhoto = new \App\Dto\ServerImageResponseDto();
        $coverImagePath = $requestData['coverImage'];
        //Upload the cover image first
        $uploadedCoverImage = \App\Utils\ImageFileUploader::uploadMultipartImage($this->_getWebrootDir(), $coverImagePath);
        $portfolioCoverPhoto->isCoverImage = true;
        $portfolioCoverPhoto->photoUrl = $uploadedCoverImage;
        //Get the tmp name, to not consider it again
        if (is_array($coverImagePath)) {
            $coverImageTmpName = $coverImagePath['tmp_name'];
        }

        array_push($portfolioList, $portfolioCoverPhoto);

        //Then upload the rest of images
        foreach ($requestData as $fileContents) {
            //Check if filecontent is an array, leave everything aside
            if (!is_array($fileContents)) {
                continue;
            }
            $tmpFileName = $fileContents['tmp_name'];
            if ($tmpFileName == '')
                continue;

            //Just to make sure, we dont count the uploaded images twice
            if ($tmpFileName == $coverImageTmpName) {
                continue;
            }

            $portfolioPhoto = new \App\Dto\ServerImageResponseDto();
            //$resultPhotoId = 0;
            //Upload the get the server image path
            $uploadedFilePath = \App\Utils\ImageFileUploader::uploadMultipartImage($this->_getWebrootDir(), $fileContents);

            $portfolioPhoto->isCoverImage = false;
            $portfolioPhoto->photoUrl = $uploadedFilePath;
            array_push($portfolioList, $portfolioPhoto);
        }

        return $portfolioList;
    }

    private function _buildPortfolioPhotosForUpdate($requestData) {
        $portfolioList = [];
        $coverImageTmpName = '';

        $portfolioCoverPhoto = new \App\Dto\ServerImageResponseDto();

        $coverImagePath = $requestData['coverImage'];
        if ($coverImagePath['tmp_name'] != '') {
            //Upload the cover image first
            $uploadedCoverImage = \App\Utils\ImageFileUploader::uploadMultipartImage($this->_getWebrootDir(), $coverImagePath);
            $portfolioCoverPhoto->isCoverImage = true;
            $portfolioCoverPhoto->photoUrl = $uploadedCoverImage;
            $portfolioCoverPhoto->photoId = -1;

            //Get the tmp name, to not consider it again
            if (is_array($coverImagePath)) {
                $coverImageTmpName = $coverImagePath['tmp_name'];
            }
            //Create entry for cover image in the array
            array_push($portfolioList, $portfolioCoverPhoto);
        }


        //Then upload the rest of images
        foreach ($requestData as $fileKey => $fileContents) {
            //Check if filecontent is an array, leave everything aside
            if (!is_array($fileContents)) {
                continue;
            }
            //Just to make sure, we dont count the uploaded images twice
            $tmpFileName = $fileContents['tmp_name'];
            if ($tmpFileName == '' || $tmpFileName == $coverImageTmpName)
                continue;

            $portfolioPhoto = new \App\Dto\ServerImageResponseDto();
            //Upload the get the server image path
            $uploadedFilePath = \App\Utils\ImageFileUploader::uploadMultipartImage($this->_getWebrootDir(), $fileContents);

            if ($uploadedFilePath == null)
                continue;
            //Split the string file1211 to 1211 just remove file and get the photo id
            $fileNameStartsWith = strlen('file');
            $portfolioPhoto->photoId = substr($fileKey, $fileNameStartsWith);

            $portfolioPhoto->isCoverImage = false;
            $portfolioPhoto->photoUrl = $uploadedFilePath;
            array_push($portfolioList, $portfolioPhoto);
        }

        return $portfolioList;
    }

    /**
     * Website method
     */
    public function resetFilter() {
        $this->autoRender = false;
        $categoryId = $this->request->data['categoryId'];
        $subCategoryId = $this->request->data['subCategoryId'];

        $categoryWisePortfolioList = $this->Portfolio->getCategoryWisePortfolioList($categoryId, $subCategoryId);
        // $this->set(['portfolioDetails' => $categoryWisePortfolioList]);
        $this->response->body(json_encode($categoryWisePortfolioList));
    }

    /**
     * Website ajax method
     */
    public function filteredPortfolios() {
        $this->autoRender = false;

        $categoryId = $this->request->data['categoryId'];
        $subCategoryId = $this->request->data['subCategoryId'];
        $minPrice = $this->request->data['minPrice'];
        $maxPrice = $this->request->data['maxPrice'];
        $sortById = $this->request->data['sortById'];
        // $data = json_encode($id);
        // $Cat = json_encode($Cat);
        //echo('ok');
        $portfolioDetails = $this->Portfolio->getFilteredPortfolioList(
                $categoryId, $subCategoryId, $minPrice, $maxPrice, $sortById);
        $this->response->body(json_encode($portfolioDetails));
        //  $this->set(['portfolioDetails' => json_encode($portfolioDetails)])
    }

    //REST API
    public function getPortfolioDetails() {
        $this->apiInitialize();
        $portfolioDetaiRequest = \App\Dto\PortfolioDetailRequestDto::Deserialize($this->postedData);
        $portfolioDetails = $this->Portfolio->getPortfolioDetails($portfolioDetaiRequest);
        if ($portfolioDetails) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareJsonSuccessMessage(107, $portfolioDetails));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(208));
        }
    }

    public function getPortfolioDetailsForWeb() {
        $this->apiInitialize();
        $portfolioDetailsRequest = new \App\Dto\PortfolioDetailRequestDto();
        $portfolioDetailsRequest->portfolioId = $this->request->data['portfolioId'];
        //$portfolioDetaiRequest = \App\Dto\PortfolioDetailRequestDto::Deserialize($this->postedData);
        $portfolioDetails = $this->Portfolio->getPortfolioDetails($portfolioDetailsRequest);
        if ($portfolioDetails) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareJsonSuccessMessage(107, $portfolioDetails));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(208));
        }
    }

    public function addPortfolio() {
        $this->apiInitialize();
        $isAuthorized = $this->isSubscriberAuthorised();
        //If the subscriber is not authorized then return from here
        if (!$isAuthorized) {
            //TODO: add code for error
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(206));
            return;
        }

        $portfolioAddition = \App\Dto\PortfolioAdditionDto::Deserialize($this->postedData);
        $portfolioId = $this->Portfolio->addPortfolio($portfolioAddition, $this->postedSubscriberData->subscriberId);
        if ($portfolioId != 0) {
            $portfolioInfo = new \App\Dto\PortfolioAddResponseDto();
            $portfolioInfo->portfolioId = $portfolioId;
            $this->response->body(\App\Dto\BaseResponseDto::prepareJsonSuccessMessage(105, $portfolioInfo));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(205));
        }
    }

    public function subscriberPortfolioList() {
        $this->apiInitialize();
        $isAuthorized = $this->isSubscriberAuthorised();
        //If the subscriber is not authorized then return from here
        if (!$isAuthorized) {
            //TODO: add code for error
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(206));
            return;
        }

        $portfolioList = $this->Portfolio->getPortfoliosBySubscriber($this->postedSubscriberData->subscriberId);
        if ($portfolioList) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareJsonSuccessMessage(106, $portfolioList));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(207));
        }
    }

    /**
     * Gets the list of all portfolios
     */
    public function getList() {
        $this->autoRender = FALSE;
        $portfolioList = $this->Portfolio->getPortfolioList();
        $this->response->type('json');
        if ($portfolioList) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareJsonSuccessMessage(101, $portfolioList));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(201));
        }
    }

    public function updatePortfolio() {
        $this->apiInitialize();
        $isAuthorized = $this->isSubscriberAuthorised();
        //If the subscriber is not authorized then return from here
        if (!$isAuthorized) {
            //TODO: add code for error
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(206));
            return;
        }
        $portfolioUpdateRequest = \App\Dto\PortfolioUpdateRequestDto::Deserialize($this->postedData);
        $updateSuccess = $this->Portfolio->updatePortfolio($portfolioUpdateRequest);
        if ($updateSuccess) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareSuccessMessage(115));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(216));
        }
    }

    public function inactivatePortfolio() {
        $this->apiInitialize();
        $isAuthorized = $this->isSubscriberAuthorised();
        //If the subscriber is not authorized then return from here
        if (!$isAuthorized) {
            //TODO: add code for error
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(206));
            return;
        }
        $portfolioInactivateRequest = \App\Dto\InactivatePortfolioRequestDto::Deserialize($this->postedData);
        $inactivateSuccess = $this->Portfolio->inactivatePortfolio
                ($portfolioInactivateRequest->portfolioId, $portfolioInactivateRequest->isActive);
        if ($inactivateSuccess) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareSuccessMessage(118));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(219));
        }
    }

}
