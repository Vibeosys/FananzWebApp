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

        $this->set(['eventCategoryList' => $eventCategoryList,
            'categoryId' => $categoryId,
            'subCategoryId' => $subCategoryId,
            'portfolioDetails' => $categoryWisePortfolioList
        ]);
    }

    public function add() {
        $this->layout = 'home_layout';


        $subscriberType = $this->sessionManager->getSubscriberType();
        $allowedImageCount = 0;
        if ($subscriberType == CORPORATE_SUB_TYPE) {
            $allowedImageCount = IMAGE_CORPORATE_LIMIT;
        } else {
            $allowedImageCount = IMAGE_FREELANCE_LIMIT;
        }

        $eventCategoryTable = new \App\Model\Table\EventcategoriesTable();
        $categoryList = $eventCategoryTable->getCategories();

        $this->set([
            'allowedImageCount' => $allowedImageCount,
            'categoryList' => $categoryList
        ]);
        /*        $options = array(
          'Group 1' => array(
          'Value 1' => 'Label 1',
          'Value 2' => 'Label 2'
          ),
          'Group 2' => array(
          'Value 3' => 'Label 3'
          )
          );
          echo $this->Form->select('field', $options);

          Output:

          <select name="data[User][field]" id="UserField">
          <optgroup label="Group 1">
          <option value="Value 1">Label 1</option>
          <option value="Value 2">Label 2</option>
          </optgroup>
          <optgroup label="Group 2">
          <option value="Value 3">Label 3</option>
          </optgroup>
          </select> */
    }

    public function save() {
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

            //Just to make sure, we dont count the uploaded images twice
            if ($fileContents['tmp_name'] == $coverImageTmpName) {
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
