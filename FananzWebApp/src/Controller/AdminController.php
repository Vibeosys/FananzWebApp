<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use App\Controller\AppController;

/**
 * Description of AdminController
 *
 * @author anand
 */
class AdminController extends AppController {

    //put your code here

    public function dashboard() {
        $this->layout = 'home_layout';

        $eventCategoryTable = new \App\Model\Table\EventcategoriesTable();
        $categoryList = $eventCategoryTable->getCategories();
        $bannerTypeList = \App\Utils\BannerTypeUtil::getDefaultTypeList();

        $this->set(['categoryList' => $categoryList,
            'bannerTypeList' => $bannerTypeList]);
    }

    public function subscriberList() {
        $currentRecordCount = 0;
        //$pageNo = 1;
        $this->apiInitialize();
        $subscriberTable = new \App\Model\Table\SubscribersTable();
        $dataTableQuery = $this->_parseDataTableQuery();
        $totalRecordCount = $subscriberTable->getTotalRecordCount();
        $subscriberList = $subscriberTable->getSubscriberList($dataTableQuery->pageSize, $dataTableQuery->startIndex);
        if (is_array($subscriberList)) {
            $currentRecordCount = count($subscriberList);
        }
        foreach ($subscriberList as $subscriberRecord) {
            if ($subscriberRecord->isSubscribed) {
                $subscriberRecord->subscriptionStatus = SUBSCRIPTION_STATUS_SUBSCRIBED;
                if ($subscriberRecord->currentStatusId == SUBSCRIPTION_STATUS_ACTIVE) {
                    $subscriberRecord->currentActionId = SUBSCRIBER_ON_HOLD;
                } else {
                    $subscriberRecord->currentActionId = SUBSCRIBER_ACTIVATE;
                }
            } else {
                $subscriberRecord->subscriptionStatus = SUBSCRIPTION_STATUS_REGISTERED;
                $subscriberRecord->currentActionId = SUBSCRIBER_BYPASS;
            }
        }
        //$encodedString = json_encode($subscriberList);

        $json_data = array(
            "draw" => intval($dataTableQuery->draw),
            "recordsTotal" => intval($totalRecordCount),
            "recordsFiltered" => intval($totalRecordCount),
            "data" => $subscriberList
        );
        $encodedString = json_encode($json_data);

        $this->response->body($encodedString);
    }

    private function _parseDataTableQuery() {
        $queryParams = $this->request->query;
        $dtParams = new \App\Dto\SubscriberDataTableQueryParams();
        $dtParams->draw = $queryParams['draw'];
        $dtParams->pageSize = $queryParams['length'];
        $requestedPage = $queryParams['start'] / $queryParams['length'];
        $dtParams->startIndex = $requestedPage + 1;
        return $dtParams;
    }

}
