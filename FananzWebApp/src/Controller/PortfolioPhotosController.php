<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * PortfolioPhotos Controller
 *
 * @property \App\Model\Table\PortfolioPhotosTable $PortfolioPhotos
 */
class PortfolioPhotosController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $portfolioPhotos = $this->paginate($this->PortfolioPhotos);

        $this->set(compact('portfolioPhotos'));
        $this->set('_serialize', ['portfolioPhotos']);
    }

    /**
     * View method
     *
     * @param string|null $id Portfolio Photo id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $portfolioPhoto = $this->PortfolioPhotos->get($id, [
            'contain' => []
        ]);

        $this->set('portfolioPhoto', $portfolioPhoto);
        $this->set('_serialize', ['portfolioPhoto']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $portfolioPhoto = $this->PortfolioPhotos->newEntity();
        if ($this->request->is('post')) {
            $portfolioPhoto = $this->PortfolioPhotos->patchEntity($portfolioPhoto, $this->request->data);
            if ($this->PortfolioPhotos->save($portfolioPhoto)) {
                $this->Flash->success(__('The portfolio photo has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The portfolio photo could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('portfolioPhoto'));
        $this->set('_serialize', ['portfolioPhoto']);
    }

    public function addPhotos() {
        $this->apiInitialize();
        $jsonString = $this->request->data['json'];
        $photoUploadRequest = \App\Dto\PhotoUploadRequestDto::Deserialize($jsonString);

        //Check if subscriber is authorised to upload photos
        $subscriberUserData = $this->buildSubscriberData($photoUploadRequest);
        $isSubscriberAuthenticated = $this->validateSubscriber($subscriberUserData);
        if (!$isSubscriberAuthenticated) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(206));
            return;
        }

        $webrootDir = $this->getWebrootDir();
        $uploadedFiles = $this->request->data;
        $serverImages = null;
        $imageCounter = 0;
        foreach ($uploadedFiles as $fileContents) {
            //Check if filecontent is an array, leave everything aside
            if (!is_array($fileContents)) {
                continue;
            }

            $resultPhotoId = 0;
            //Upload the get the server image path
            $uploadedFilePath = \App\Utils\ImageFileUploader::uploadMultipartImage($webrootDir, $fileContents);
            //If uploaded then only go ahead
            if ($uploadedFilePath) {
                $resultPhotoId = $this->PortfolioPhotos->addSubscriberPhoto($photoUploadRequest->portfolioId, $uploadedFilePath, $photoUploadRequest->isCoverImageUpload);
            }
            //If the resultant photo id is received then go ahead.
            if ($resultPhotoId != 0) {
                $resultServerImage = new \App\Dto\ServerImageResponseDto();
                $resultServerImage->isCoverImage = $photoUploadRequest->isCoverImageUpload;
                $resultServerImage->photoId = $resultPhotoId;
                $resultServerImage->photoUrl = $uploadedFilePath;

                $serverImages[$imageCounter++] = $resultServerImage;
            }
        }

        if ($serverImages) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareJsonSuccessMessage(111, $serverImages));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(212));
        }
    }

    public function getPhotos() {
        $this->apiInitialize();
        $isSubscriberAuthorised = $this->isSubscriberAuthorised();
        if (!$isSubscriberAuthorised) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(206));
            return;
        }

        $subscriberPhotoRequest = \App\Dto\SubscriberPhotosRequestDto::Deserialize($this->postedData);
        $serverImages = $this->PortfolioPhotos->getPhotos($subscriberPhotoRequest->portfolioId);
        if ($serverImages) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareJsonSuccessMessage(112, $serverImages));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(213));
        }
    }

    public function updatePhoto() {
        $this->apiInitialize();
        $jsonString = $this->request->data['json'];
        $photoUpdateRequest = \App\Dto\PhotoUpdateRequestDto::Deserialize($jsonString);

        //Check if subscriber is authorised to upload photos
        $subscriberUserData = $this->buildSubscriberData($photoUpdateRequest);
        $isSubscriberAuthenticated = $this->validateSubscriber($subscriberUserData);
        if (!$isSubscriberAuthenticated) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(206));
            return;
        }

        $webrootDir = $this->getWebrootDir();
        $uploadedFiles = $this->request->data;
        $photoUpdateSuccess = FALSE;
        $uploadedFilePath = NULL;

        foreach ($uploadedFiles as $fileContents) {
            //Check if filecontent is an array, leave everything aside
            if (!is_array($fileContents)) {
                continue;
            }

            //Upload the get the server image path
            $uploadedFilePath = \App\Utils\ImageFileUploader::uploadMultipartImage($webrootDir, $fileContents);
            if ($uploadedFilePath) {
                $photoUpdateSuccess = $this->PortfolioPhotos->updatePhoto($photoUpdateRequest->photoId, $uploadedFilePath, $photoUpdateRequest->isCoverImageUpload);
            }
        }

        if ($photoUpdateSuccess) {
            $photoUpdateResponse = new \App\Dto\PhotoUpdateResponseDto();
            $photoUpdateResponse->photoId = $photoUpdateRequest->photoId;
            $photoUpdateResponse->photoUrl = $uploadedFilePath;
            $this->response->body(\App\Dto\BaseResponseDto::prepareJsonSuccessMessage(113, $photoUpdateResponse));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(214));
        }
    }

    public function deletePhoto() {
        $this->apiInitialize();
        $photoDeleteRequest = \App\Dto\PhotoDeleteRequestDto::Deserialize($this->postedData);

        //Check if subscriber is authorised to upload photos
        $isSubscriberAuthenticated = $this->isSubscriberAuthorised();
        if (!$isSubscriberAuthenticated) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(206));
            return;
        }

        $deleteSuccess = $this->PortfolioPhotos->deletePhoto($photoDeleteRequest->photoId);
        if ($deleteSuccess) {
            $this->response->body(\App\Dto\BaseResponseDto::prepareSuccessMessage(114));
        } else {
            $this->response->body(\App\Dto\BaseResponseDto::prepareError(215));
        }
    }

    private function buildSubscriberData($photoUploadRequestData) {
        $subscriberData = new \App\Dto\SubscriberUserDto();
        $subscriberData->subscriberId = $photoUploadRequestData->subscriberId;
        $subscriberData->emailId = $photoUploadRequestData->emailId;
        $subscriberData->password = $photoUploadRequestData->password;
        return $subscriberData;
    }

    private function getWebrootDir() {
        return "http://" . $this->request->host() . $this->request->webroot;
    }

    /**
     * Edit method
     *
     * @param string|null $id Portfolio Photo id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $portfolioPhoto = $this->PortfolioPhotos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $portfolioPhoto = $this->PortfolioPhotos->patchEntity($portfolioPhoto, $this->request->data);
            if ($this->PortfolioPhotos->save($portfolioPhoto)) {
                $this->Flash->success(__('The portfolio photo has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The portfolio photo could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('portfolioPhoto'));
        $this->set('_serialize', ['portfolioPhoto']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Portfolio Photo id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $portfolioPhoto = $this->PortfolioPhotos->get($id);
        if ($this->PortfolioPhotos->delete($portfolioPhoto)) {
            $this->Flash->success(__('The portfolio photo has been deleted.'));
        } else {
            $this->Flash->error(__('The portfolio photo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
