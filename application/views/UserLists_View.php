<!DOCTYPE html>
<html ng-app="ListApp">
    <link href="<?php echo base_url().'assets/';?>/img/favicon.ico" type="image/x-icon" rel="icon"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
<title> User Lists</title>
        <style type="text/css">
        
        [ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak {
          display: none !important;
        }
</style> 
</head>
<body ng-controller="ListController" ng-cloak>

        <?php $this->load->view('header.php'); ?>
      <!-- Loader Image -->
      <div ng-show="showLoader" style="display : block;position : fixed;z-index: 100;background-color:#666;opacity : 0.4;background-repeat : no-repeat;background-position : center;left : 0;bottom : 0;right : 0;top : 0;">
          <img src='<?php echo base_url().'assets/';?>img/loader.gif' width="58px" height="58px" style="margin-left:50%;margin-top:25%"> 
      </div>



  

    <div class="container header_bg_clr">
        <div class="wrapper">
            <div class="header_main" style="color:#fff">
              <b> User Lists</b>
            </div>
            <div id="msg" style="display: none;"></div>
            
        </div>
    </div>
        <div class="container">
             <div class="wrapper">
            <div class="content_main_all">
                <div class="row">
                    <div class="col-md-12">
                        <div id="errmg" class="text-center" style="color: red;"></div>
                        <div class="text-right">
                            <div class="item-list">
                                <span>Total Count :</span>
                                <span class="text-color">{{totalitems}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="plan_list_view" id="table_wrapper">
                            <div class="table-responsive">
                                <table class="table" cellspacing="0" border="1">
                                    <thead>
                                        <tr class="tab1subtable">
                                            <th class="curser_pt" ng-click="sortBy('first_name')"><span>User Name</span></th>
                                            <th class="curser_pt" ng-click="sortBy('email_address')"><span>Email</span></th>
                                            <th class="curser_pt" ng-click="sortBy('mobile')"><span>Mobile</span></th>
                                            <th class="curser_pt" ng-click="sortBy('address')"><span>Address</span></th>
                                            <th class="curser_pt" ng-click="sortBy('profile_picture')"><span>Profile</span></th>
                                            <th class="curser_pt" ng-click="sortBy('created_on')"><span>Created On</span></th>
                                        </tr>
                                        <tr class="tab1table">
                                           <td>
                                               <div class="search">                                               
                                                 <input type="text" ng-model="userquery" ng-change="usersearch()" class="inputsearch" placeholder="Search User Name">
                                               </div>
                                           </td>
                                            <td>
                                               <div class="search">                                               
                                                 <input type="text" ng-model="emailquery" ng-change="emailsearch()" class="inputsearch" placeholder="Search Email">
                                               </div>
                                           </td>
                                           <td>
                                               <div class="search">                                               
                                                 <input type="text" ng-model="mobilequery" ng-change="mobilesearch()" class="inputsearch" placeholder="Search Mobile">
                                               </div>
                                           </td>
                                            <td>
                                               <div class="search">                                               
                                                 <input type="text" ng-model="addressquery" ng-change="addresssearch()" class="inputsearch" placeholder="Search Address">
                                               </div>
                                           </td>
                                           <td></td>
                                           <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr ng-repeat="(key,data) in pagedItems[currentPage] | filter:search | orderBy:sortKey:reverse">
                                                <td>{{data.first_name}} {{data.last_name}}</td>
                                                <td>{{data.email_address}}</td>
                                                <td>{{data.mobile}}</td>
                                                <td>{{data.address}}</td>
                                                <td ng-if="data.profile_picture"><img src="{{data.profile_picture}}" /></td>
                                                <td ng-if="!data.profile_picture">No image</td>
                                                <td>{{data.created_on}}</td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                                       <!-- pagination ui part -->
                                <div class="pagination pull-right pagi_master">
                                    <ul>
                                        <li ng-class="{disabled: currentPage == 0}">
                                            <a href ng-click="prevPage()">« Prev</a>
                                        </li>
                                        <li ng-repeat="n in pagenos | limitTo:5"
                                            ng-class="{active: n == currentPage}"
                                        ng-click="setPage()">
                                            <a href ng-bind="n + 1">1</a>
                                        </li>
                                        <li ng-class="{disabled: currentPage == pagedItems.length - 1}">
                                            <a href ng-click="nextPage()">Next »</a>
                                        </li>
                                    </ul>
                                </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



<?php 
$this->load->view('footer.php'); 
?>
</div>

       
<script>
    var exportdata_excel = [];
    var sortingOrder = 'first_name';
    var app = angular.module("ListApp", []);
    app.controller('ListController', function($scope, $timeout,$http,$window,$filter) {
            $scope.sortingOrder = sortingOrder;
            $scope.reverse = false;
            $scope.filteredItems = [];
            $scope.groupedItems = [];
            $scope.itemsPerPage = 5;
            $scope.pagedItems = [];
            $scope.pagenos = [];
            $scope.listingdata = '';
            $scope.currentPage = 0;
            $scope.isLoading =true;

            //Get User List
            $http.get("<?php echo base_url();?>index.php/UserLists/get_user_details")
            .success(function (response) {
                    $scope.listingdata = response;
                    $scope.commonpagination($scope.listingdata);
            })

          
            $scope.commonpagination = function(data){
                $scope.listings = data;

                     $scope.sortBy = function(propertyName) {
                        $scope.sortKey = propertyName;   //set the sortKey to the param passed
                        $scope.reverse = ($scope.sortKey === propertyName) ? !$scope.reverse : false;
                        $scope.filteredItems = $filter('orderBy')($scope.filteredItems, $scope.sortKey, $scope.reverse);
                        $scope.pagedItems = ""; 
                        $scope.groupToPages();
                    };
                        var searchMatch = function (haystack, needle) {
                            if (!needle) {
                                return true;
                            }
                            if(haystack !== null){
                                return haystack.toString().toLowerCase().indexOf(needle.toString().toLowerCase());
                            }
                        };

                     
                    $scope.usersearch = function () {
                        $scope.filteredItems = $filter('filter')($scope.listings, function (item) {
                            for(var attr in item) {
                            if(attr == "first_name") {
                                    if (searchMatch(item[attr], $scope.userquery)  > -1){
                                        return true;
                                    }
                                  }
                                }
                            return false;
                        });
                        // take care of the sorting order
                        if ($scope.sortingOrder !== '') {
                            $scope.filteredItems = $filter('orderBy')($scope.filteredItems, $scope.sortingOrder, $scope.reverse);
                        }
                        $scope.currentPage = 0;
                        $scope.totalitems = $scope.filteredItems.length;
                        // now group by pages
                        $scope.groupToPages();
                    };
                    $scope.emailsearch = function () {
                        $scope.filteredItems = $filter('filter')($scope.listings, function (item) {
                            for(var attr in item) {
                            if(attr == "email_address") {
                                    if (searchMatch(item[attr], $scope.emailquery)  > -1){
                                        return true;
                                    }
                                  }
                                }
                            return false;
                        });
                        // take care of the sorting order
                        if ($scope.sortingOrder !== '') {
                            $scope.filteredItems = $filter('orderBy')($scope.filteredItems, $scope.sortingOrder, $scope.reverse);
                        }
                        $scope.currentPage = 0;
                        $scope.totalitems = $scope.filteredItems.length;
                        // now group by pages
                        $scope.groupToPages();
                    };

                    $scope.mobilesearch = function () {
                        $scope.filteredItems = $filter('filter')($scope.listings, function (item) {
                            for(var attr in item) {
                            if(attr == "mobile") {
                                    if (searchMatch(item[attr], $scope.mobilequery)  > -1){
                                        return true;
                                    }
                                  }
                                }
                            return false;
                        });
                        // take care of the sorting order
                        if ($scope.sortingOrder !== '') {
                            $scope.filteredItems = $filter('orderBy')($scope.filteredItems, $scope.sortingOrder, $scope.reverse);
                        }
                        $scope.currentPage = 0;
                        $scope.totalitems = $scope.filteredItems.length;
                        // now group by pages
                        $scope.groupToPages();
                    };

                    $scope.addresssearch = function () {
                        $scope.filteredItems = $filter('filter')($scope.listings, function (item) {
                            for(var attr in item) {
                            if(attr == "address") {
                                    if (searchMatch(item[attr], $scope.addressquery)  > -1){
                                        return true;
                                    }
                                  }
                                }
                            return false;
                        });
                        // take care of the sorting order
                        if ($scope.sortingOrder !== '') {
                            $scope.filteredItems = $filter('orderBy')($scope.filteredItems, $scope.sortingOrder, $scope.reverse);
                        }
                        $scope.currentPage = 0;
                        $scope.totalitems = $scope.filteredItems.length;
                        // now group by pages
                        $scope.groupToPages();
                    };

                    
                     // *****************finish the filtered items*****************

                    
                    // calculate page in place
                    $scope.groupToPages = function () {
                    $scope.pagedItems = [];
                        for (var i = 0; i < $scope.filteredItems.length; i++) {
                            if (i % $scope.itemsPerPage === 0) {
                                $scope.pagedItems[Math.floor(i / $scope.itemsPerPage)] = [ $scope.filteredItems[i] ];
                                } else {
                                $scope.pagedItems[Math.floor(i / $scope.itemsPerPage)].push($scope.filteredItems[i]);
                            }
                        }
                        $scope.range($scope.pagedItems.length);
                    };
                    
                    $scope.range = function (start, end) {
                        var ret = [];
                        if (!end) {
                            end = start;
                            start = 0;
                        }
                        for (var i = start; i < end; i++) {
                            ret.push(i);
                        }
                        $scope.pagenos = ret;
                        return ret;
                    };
                    
                    $scope.prevPage = function () {
                        if ($scope.currentPage > 0) {
                            $scope.currentPage--;
                        }
                    };
                    
                    $scope.nextPage = function () {
                        if ($scope.currentPage < $scope.pagedItems.length - 1) {
                            $scope.currentPage++;
                        }
                    };
                    
                    $scope.setPage = function () {
                        $scope.currentPage = this.n;
                    };

                    // functions have been describe process the data for display
                    $scope.usersearch();

                    // change sorting order
                    $scope.sort_by = function(newSortingOrder) {
                        if ($scope.sortingOrder == newSortingOrder)
                            $scope.reverse = !$scope.reverse;

                        $scope.sortingOrder = newSortingOrder;

                        // icon setup
                        $('th i').each(function(){
                            // icon reset
                            $(this).removeClass().addClass('icon-sort');
                        });
                        if ($scope.reverse)
                            $('th.'+new_sorting_order+' i').removeClass().addClass('icon-chevron-up');
                        else
                            $('th.'+new_sorting_order+' i').removeClass().addClass('icon-chevron-down');
                    };
                    
                    $scope.$watch('currentPage', function(pno,oldno){
                      if ((pno+1)%5==0 && $scope.pagedItems.length > 5){
                        var start = pno > oldno ? pno : (pno - 4 ? pno - 4 : 0);
                        $scope.range(start, $scope.pagedItems.length);
                      }
                    });
                    $scope.range($scope.pagedItems.length);
                //pagination part end
            }

   });
</script>
   
</body>
</html>