<?php

namespace PHPMaker2022\project8;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Handle Routes
return function (App $app) {
    // notify
    $app->map(["GET","POST","OPTIONS"], '/NotifyList[/{Notify_ID}]', NotifyController::class . ':list')->add(PermissionMiddleware::class)->setName('NotifyList-notify-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/NotifyAdd[/{Notify_ID}]', NotifyController::class . ':add')->add(PermissionMiddleware::class)->setName('NotifyAdd-notify-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/NotifyView[/{Notify_ID}]', NotifyController::class . ':view')->add(PermissionMiddleware::class)->setName('NotifyView-notify-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/NotifyEdit[/{Notify_ID}]', NotifyController::class . ':edit')->add(PermissionMiddleware::class)->setName('NotifyEdit-notify-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/NotifyDelete[/{Notify_ID}]', NotifyController::class . ':delete')->add(PermissionMiddleware::class)->setName('NotifyDelete-notify-delete'); // delete
    $app->group(
        '/notify',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{Notify_ID}]', NotifyController::class . ':list')->add(PermissionMiddleware::class)->setName('notify/list-notify-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{Notify_ID}]', NotifyController::class . ':add')->add(PermissionMiddleware::class)->setName('notify/add-notify-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{Notify_ID}]', NotifyController::class . ':view')->add(PermissionMiddleware::class)->setName('notify/view-notify-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{Notify_ID}]', NotifyController::class . ':edit')->add(PermissionMiddleware::class)->setName('notify/edit-notify-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{Notify_ID}]', NotifyController::class . ':delete')->add(PermissionMiddleware::class)->setName('notify/delete-notify-delete-2'); // delete
        }
    );

    // error
    $app->map(["GET","POST","OPTIONS"], '/error', OthersController::class . ':error')->add(PermissionMiddleware::class)->setName('error');

    // Swagger
    $app->get('/' . Config("SWAGGER_ACTION"), OthersController::class . ':swagger')->setName(Config("SWAGGER_ACTION")); // Swagger

    // Index
    $app->get('/[index]', OthersController::class . ':index')->add(PermissionMiddleware::class)->setName('index');

    // Route Action event
    if (function_exists(PROJECT_NAMESPACE . "Route_Action")) {
        if (Route_Action($app) === false) {
            return;
        }
    }

    /**
     * Catch-all route to serve a 404 Not Found page if none of the routes match
     * NOTE: Make sure this route is defined last.
     */
    $app->map(
        ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
        '/{routes:.+}',
        function ($request, $response, $params) {
            $error = [
                "statusCode" => "404",
                "error" => [
                    "class" => "text-warning",
                    "type" => Container("language")->phrase("Error"),
                    "description" => str_replace("%p", $params["routes"], Container("language")->phrase("PageNotFound")),
                ],
            ];
            Container("flash")->addMessage("error", $error);
            return $response->withStatus(302)->withHeader("Location", GetUrl("error")); // Redirect to error page
        }
    );
};
