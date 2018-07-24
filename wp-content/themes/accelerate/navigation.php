<?php
$nextPost = get_next_post();
$prevPost = get_previous_post();
?>
<div class="navigation-container">
    <div class="container" ng-app="chtBlog" ng-controller="NavigationController as navigation"
         ng-init="navigation.initialize('<?php echo $nextPost->ID ?>', '<?php echo $prevPost->ID ?>')" ng-cloak>
        <div class="row h-center clearfix">
            <div class="col-md-10 col-md-offset-1">
                <h4 ng-hide="navigation.loading">Other Posts You May Be Interested in</h4>
                <div class="row" ng-if="!navigation.loading">
                    <post-card class="col-sm-6" post="post" ng-repeat="post in navigation.posts"></post-card>
                </div>
                <loading ng-if="navigation.loading"></loading>
                <follow-us></follow-us>
            </div>
        </div>
    </div>
</div>

